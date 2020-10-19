<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
 <script src="js/fontawesome.js" defer></script> <!--font icons-->

   <!-- Styles -->
   <link rel="shortcut icon" href="assets/images/logo-122x122.png" type="image/x-icon">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/login.css') }}" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
   <style>
    #password
    {
      margin-bottom: 0% !important;
    }
  </style>
  <title>Register</title>
  
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-6">
            <img src="images/register.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <div class="brand-wrapper">
                  <a href="/">
                  <h2> <!--<img src="assets/images/logo-122x122.png" alt="logo" class="logo">-->
                    ROVIGA</h2>
                  </a>
              </div>
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
                    <li>{{$error}} </li>       
                  @endforeach
                </ul>
              </div>
             @endif
              @if ($message=Session::get('success'))
              <div class="alert alert-primary" role="alert">
                <strong> {{$message}} </strong>
               </div>  
              @endif
              <p class="login-card-description">Register a new account</p>
              <form action="/register" method="POST" id="registerForm">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name">
                  </div>
                  <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address">
                  </div>
                  <div class="form-group mb-3">
                    <label for="phonenumber">Phone number</label>
                    <input type="text" name="phone_number" id="phonenumber" class="form-control" placeholder="Phone number" maxlength="10">
                    </div>
                    <div class="form-group mb-3">
                    <label for="location">Location</label>
                      <select class="form-control" name="location">
                        <option value="" disabled selected hidden>Choose Location</option>
                        <option>Dar es Salaam</option>
                        <option>Other Regions</option>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label for="password">Password</label>
                      <div class="input-group">
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********" required autocomplete="current-password">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="showpassword()"><i class="fas fa-eye" id="eye"></i></button>
                      </div>
                      </div>
                    </div>
                  <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="password" id="confirmpassword" class="form-control"  placeholder="Confirm Password"data-toggle="popover"data-placement="bottom" data-content="Password does not match" data-trigger="focus">
                  </div>
                  <input id="register" class="btn btn-block login-btn mb-3" type="submit" value="REGISTER">
                </form>
                <p class="login-card-footer-text">Already have an account? <a href="{{ route('login') }}" class="text-reset">Log in here</a></p>
                <nav class="login-card-footer-nav">
                  <a href="#!">By registering you have accecpted Roviga terms and Privacy policy</a>
                </nav>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <script src="js/app.js"></script>
  <script src="js/register.js"></script>
    <script>
    function showpassword() {
      let x = document.getElementById("password");
      let y = document.getElementById("eye");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
    y.setAttribute('class','fas fa-eye-slash')
  }
}
  </script>
 </body>
</html>
