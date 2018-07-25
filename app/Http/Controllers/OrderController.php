<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\Customer;
use App\Order;
use App\FabricFilter;
use App\Mail\OrderEmail;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('weight', 'asc')->get();
        return view('order.index')->with(['products' => $products]);
    }

    public function submit(Request $request)
    {
        
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

            //send mail
            $admin_email = env('MAIL_ADMIN_ADDRESS');
            Mail::to($admin_email)->send(new OrderEmail($order));

            //redirect
            return redirect()->back()->with('success', 'Order Submitted Sucessully!'); 
            
       
    }
    public function fabrics(Request $request,$id)
    {

        return $this->renderData($request,$id,'fabrics');
    }

    public function linings(Request $request,$id)
    {
        return $this->renderData($request,$id,'linings');
    }

    public function styles(Request $request,$id)
    {
        return $this->renderData($request,$id,'styles');
    }

    public function measurments(Request $request,$id)
    {
        $attributeSets = [];
        
        $product_id = $id;
        $product = Product::find($product_id);
        $names = [];     
      
        if($product->is_complex)
        {
            $products = Product::whereIn('id',$product->associated_products)->get();
            foreach($products as $product)
                $names[] = strtolower($product->name);
        }
        else{
            $names[] = strtolower($product->name);
        }
        $returnHTML = view("order.steps.measurements")->with('names', $names)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }


    public function renderData($request,$id,$type)
    {
        
        $product_id = $id;
        $product = Product::find($product_id);

        if($product->is_complex)
        {
            $associated_products = $product->associated_products;
            $product = Product::find($associated_products[0]);
            $collection = $product->$type()->get();

            if($type == 'styles')
            {
                $collection =  new Collection();
                foreach($associated_products as $product_id)
                {
                    $product = Product::find($product_id);
                    $collection = $collection->merge($product->$type()->orderBy('id','asc')->get());
                }
            }
        }
        else
        {
            $collection = $product->$type()->orderBy('id','asc')->get();
        }

      
        //print_r($collection->toArray());
        $returnHTML = view("order.steps.$type");//->with('collection', $collection);

        if($type == 'fabrics')
        {
            $requestData = $request->all();
            $composition = FabricFilter::where('type','composition')->orderBy('title')->pluck('title','id');
            $color = FabricFilter::where('type','color')->orderBy('title')->pluck('title','id');
            $patterns = FabricFilter::where('type','patterns')->orderBy('title')->pluck('title','id');
            $catagory = FabricFilter::where('type','catagory')->orderBy('title')->pluck('title','id');

            $filters = [
                'composition'=>$composition,
                'color'=>$color,
                'pattern'=>$patterns,
                'category'=>$catagory,
            ];

            if($requestData)
            {
                $collection = $product->$type();
                foreach($requestData as $filter=>$val)
                {
                    if($val)
                        $collection->where($filter.'_id',$val);
                }
                $collection = $collection->get();
            }

            $returnHTML->with('filters',$filters)->with('requestData',$requestData);
        }

        $returnHTML->with('collection', $collection);
        $returnHTML = $returnHTML->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }
    
}