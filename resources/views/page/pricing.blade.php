@extends('layout.mainlayout')
@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            <h3 class="title text-center">Pricing</h3>
                <hr>
        </div>
    </div>

       <div class="row">
        <div class="col">
            <img class="w-100" src="{{asset('uploads/slider/4.png')}}" alt="">
        </div>
    </div>
    <br>


    <div class="row">
            <div class="col mx-auto text-justify">
                <div class=" w-70">
                    <table class="table table-bordered">
                        <tr>
                            <th>Prom Ball of Yarn </th>
                            <td>$569.00 (Only Offered During Prom Season March 1st-June 30)</td>
                        </tr>
                        <tr>
                            <th>Cool Cat   </th>
                            <td>$769.00 (1/2 Canvas)</td>
                        </tr>

                        <tr>
                            <th>The Cougar  </th>
                            <td>$969.00 (Full Canvas)</td>
                        </tr>

                        <tr>
                            <th>The Lion   </th>
                            <td>$1569.00 (Tuxedo or Designer Fabrics; Reda and Holland & Sherry)</td>
                        </tr>


                    </table>
                </div>
               <br>
               <h5 class="card-title text-large">Button Downs</h5>
               <div class=" w-70">

                    <table class="table table-bordered">
                            <tr>
                                <th>Shirt Elementary </th>
                                <td>$129.00</td>
                            </tr>
                            
                            <tr>
                             <th>Shirt Easy Care  </th>
                             <td>$139.00</td>
                            </tr>
            
                         <tr>
                             <th>Shirt Classic   </th>
                             <td>$149.00</td>
                         </tr>
            
                         <tr>
                             <th>Shirt Essential    </th>
                             <td>$159.00</td>
                         </tr>
                         
                         
                           <tr>
                             <th>Shirt Seasonal     </th>
                             <td>$169.00</td>
                         </tr>
            
            
                    </table>
                        
               </div>
               
               <p class="w-100 mx-specher">
                    * Monograms are available for an extra cost
                </p>

            </div>        
        </div>


</div>

<br>
@include('order.button')

@endsection
