@extends('layout.mainlayout')
@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            <h3 class="title text-center">Patterns</h3>
                <hr>
        </div>
    </div>

       <div class="row">
        <div class="col">
            <img class="w-100" src="{{asset('uploads/slider/3.png')}}" alt="">
        </div>
    </div>
    <br>


    <div class="row">
            <div class="col mx-auto text-justify">
                <p>Paper Pattern is everything when it comes to suit making. For tailors that have never worked on different body shapes, such as a woman's curves are working blindfolded. When it comes to suiting, most tailors are used to working off of a man's frame which consist of a template of three tiers (Ectomorph, Mesomorph & Endomorph). Both male & females have several body shapes, even with that being said a male does not posses even half of the curves on a woman's body. However concurring different body shapes often take a lot more then computer assist, it involves heavy decision making and experience. At CityHall, we have the dictionary in our mindset, the key to unlock even to the smallest adjustment. We've mastered customizing suits for the female body type by executing years of experience. Our process consist of our tailors engineering canvas mock ups created specifically for your body type before building the suit to then taking that pattern to create the final product for your body. This method is spot on and leaves zero room for error. </p>
            </div>        
        </div>


</div>

<br>
@include('order.button')



@endsection
