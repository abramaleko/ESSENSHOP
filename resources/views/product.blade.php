<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       <title>{{$product->name}}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  
    <script src="{{asset('js/fontawesome.js')}}" defer></script> <!--font icons-->

        <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/nav.css')}}" rel="stylesheet">
    <link href="{{asset('css/product.css')}}" rel="stylesheet">
       <!--Scripts -->
    <script src="{{asset('js/app.js')}}"> </script>
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
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
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
               <div class="has-search ml-auto">
                <form class="form-inline" action="{{route('search')}}">
                    @csrf
                  <span class="fa fa-search form-control-feedback"></span>
                  <input type="text" class="form-control mr-sm-2" name="search"  aria-label="Search"  style="width: 50% !important;">
                  <button type="submit" class="btn btn-outline-info" id="search">Search</button>
                  </form>
                </div>
              @if (Auth::check())
              <!--checks if user is loged in shows cartbadge and logout button-->
              <div class="cartbadge" id="cartbadge">
                <a href="/cart">
                <i class="fas fa-shopping-cart"></i>
              <span class="badge badge-danger" id="badge">{{$cartbadge}}</span>
                </a>
              </div>
             <a href="{{route('logout')}}" class="btn btn-outline-primary" 
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"> Log out</a>
              @else
             <a href="{{route('login')}}" class="btn btn-outline-primary"><i class="far fa-user"></i>&nbsp;&nbsp;Log In</a>
              @endif
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </nav> 


          <div class="container products-description" id="description">
              <div class="row">
               <div class="col-md-5">
               <img src="{{asset('storage/'.$product->image_path)}}" alt="{{$product->name}}"  class="d-block product-image" id="cover-image">
               <div class="images-products my-4">
                <img onclick="showimage(this)" src="{{asset('storage/'.$product->image_path)}}" alt="{{$product->name}} " class=" images img-thumbnail">
                 @if (! empty($product->image1))
                 <img onclick="showimage(this)" src="{{asset('storage/'.$product->image1)}}" alt="{{$product->name}} " class=" images img-thumbnail">
                 @endif
                 @if (! empty($product->image2))
                 <img onclick="showimage(this)" src="{{asset('storage/'.$product->image2)}}" alt="{{$product->name}} " class=" images img-thumbnail">
                 @endif
                 @if (! empty($product->image3))
                 <img onclick="showimage(this)" src="{{asset('storage/'.$product->image3)}}" alt="{{$product->name}} " class=" images img-thumbnail">
                 @endif
               </div>
               </div>
               <div class="col-md-7">
                 <div class="product-name">
                 <p id="product_name">{{$product->name}}</p>
                 <p class="d-none" id="product_id">{{$product->id}}</p>
                 </div>
                 <div class="product-description">
                 <p id="product_description">{!!$product->description!!}</p>
                 </div>
                 <div class="price">
                  <span id="old-price">{{$product->old_price}}</span>
                  <span id="new-price">{{$product->new_price}} Tshs</span>
                  </div>
                 <div class="stock">
                   <p id="stock">Available in stock:</p>
                 <span id="stockno">{{$product->stock}}</span>
                 </div>
                 <div class="fieldquantity">
                   <p id="quantity">Quantity :</p>
                  <div class="quantity">
                  <input type="number" min="1" max="{{$product->stock}}" step="1" value="1" id="quantityNo">
                  </div>
                 </div>
                 @auth
                 <div class="addtocart">
                  <button type="button" class="btn btn-primary btn-lg" onclick="addToCart()"><i class="fas fa-shopping-cart"></i>&nbsp;Add to cart</button>
                </div>   
                 @endauth
                 @guest
                 <div class="addtocart">
                  <button type="button" class="btn btn-primary btn-lg disabled "><i class="fas fa-shopping-cart"></i>&nbsp;Add to cart</button>
                </div>
                <small id="" class="form-text text-muted my-4" style=" font-size: 16px;">
                  You must first log in to add the product to cart
                </small>     
                 @endguest
               
               </div>
              </div>
          </div>
        
          

   
       <!--footer-->
          <div class="container-fluid" style="background-color: #262626; color:white;">
             <div class="row footer">
              <div class="col-md-4">
                <p id="projectname">Roviga</p>
                <p id="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
              <div class="col-md-4">
                <p id="socialmedia">Find us on social media</p>
                <div class="social-icons">
                  <p class="icons"><i class="fab fa-instagram"></i>&nbsp;&nbsp;Follow us on Instagram</p>
                  <p class="icons"><i class="fab fa-facebook-square"></i>&nbsp;&nbsp;Like us on Facebook</p>
                  <p class="icons"><i class="fab fa-twitter"></i>&nbsp;&nbsp;Follow us on Twitter</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info">
                  <p id="Contact">Contact Us</p>
                  <div class="social-icons">
                    <p class="icons"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Dar es Salaam,Tanzania</p>
                    <p class="icons"><i class="fas fa-phone"></i>&nbsp;&nbsp;+255 744 646 524</p>
                    <p class="icons"><i class="fas fa-envelope"></i>&nbsp;&nbsp;info@roviga.co.tz</p>
                  </div>
               </div>
              </div>
            </div>
          </div>
              <div class="copyright" style="background-color: #262626; color:white;">
                <span>Roviga&copy;2020,All rights reserved</span>
              </div>
        <script src="{{asset('js/productDescription.js')}}"></script>
        <script>
           function showimage(element)
          {
            let image=element.getAttribute("src");
            document.getElementById('cover-image').setAttribute('src',image);
          }
          </script>
    </body>
</html>
