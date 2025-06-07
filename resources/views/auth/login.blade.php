<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Login</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="../assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="../assets/css/style-preset.css" >

<style>
  .auth-header {
      text-align: left;  /* Changed from center to left */
      padding: 1.5rem 0;
  }
  
  .auth-header .auth-logo {
      max-height: 60px;
      width: auto;
      object-fit: contain;
      margin: 0;  /* Removed auto margin */
      display: inline-block;  /* Changed from block to inline-block */
  }
  
  /* Add responsive adjustments */
  @media (max-width: 576px) {
      .auth-header .auth-logo {
          max-height: 30px;
      }
  }
  
  /* Add a subtle shadow to the logo */
  .auth-header .auth-logo {
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
  }
</style>
<style>
  body {
      background-color: rgba(255, 255, 255, 0.234) !important;  /* Force white background */
  }

  .auth-main {
      background-color: rgba(255, 255, 255, 0.262) !important;
  }

  .auth-wrapper.v3 {
      background-color: rgba(255, 255, 255, 0.338) !important;
  }

  .auth-header {
      text-align: left;
      padding: 1.5rem;
      margin-bottom: 1rem;
  }
  
  .auth-header .auth-logo {
      max-height: 60px;
      width: auto;
      object-fit: contain;
      margin: 0;
      display: inline-block;
  }
  
  /* Add responsive adjustments */
  @media (max-width: 576px) {
      .auth-header .auth-logo {
          max-height: 30px;
      }
  }
  
  /* Add a subtle shadow to the logo */
  .auth-header .auth-logo {
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
  }

  /* Remove any existing background colors or patterns */
  .auth-main .auth-wrapper.v3 .auth-form:after {
      background-color: white !important;
  }
</style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="{{ route('user.index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="auth-logo">
          </a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
            <form action="{{route('loginMatch')}}" method="POST">
              @csrf
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="{{route('auth.register')}}" class="link-primary">Don't have an account?</a>
            </div>
            
            {{-- <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="d-flex mt-1 justify-content-between">
              <div class="form-check">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
              </div>
              <h5 class="text-secondary f-w-400">Forgot Password?</h5>
            </div> --}}
            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" 
                     class="form-control @error('email') is-invalid @enderror" 
                     name="email" 
                     placeholder="Email Address" 
                     value="{{ old('email') }}"
                     required>
              @error('email')
                  <div class="invalid-feedback">
                      @if($message == 'The email field is required.')
                          Please enter your email address
                      @else
                          {{ $message }}
                      @endif
                  </div>
              @enderror
          </div>
          
          <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" 
                     class="form-control @error('password') is-invalid @enderror" 
                     name="password" 
                     placeholder="Password" 
                     required>
              @error('password')
                  <div class="invalid-feedback">
                      @if($message == 'The password field is required.')
                          Please enter your password
                      @else
                          {{ $message }}
                      @endif
                  </div>
              @enderror
          </div>
          
          <div class="d-flex mt-1 justify-content-between">
              <div class="form-check">
                  <input class="form-check-input input-primary" 
                         type="checkbox" 
                         id="remember" 
                         name="remember" 
                         {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label text-muted" for="remember">Keep me signed in</label>
              </div>
              <a href="{{ route('password.request') }}" class="text-primary">Forgot Password?</a>
          </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">Login</button>
            
            </div>
            @if ($errors->any())
              <div class="card-footer text-body-secondary">
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error )
                      <li>{{$error}}</li>
                      
                    @endforeach
                  </ul>
                </div>
              </div>
              
            @endif
            {{-- <div class="saprator mt-3">
              <span>Login with</span>
            </div> --}}
            {{-- <div class="row">
              <div class="col-4">
                <div class="d-grid">
                  <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                    <img src="../assets/images/authentication/google.svg" alt="img"> <span class="d-none d-sm-inline-block"> Google</span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid">
                  <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                    <img src="../assets/images/authentication/twitter.svg" alt="img"> <span class="d-none d-sm-inline-block"> Twitter</span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid">
                  <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                    <img src="../assets/images/authentication/facebook.svg" alt="img"> <span class="d-none d-sm-inline-block"> Facebook</span>
                  </button>
                </div>
              </div>
            </div> --}}
          </form>
          </div>
        </div>
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
              </ul>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  
    
 
</body>
<!-- [Body] end -->

</html>