Hello <i>{{ $order->customer->name }}</i>,
<br>
<p>THANK YOU FOR YOUR ORDER {{ config('app.name')}}</p>
 
<br>
<p><u>Order Details:</u></p>
 
<div>
    <p><b>Order #:</b>&nbsp;{{ $order->id }}</p>
    <p><b>Order Date:</b>&nbsp;{{ $order->created_at }}</p>
</div>
 
<br>
<p><u>Invoice Details:</u></p>
 
<div>
    <p><b>Paypal Transaction Id :</b>&nbsp;{{ $order->invoice->recurring_id }}</p>
    <p><b>Paypment Status :</b>&nbsp;{{ $order->invoice->payment_status }}</p>
    <p><b>Paypment Amount :</b>&nbsp;{{ $order->invoice->price }}</p>
</div>

<br>


Thank You,
<br/>
<i>{{ config('app.name')}}</i>