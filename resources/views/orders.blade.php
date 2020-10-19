<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ROVIGA</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="js/fontawesome.js" defer></script> <!--font icons-->

        <!-- Styles -->
       <link href="css/app.css" rel="stylesheet">
       <link href="css/nav.css" rel="stylesheet">
       
       <!--Scripts -->
    <script src="js/app.js"> </script>
    </head>
    <body>
            <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <!-- Brand -->
            <a class="navbar-brand" href="/">R o v i g a</a>
          
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link " href="/">Home</a>
                </li>
             <!-- Dropdown -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Shop 
                </a>
                <div class="dropdown-menu">
                 <a class="dropdown-item" href="/product/category/Electronic gadgets">Electronic gadgets</a>
                   <a class="dropdown-item" href="/product/category/Electronic spares">Electronic spares</a>
                    <a class="dropdown-item" href="/product/category/Clothing" >Clothing</a>
                    <a class="dropdown-item" href="/product/category/Furniture">Furniture</a>
                     <a class="dropdown-item" href="/product/category/Cosmetics">Cosmetics</a>
                      <a class="dropdown-item" href="/product/category/Ornaments">Ornaments</a>
                  </div>
                </li>
                  <li class="nav-item">
                  <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                  </li>
               </ul>

             <a href="{{route('logout')}}" class="btn btn-outline-primary ml-auto" 
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"> Log out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
              </div>
          </nav> 
          <div class="container">

                @if (count($orders)>0)
                <div class="container" style="margin-top: 10rem;">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Reference token</th>
                                            <th scope="col">Order status</th>
                                            <th>Date requested</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach ($orders as $order )
                                <tr>
                                <td><a href="{{route('customer.order.detail',$order->reference_token)}}">{{$order->reference_token}}</a></td>
                                    <td>{{$order->Order_status}}</td>
                                    <td>{{$order->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
                </div>
                @else
                <h3>No tokens generated yet</h3>
                @endif
          </div>
    </body>
</html>