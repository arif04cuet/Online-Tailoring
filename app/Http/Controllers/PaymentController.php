<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;
use App\Customer;
use App\Order;
use App\Invoice;


class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    public function index()
    {
        return view('paywithpaypal');
    }
    public function payWithpaypal(Request $request)
    {

        //save order first
        $orderData = $request->all();
        $postCustomer = $orderData['customer'];
    
        // save customer   
        $customer = Customer::firstOrCreate(
            ['email'=>$postCustomer['email']],
            [
                'name'=>$postCustomer['name'],
                'mobile'=>$postCustomer['phone']
            ]
        );

        //save Order
        $order = new Order();
        $order->product_id =$orderData['product'];
        $order->fabric_id = $orderData['fabric'];
        $order->lining_id = $orderData['lining'];
        $order->style = serialize($orderData['style']); 
        $order->message = $orderData['message'];
        $order->customer_id = $customer->id;
        $order->save();


        // Paypal
        $deductAmount = \Config::get('paypal.deduct_amount');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Cityhallles Order') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($deductAmount); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($deductAmount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        // create new invoice
        $invoice = new Invoice();
        $invoice->title = 'Cityhallles Order';
        $invoice->price = $deductAmount;
        $invoice->recurring_id = $payment->getId();
        $order->invoice()->save($invoice);

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect('/')->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

             //update invoice
             $invoice = Invoice::where('recurring_id',$payment_id)->first();
             $invoice->payment_status = 'Completed';
             $invoice->save();

            //send mail
            $admin_email = env('MAIL_ADMIN_ADDRESS');
            Mail::to($admin_email)->send(new OrderEmail($invoice->order));

            $deductAmount = \Config::get('paypal.deduct_amount');
            $msg = "Your order ( #$invoice->id ) has been placed successfully! and $".$deductAmount." has been paid!";
            return redirect('/')->with('success',$msg);
        }

        return redirect('/');

    }

}