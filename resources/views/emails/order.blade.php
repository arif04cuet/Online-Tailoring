Hello <i>Admin</i>,
<p>New order has been submitted</p>
 
<br>
<p><u>Customer Details:</u></p>
 
<div>
    <p><b>Name:</b>&nbsp;{{ $order->customer->name }}</p>
    <p><b>Email</b>&nbsp;{{ $order->customer->email }}</p>
    <p><b>Phone</b>&nbsp;{{ $order->customer->mobile }}</p>
</div>
 
<br>
<p><u>Order Details:</u></p>
 
<div>
    <p><b>Order Id:</b>&nbsp;{{ $order->id }}</p>
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
<i>cityhallles.com</i>