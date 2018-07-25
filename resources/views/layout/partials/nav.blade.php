<div class="top-nav-bar bg-default">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <a class="navbar-brand" href="/"><img src="{{ asset('img/city-hall-logo.png')}}" alt="Logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          
          <ul class="navbar-nav">
              <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item {{ Request::is('page/about-us') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('page/about-us') }}">About Us</a>
              </li>

                <li class="nav-item {{ Request::is('page/bemberg-lining') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('page/bemberg-lining') }}">Bemberg Lining</a>
                </li>

                <li class="nav-item {{ Request::is('page/patterns') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('page/patterns') }}">Patterns</a>
                </li>

                <li class="nav-item {{ Request::is('page/pricing') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('page/pricing') }}">Pricing</a>
                </li>
                <li class="nav-item {{ Request::is('page/contact-us') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('page/contact-us') }}">Contact</a>
                </li>
            
                <li class="nav-item {{ Request::is('/order') ? 'active' : '' }}">
                  <a class="nav-link btn btn-primary" href="{{ route('order') }}">Order Now</a>
              </li>


            </ul>


        {{-- <ul class="nav navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link bg-primary text-white" href="/order">Order Now</a>
          </li>
          
        </ul> --}}
      </div>
    </nav>
  </div>
</div>

