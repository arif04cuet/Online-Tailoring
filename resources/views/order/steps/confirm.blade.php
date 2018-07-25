
<div class="mx-auto">
<br>
<p>Enter your details</p>
<div class="row">
        <div class="col">
          <input type="text" name="customer[name]" class="form-control" placeholder="Name *" required>
        </div>
        <div class="col">
          <input type="email" name="customer[email]" class="form-control" placeholder="Email *" required>
        </div>
        <div class="col">
            <input type="text" name="customer[phone]" class="form-control" placeholder="Phone *" required>
        </div>
</div>

<br>
<p>Order message if any</p>
<div class="row">
    <div class="col">
        <textarea name="message" id="message" class="form-control w-100" style="height:100px" cols="20"></textarea>
    </div>
</div>

<br>
<p>Payment Details</p>
<div class="row">
        <div class="col mx-auto">
            <p>You will be charged ${{config('paypal.deduct_amount')}}</p>
        </div>
</div>

<br>
<div class="row">
        <div class="col">
        <input type="submit" value="Place Order via PayPal" class="nav-link btn btn-primary">
        </div>
</div>

</div>
