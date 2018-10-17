<?php
use Illuminate\Support\Facades\Mail;
use App\Invoice;
use App\Mail\OrderEmailCustomer;
use App\Order;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('home');
});

Route::any('/order_receipt', function (\Illuminate\Http\Request $request) {

    $order = Order::find(16);
    return new OrderEmailCustomer($order);

});

// route for processing payment
Route::post('/paypal', 'PaymentController@payWithpaypal')->name('paypal');
// route for check status of the payment
Route::get('/status', 'PaymentController@getPaymentStatus')->name('paypal_status');


Route::post('/contact-us', function (\Illuminate\Http\Request $request) {
    
    //send mail
    $admin_email = env('MAIL_ADMIN_ADDRESS');
    Mail::to($admin_email)->send(new App\Mail\ContactEmail($request->all()));
    //redirect
    return redirect()->back()->with('success', 'Thanks for contacting with us!');

})->name('contact-us-post');

Route::get('/page/{name}', function ($name) {
    return view("page.$name");
});


Route::post('paypal/express-checkout', 'PaypalController@expressCheckout')->name('paypal.express-checkout');
Route::get('paypal/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
Route::post('paypal/notify', 'PaypalController@notify');



Route::get('/order', 'OrderController@index')->name('order');
Route::get('/order/{id}/fabrics/', 'OrderController@fabrics')->where('id', '[0-9]+');
Route::get('/order/{id}/linings', 'OrderController@linings')->where('id', '[0-9]+');
Route::get('/order/{id}/styles', 'OrderController@styles')->where('id', '[0-9]+');
Route::get('/order/{id}/measurments', 'OrderController@measurments')->where('id', '[0-9]+');
Route::post('/order/submit', 'OrderController@submit');