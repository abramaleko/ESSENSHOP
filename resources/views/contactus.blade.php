<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact Us</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="js/fontawesome.js" defer></script> <!--font icons-->

        <!-- Styles -->
       <link href="css/app.css" rel="stylesheet">
       <link href="css/nav.css" rel="stylesheet">
       <link href="css/contactus.css" rel="stylesheet">
       
       <!--Scripts -->
    <script src="js/app.js" defer> </script>
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
 
              <div class="has-search ml-auto">
              <form class="form-inline" action="{{route('search')}}" method="POST">
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
            <div class="header-image">
            <img src="{{asset('images/contact.jpg')}}" class="img-fluid">
            </div>
            <div class="container contact">
                <div class="row">
                <div class="col-md-6">
                    <div class="card message">
                      @if (count($errors)>0)
                      <!--checks for errors in validation-->
                      <script>
                        $('.alert').alert()
                        </script>
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                              <ul>
                          @foreach ($errors->all() as $error)
                             <li>{{$error}}</li>           
                          @endforeach
                        </ul>
                      </div>
                     @endif
                     @if (session('success'))
                     <div class="alert alert-success">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                       <!--displays the success message after adding product-->
                         {{ session('success') }}
                     </div>
                 @endif
                        <div class="card-body">
                          <h2 class="mb-4">Leave us a message</h2>
                        <form action="{{route('contactus.message')}}" autocomplete="off" method="POST">
                             @csrf
                               <div class="form-group mb-3">
                               <label for="name">Name</label>
                               <input type="text" class="form-control" id="name" name="name">
                               </div>
                               <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                                </div>
                                <input type="submit" class="btn btn-lg bg-dark text-white" value="SEND MESSAGE">
                           </form>
                        </div>
                      </div>
                </div>
                <div class="col-md-6 other">
                    <h2>You can also contact us at</h2>
                    <p class="icons"><i class="fas fa-phone"></i>&nbsp;&nbsp;+255 744 646 524</p>
                    <p class="icons"><i class="fas fa-envelope"></i>&nbsp;&nbsp;info@essenshop.co.tz</p>
                </div>
                </div>
            </div>
    </body>

</html>
