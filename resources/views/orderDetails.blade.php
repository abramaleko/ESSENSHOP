<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ESSENSHOP</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
       <link href="{{asset('css/nav.css')}}" rel="stylesheet">
       
       <!--Scripts -->
    <script src="{{asset('js/app.js')}}"> </script>
    </head>
    <body>
      <nav class="navbar navbar-expand-md navbar-light fixed-top">
        <!-- Brand -->
        <a class="navbar-brand" href="/">E S S E N S H O P</a>
      
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
                      <a class="dropdown-item" href="/product/category/Ornaments">Ornaments</a>>
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
          <div class="container" style="margin-top: 8rem;">
            <div class="table-borderless table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col" class="text-right">Price (Tshs)</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                @foreach ($cartDetails as $cartDetail )
                <tr>
                <td><img src="{{asset('storage/'.$cartDetail->products->image_path)}}" alt="{{$cartDetail->product_name}}" style="width: 58px; height:55px;" /> </td>
                    <td>{{$cartDetail->product_name}}</td>
                <td>{{$cartDetail->quantity}}</td>
                    <td class="text-right price">{{$cartDetail->products->new_price}}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Total</strong></td>
                  <td class="text-right"><strong>{{$orderDetails->total}}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

          </div>
    </body>
</html>