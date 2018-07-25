<!DOCTYPE html>
<html lang="en">
<head>
@include('layout.partials.head')
</head>
<body>
@include('layout.partials.nav')
@include('layout.partials.header')

<div class="container">
    <div class="row">
        <div class="col">
           
            @include('layout.partials.flash-message')

        </div>
    </div>
</div>
    @yield('content')

@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
</body>
</html>
