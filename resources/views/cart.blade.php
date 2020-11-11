<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ESSENSHOP</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="js/fontawesome.js" defer></script> <!--font icons-->

        <!-- Styles -->
       <link href="css/app.css" rel="stylesheet">
       <link href="css/cart.css" rel="stylesheet">
       <link href="css/nav.css" rel="stylesheet">
       
       <!--Scripts -->
    <script src="js/app.js"> </script>
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
                      <a class="dropdown-item" href="/product/category/Ornaments">Ornaments</a>
                  </div>
                </li>
                  <li class="nav-item">
                  <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                  </li>
               </ul>
 
              <div class="cartbadge ml-auto" id="cartbadge">
                <a href="/cart">
               <i class="fas fa-shopping-cart"></i>
             <span class="badge badge-danger" id="badge">{{$cartbadge}}</span>
                </a>
             </div>
             <a href="{{route('logout')}}" class="btn btn-outline-primary" 
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"> Log out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
              </div>
          </nav> 
          <div class="orders container">
          <a href="{{route('customer.orders')}}" style="color: inherit">View orders</a>
          </div>
          @if (count($cartItems)>0)
          <div class="container carttable">
              <div class="row">
                  <div class="col-12">
                      <div class="table-responsive-sm">
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th scope="col"> </th>
                                      <th scope="col">Product</th>
                                      <th scope="col">In stock</th>
                                      <th scope="col" class="text-center">Quantity</th>
                                      <th scope="col" class="text-right">Price (Tshs)</th>
                                      <th> </th>
                                  </tr>
                              </thead>
                              <tbody>
                              
                          @foreach ($cartItems as $cartItem )
                          <tr>
                          <td><img src="{{asset('storage/'.$cartItem->products->image_path)}}" alt="{{$cartItem->product_name}}" style="width: 58px; height:55px;" /> </td>
                              <td>{{$cartItem->product_name}}</td>
                             <td id="stock">{{$cartItem->products->stock}}</td>
                          <td><input class="form-control w-25  input" type="number" value="{{$cartItem->quantity}}" id="quantity" onmouseup="updateprice(this,{{$cartItem->products->new_price}},'{{$cartItem->product_name}}')" onkeyup="updateprice(this,{{$cartItem->products->price}},'{{$cartItem->product_name}}')" min="1"/></td>
                              <td class="text-right price">{{$cartItem->products->new_price}}</td>
                          <td class="text-right"><a class="btn btn-sm btn-danger" href="/deleteitem/{{$cartItem->cart_id}}"><i class="fa fa-trash"></i> </a> </td>
                          </tr>
                          @endforeach
                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><strong>Total</strong></td>
                              <td class="text-right" id="subtotal"><strong></strong></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="col mb-2">
              <div class="row">
                  <div class="col-sm-12  col-md-6">
                      <a class="btn btn-block btn-secondary " href="/">CONTINUE SHOPPING</a>
                  </div>
                  <div class="col-sm-12 col-md-6 text-right">
                      <button class="btn btn-block btn-primary text-uppercase" id="checkout">Request Order</button>
                  </div>
              </div>
          </div>
          </div>
          </div>
          @else
          <img src="{{asset('images/empty-cart.jpg')}}" id="emptycart" class="mx-auto d-block" style="margin-top: 7%;"/>
          @endif
        <script src="{{asset('js/cart.js')}}"></script>
