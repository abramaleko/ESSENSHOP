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
  <title>LogIn</title>
  
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-6">
            <img src="images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <div class="brand-wrapper">
                <a href="/">
                  <h2> <!--<img src="assets/images/logo-122x122.png" alt="logo" class="logo">-->
                    ROVIGA</h2>
                </a>
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form action="{{ route('login') }}" method="POST">
                @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address"value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>
                  <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********" required autocomplete="current-password">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" onclick="showpassword()"><i class="fas fa-eye" id="eye"></i></button>
                    </div>
                    </div>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Log In">
                </form>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>

                @endif
                <p class="login-card-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
                <nav class="login-card-footer-nav">
                  <a href="#!">Terms and private policy to be used</a>
                </nav>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
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
