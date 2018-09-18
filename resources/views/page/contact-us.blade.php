@extends('layout.mainlayout')
@section('content')

<div class="container">

    <div class="row">
            <div class="col text-justify">
                <h3 class="title text-center">Contact Us</h3>
                <hr>
            </div>        
        </div>

        <div class="bg-light pt-3 pb-3 pl-3 pr-3 mb-4">
            <div class="row mx-auto">
                <div class="col-lg-12">
                  <h6 class="text-large">ADDRESS :</h6>
                </div>
                <div class="col-lg-4 col-4">
                        <p style="margin: 0;">240 Kent Avenue
                        {Cross Streets: Grand St. & N.1st St.}
                        Brooklyn, NY 11249     </p>                   
                </div>
                <div class="col-lg-4 col-4">
                <p class="m-0 text-danger"><i class="fa fa-phone-square" aria-hidden="true"></i>
                    0000 - 0000 000
                </p>
                <p class="m-0 text-info"><i class="fa fa-envelope" aria-hidden="true"></i>
                    example@gmail.com
                </p>
                </div>
                <div class="col-lg-4 col-4 address-icon text-center text-danger">
                    <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                </div>
            </div>
           </div>
            
        <div class="row">
                
                <div class="col">
                    
                        <form action="{{ route('contact-us-post') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                            
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        
                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
                                    </div>
                                
                                    <div class="form-group col-md-12">
                                         
                                            <textarea class="form-control h-500" id="message" rows="5" placeholder="Message" name="message"></textarea>
                                    </div>
                                </div>
                                
                                
                                
                                <input type="submit" class="btn-send btn btn-primary" value="Send"/>
                              </form>
                        
                </div>

                <div class="col">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.0521142164657!2d-73.96797338518434!3d40.71686924525575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25963e1210e4f%3A0xfaeb0cfd8e8bbee5!2s240+Kent+Ave%2C+Brooklyn%2C+NY+11249%2C+USA!5e0!3m2!1sen!2sbd!4v1529833431157" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                 </div>


            </div>

</div>
@endsection
