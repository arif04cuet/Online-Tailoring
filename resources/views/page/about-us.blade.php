@extends('layout.mainlayout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col text-justify">
          <h3 class="title text-center">About Us</h3>
                <hr>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <img class="w-100" src="{{asset('uploads/slider/1.1.png')}}" alt="">
        </div>
    </div>
    <br>
    <div class="row">
            <div class="col mx-auto text-justify">
                <p>City Hall proudly presents a more expanded virtual shopping experience combined with our already superb customer service to give you an experience unlike any you've ever encountered.</p>
                <p>Because we understand and respect that your time is valuable, we invite you to browse our Virtual Showroom so that you can begin to narrow down your choices. Ultimately the end result will be the custom individually tailored suit that you desire. Making some of these choices prior to our consultation will allow us to maximize our time working out the details that will make our services and more importantly your custom bespoke suit be exactly what you want it to be.</p>
                <p>The next step would be to book your 30 minute consultation, where a trained CityHall expert will assist in finalizing your choices. This one on one consultation comes at the very low non-refundable cost of $50.00 (which will be credited towards your suit in the event that you move forward with your purchase). During this consultation you will have the opportunity to physically see and feel the fabrics, ask any pertinent questions, and undergo a body analysis that CityHall prides itself in being the reason we can guarantee that your suit will be precisely fitted.</p>
                <p>This method of selection will, as I mentioned, provide the ultimate marriage between the practicality and convenience of an online look book, without removing the piece that we believe makes all the difference; A personalized physical shopping experience with a highly trained professional. We invite you to browse, become acquainted with the intricacies of the many options available to you, and ultimately to have to the opportunity to meet you, and be of service. We look forward to your consultation.</p>
                
                <p class="w-100 mx-specher">
                    * Please note that depending on the device used images may have a slight color variation from it's original form. Keep in mind that a swatch is a small piece of fabric and you are only viewing a fraction of the pattern.
                </p>
                
            </div>        
        </div>


</div>
@include('order.button')
@endsection
