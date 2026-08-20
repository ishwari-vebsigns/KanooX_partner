<!DOCTYPE html>
<html lang="en">
  <head>
   <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    .fullscreen-bg {
      min-height: 100vh;
      width: 100%;
      background-color: #f8fafc;
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      background-attachment: fixed;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      box-sizing: border-box;
    }

    .login-wrapper {
      width: 100%;
      max-width: 26rem;
    }

    .field-icon {
      position: absolute;
      top: 50%;
      right: 1rem;
      transform: translateY(-50%);
      cursor: pointer;
      z-index: 9999999999999999999;
    }

    .field-icon:hover {
      color: #333333;
    }

    .card{
      background: rgba(255, 255, 255, 0.92) !important;
      backdrop-filter: blur(6px);
      box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    #sign_in{
      background: #9D3895 !important;
    }

    .error-message{
      color:red;
      font-weight: bold;
    }

    .footer-links{
      color: rgba(255,255,255,0.85);
    }

    .footer-links a{
      color: rgba(255,255,255,0.95) !important;
    }
   </style>

    <!-- Meta tags  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>KanooX</title>
    <link rel="icon" type="image/png" href="{{$base_url}}/login-images/favicon.png">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="login-css/app.css">

    <!-- Javascript Assets -->
    <script src="login-js/app.js" defer=""></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
      /**
       * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
       */
      localStorage.getItem("_x_darkMode_on") === "true" &&
        document.documentElement.classList.add("dark");
    </script>
  </head>
  <body x-data="" class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
      <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>

    <!-- Page Wrapper: full-screen background image with centered form -->
    <div id="root" class="fullscreen-bg" style="background-image:url({{$base_url}}/login-images/admin-img2.png);" x-cloak="">
      <div class="login-wrapper">
        <div class="text-center">
          <img class="mx-auto h-16 w-30" id="imgnew" src="login-images/logo.png" alt="logo">
          <div class="mt-4">
            <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
              Welcome Back
            </h2>
            <p class="text-slate-400 dark:text-navy-300">
              Please sign in to continue
            </p>
          </div>
        </div>
        <form method="POST" action="{{ route('login') }}">
         @csrf
         @error('email')
         <center><span class="error-message">{{ $message }}</span></center>
         @enderror
        <div class="card mt-5 rounded-lg p-5 lg:p-7">
          <label class="block">
            <span>Email:</span>
            <span class="relative mt-1.5 flex">
              <input type="email" required value="{{old('email')}}" autocomplete="email" autofocus class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Username" name="email">

              <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>

              </span>
            </span>
          </label>
          @if ($errors->has('email'))
          <span class="help-block error-message">
          <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
          <label class="mt-4 block">
            <span>Password:</span>
            <span class="relative mt-1.5 flex">
              <input id="password-field" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Password" type="password" name="password">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

              <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </span>

            </span>
          </label>
          @if ($errors->has('password'))
          <span class="help-block error-message">
          <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
          <div class="mt-4 flex items-center justify-between space-x-2">
            <label class="inline-flex items-center space-x-2">
              <input class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox">
              <span class="line-clamp-1">Remember me</span>
            </label>
            <!-- <a href="{{$base_url}}/password/reset" class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100 dark:focus:text-navy-100">Forgot Password?</a> -->
          </div>
          <button id='sign_in' class="btn mt-5 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            Sign In
          </button>
      </form>
          <div class="mt-4 text-center text-xs+">
            <!-- <p class="line-clamp-1">
              <span>Dont have Account?</span>

              <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{$base_url}}\register-agent">Create account</a>
            </p> -->
          </div>
        </div>
        <div class="mt-8 flex justify-center text-xs footer-links">
          <a href="#">Privacy Notice</a>
          <div class="mx-3 my-1 w-px bg-white/30"></div>
          <a href="#">Term of service</a>
        </div>
      </div>
    </div>

    <!--
        This is a place for Alpine.js Teleport feature
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>

    <script>
     $( document ).ready(function() {
      @if(Session::has('success'))
              toastr.success('{{ Session::get('success') }}', 'Success');
          @endif
      @php
      session()->forget('success');
      @endphp
  });
  </script>
   <script>
      // Toggle password visibility
      $(document).ready(function() {
        $(".toggle-password").click(function() {
          $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $($(this).attr("toggle"));
          if (input.attr("type") == "password") {
            input.attr("type", "text");
          } else {
            input.attr("type", "password");
          }
        });
      });
    </script>
<script>
   $( document ).ready(function() {
    @if(session('success'))
    toastr.success("{{Session::get('success')}}", "Success!", {
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
    @endif
    @php
    session()->forget('success');
    @endphp
});
</script>

    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
     $('#asd').on('click',function(e){
    window.location.href = "http://localhost/fintech/";
     }
   );    </script>
  </body>
</html>