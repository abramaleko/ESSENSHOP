<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
  
   <!-- Styles -->
   @yield('styles')
   <link rel="shortcut icon" href="{{asset('assets/images/logo-122x122.png')}}" type="image/x-icon">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{asset('css/admin-nav.css')}}" rel="stylesheet">

   @yield('title')
   <!-- main navbar-->
   <div class="main-nav">
    <nav class="navbar navbar-expand-md navbar-dark ">
      <a class="navbar-brand" href="/" target="\_blank" rel="noreferrer">
          <!--<img src="{{asset('assets/images/logo-122x122.png')}}" alt="ESSENSHOP" title="">-->
          <span class="brand-name">R O V I G A</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="/admin/new_product">Add new product</a>
            <a class="dropdown-item" href="{{route('admin.dashboard')}}" >Products stock</a>
            </div>
            </li>  
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orders</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="{{route('admin.orders')}}">Orders</a>
              <a class="dropdown-item" href="{{route('customer.messages')}}">Customer messages</a>
              </div>
              </li>

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Roviga</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="{{route('logout')}}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Log out
                </a>
                </div>
                </li>
        </ul>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
    </nav>
    </div>
</head>
<body>
    @yield('content')
</body>
</html>