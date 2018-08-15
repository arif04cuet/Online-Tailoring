@extends('layout.mainlayout') @section('content')

<form id="order" action="{{ route('paypal') }}" method="POST">
    {{ csrf_field() }}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="title text-center">Place Order</h3>
            <hr>


            <div class="d-flex flex-row mt-2 order">
                <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" role="navigation" id="steps">
                    <li class="nav-item">
                        <a href="#category" class="nav-link active" data-toggle="tab" role="tab" aria-controls="lorem">
                            <span class="badge badge-dark">1</span> Category and Style</a>
                    </li>
                    <li class="nav-item">
                        <a href="#fabrics" class="nav-link" data-toggle="tab" role="tab" aria-controls="ipsum">
                            <span class="badge badge-dark">2</span> Fabric and Style</a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="#measurements" class="nav-link" data-toggle="tab" data-url="measurments" role="tab" aria-controls="ipsum">
                            <span class="badge badge-dark">3</span> Fill In Measurements</a>
                    </li> --}}

                    <li class="nav-item">
                        <a href="#confirm" class="nav-link" data-toggle="tab" role="tab" aria-controls="ipsum">
                            <span class="badge badge-dark">3</span> Confirm</a>
                    </li>

                    <li>
                        <hr>
                        <div class="preview" style="height:675px;overflow-y:scroll">

                             <div>
                                <b> Order Preview</b>
                            </div>
                            <hr>

                            <div>
                               
                                <div class="category"></div>
                            </div>
                            <hr>
                            <div>
                                
                               
                                <div class="fabric"></div>
                            </div>
                            <hr>
                            <div>
                                
                               
                                <div class="lining"></div>
                            </div>
                            <hr>
                            <div>
                                
                                
                                <div class="styles"></div>
                            </div>


                        </div>
                    </li>
                </ul>
               
                <?php $m = 1;?>
                <div class="tab-content w-100 pl-md-5" id="right_tab_area">
                    <div class="tab-pane  show active" id="category" role="tabpanel">
                        <div class="products">

                                <div class="row">
                                        <div class="col">
                                            <div class="text mx-auto">
                                            <h4 class="title title-lg">Category and Style</h4>
                                            <p><b>Step 1: Choose either Business Suit or Tuxedo, then select the desired clothing item</b></p>
                                            </div>
                                            <br>
                                            <nav>
                                                <div class="nav nav-tabs nav-justified" id="suit-tuxedo" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-suit-tab" data-toggle="tab" href="#nav-suit" role="tab"
                                                        aria-controls="nav-suit" aria-selected="true">Bussiness Suit</a>
                                                    <a class="nav-item nav-link" id="nav-tuxedo-tab" data-toggle="tab" href="#nav-tuxedo" role="tab" aria-controls="nav-tuxedo"
                                                        aria-selected="false">Tuxedo</a>
                                                  
                                                </div>
                                            </nav>
                                            <br>
                                            <div class="tab-content" id="nav-suit-tuxedo">
                                               
                                                <div class="tab-pane show active" id="nav-suit" role="tabpanel" aria-labelledby="nav-suit-tab">
                                                    <div class="row">
                                                       
                                                       
                                                        @foreach($products as $product)
                                                            <?php $checked = ($m == 1)?' checked=checked':''?>
                                                            <div class="col-3">
                                                                <label class="labl d-table w-100">
                                                                    <input type="radio" name="product" value="{{$product->id}}" />
                                                                    <div class="product-box text-white d-table-cell align-middle text-center" style="background-color:{{$product->color}}">
                                                                        
                                                                        {{$product->name}}
                                                                        
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <?php $m++; ?>
                                                        @endforeach

                                                    </div>

                                                </div>
                                                <div class="tab-pane" id="nav-tuxedo" role="tabpanel" aria-labelledby="nav-tuxedo-tab">

                                                        <div class="row">

                                                                @foreach($products as $product)
                                                                    @if(!$product->is_tuxedo)
                                                                    <div class="col-3 ">
                                                                        <label class="labl d-table w-100">
                                                                            <input type="radio" name="product" value="{{$product->id}}"/>
                                                                            <div class="product-box text-white d-table-cell align-middle text-center" style="background-color:{{$product->color}}">
                                                                                
                                                                                {{$product->name}}
                                                                                
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    @endif
                                                                @endforeach
        
                                                            </div>

                                                </div>

                                                <br>
                                                <button class="nav-link btn btn-primary next">Next &gt;&gt;</button>
                                            </div>
            
            
            
                                        </div>
                                    </div>



                        </div>
                    </div>
                    <div class="tab-pane" id="fabrics" role="tabpanel">

                        <div class="row">
                            <div class="col">

                                    <div class="mx-auto text">
                                            <h2 class="title title-lg">Fabric and Styles</h2>
                                            <p><b>Step 2: Select fabric, lining and style of the clothing you desire to be custom made.</b></p>
                                    </div>
                                    <br>

                                <nav>
                                    <div class="nav nav-tabs nav-justified" id="fabric-lining-style" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-fabric-tab" data-toggle="tab" data-url="fabrics" href="#nav-fabric" role="tab"
                                            aria-controls="nav-fabric" aria-selected="true">Fabric</a>
                                        <a class="nav-item nav-link" id="nav-lining-tab" data-toggle="tab" data-url="linings" href="#nav-lining" role="tab" aria-controls="nav-lining"
                                            aria-selected="false">Lining</a>
                                        <a class="nav-item nav-link" id="nav-style-tab" data-toggle="tab" data-url="styles" href="#nav-style" role="tab" aria-controls="nav-style"
                                            aria-selected="false">Styles</a>
                                    </div>
                                </nav>
                                <br>
                                <div class="tab-content" id="nav-tabContent">
                                    <img src="/img/ajax-loader.gif" alt="" class="hide" id="ajax_loader">
                                    <div class="tab-pane  show active" id="nav-fabric" role="tabpanel" aria-labelledby="nav-fabric-tab">

                                    </div>
                                    <div class="tab-pane " id="nav-lining" role="tabpanel" aria-labelledby="nav-lining-tab"></div>
                                    <div class="tab-pane " id="nav-style" role="tabpanel" aria-labelledby="nav-style-tab"></div>
                                </div>



                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-pane " id="measurements" role="tabpanel">


                    </div> --}}
                    <div class="tab-pane " id="confirm" role="tabpanel">
                            <div class="mx-auto text">
                                    <h2 class="title title-lg">Confirm Your Order</h2>
                                    <p><b>Step 3: Enter your personal details.</b></p>
                            </div>
                        @include('order.steps.confirm')
                    </div>

                </div>



            </div>
        </div>
    </div>

</form>
<br>

    <style>
    .preview img{width: 100px!important;display: block}

#nav-tabContent{min-height: 600px;}
@media screen and (max-width: 768px) {
  .order {
    flex-direction: column !important;
  }
  #right_tab_area{padding-top: 30px;}

}
.labl{width: 200px;height: 200px;}
.nav-item{
  font-size: 15px;
  text-transform: uppercase;    
}

#steps .nav-item{
  font-size: 15px;
  text-transform: none;    
}
.product-box {
  position: relative;
  display: inline-block;
  
  font-size: 15px;
  text-transform: uppercase;
}
.labl>input:checked+div.product-box::before {
    content: '\f00c';
    z-index: 5;
    position: absolute;
    left: 50%;
    top: 40%;
    transform: translate( -50%, -50% );
    padding: 5px 10px;
    color: white;
    font-family: 'FontAwesome';
    font-size: 30px !important;
    background-color: transparent;
    border-radius: 5px 5px 5px 5px;
}


        .hide{display:none}
        .product-box {}

        .labl {
            display: block;

        }

        .labl>input {
            /* HIDE RADIO */
            visibility: hidden;
            /* Makes input not-clickable */
            position: absolute;
            /* Remove input from document flow */
        }

        .labl>input+div {
            /* DIV STYLES */
            cursor: pointer;
            border: 2px solid transparent;
            height: 100px;
        }

        .labl>input:checked+div {
            /* (RADIO CHECKED) DIV STYLES */
            border: 0px solid red;
            opacity: .5;
        }

        .labl>input:checked+div svg {
            display: block;
            margin:0 auto;
        }

        .nav-item .active span {
            background-color: #000080;
        }

        .nav-tabs--vertical {
            border-bottom: none;
            
            display: flex;
            flex-flow: column nowrap;
        }

        .nav-tabs--left {
            margin: 0 15px;
        }

        .nav-tabs--left .nav-item+.nav-item {
            margin-top: 0.25rem;
        }

        .nav-tabs--left .nav-link {
            transition: border-color 0.125s ease-in;
            white-space: nowrap;
        }

        .nav-tabs--left .nav-link:hover {
            background-color: #f7f7f7;
            border-color: transparent;
        }

        .nav-tabs--left .nav-link.active {
            border-bottom-color: #ddd;
            border-right-color: #fff;
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
            margin-right: -1px;
        }

        .nav-tabs--left .nav-link.active:hover {
            background-color: #fff;
            border-color: #0275d8 #fff #0275d8 #0275d8;
        }
    </style>
    
    @endsection



    