@extends('layout.mainlayout')
@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            @include('home.carousel')
        </div>        
    </div>
      <br>
     <div class="row">
                  <div class="col text-justify-content">
                  <h4 class="text-large text-center">LES Downtown, a lesbian centered brand, presents CityHall (a Bespoke clothier) offering a collection of custom-tailored formal menswear expertly constructed specifically for the body and curves of a woman. </h4>
                  </div>
             </div>

       <br>
             <div class="row">
                  <div class="col text-justify-content">
                  <h1 class="text-exlarge text-center"><strong>How our Virtual Showroom works:</strong></h1>
                  </div>
             </div>
   <br>
              <div class="row">
                   <div class="col-md-6 mx-auto">
                       <div class="content-left-pad">
                    <h4 class="text-large">In the comfort of your own home:</h4>
                    <ol class="content-lists">
                        <li><i class="fa fa-angle-right"></i>&nbsp;Select what type of suit (Suit vs Tux)</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Select your Fabric</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Select the Lapel</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Select the Buttons & Quantity</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Select how many Vents</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Select your Lining</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Monogram or not</li>
                    </ol>
                    </div>
                    </div>
                    
                <div class="col-md-6 mx-auto">
                <h4 class="text-large">Book a Consultation:</h4>
                <p>Get measured & see physical fabric swatch (30 min consultation)</p>

                <ol class="content-lists">
                    <li><i class="fa fa-angle-right"></i>&nbsp;Visit our Showroom in Williamsburg (next door to Domino Park)</li>
                    <li><i class="fa fa-angle-right"></i>&nbsp;We also offer Mobile Services</li>
                </ol>
            </div> 
                    
                    
                </div>
                
            
             <div class="row">
                  <div class="col text-justify-content">
                  <h1 class="text-exlarge text-center"><a class="extrarnal-link" href="{{ url('page/instructions') }}"><strong>INSTRUCTIONS ON HOW TO USE OUR SYSTEM TO DESIGN YOUR OWN SUIT/TUX</strong></a></h1>
                  </div>
             </div>
             
        </div>
  
@include('order.button')

@endsection
