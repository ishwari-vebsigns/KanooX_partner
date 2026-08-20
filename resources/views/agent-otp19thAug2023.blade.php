<!DOCTYPE html>
<html lang="en">
  <head>
      <style>
          .bg-primary {
    background-color: #542f6d !important;
}
#sign_in{
        background: #0F3264 !important;
      }
      #imgnew{
        border-radius: 10px;

      }
      </style>
    <!-- Meta tags  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <title>Register</title>
    <link rel="icon" type="login-image/png" href="{{$base_url}}/login-images/favicon.png">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{$base_url}}/login-css/app.css">

    <!-- Javascript Assets -->
    <script src="{{$base_url}}/login-js/app.js" defer=""></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <!-- <link href="css2.css?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> -->
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

    <!-- Page Wrapper -->
    <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak="">
      <div class="fixed top-0 hidden p-6 lg:block lg:px-12">
        <a href="{{$base_url}}/" class="flex items-center space-x-2">
          <img class="h-12 w-30" id="imgnew" src="{{$base_url}}/login-images/logo1234.jpeg" alt="logo">
          {{-- <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
            Vebsigns
          </p> --}}
        </a>
      </div>
      <div class="hidden w-full p-3 place-items-center lg:grid" style="background:url({{$base_url}}/login-images/login_image1.png); background-repeat: no-repeat; background-size: 150%; margin-left: -63px; margin-right: -9px;"></div>
      <main class="flex w-full flex-col items-center bg-white dark:bg-navy-700">
        <div class="flex w-full max-w-sm grow flex-col justify-center p-5">
          <div class="text-center">
            <img class="mx-auto h-16 w-30" id="imgnew" src="{{$base_url}}/login-images/logo1234.jpeg" alt="logo">
            <div class="mt-4">
              <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                Welcome To Bharat Nidhi
              </h2>
              <p class="text-slate-400 dark:text-navy-300">
                Please enter OTP to continue
              </p> 
            </div>
          </div>

          <!--<div class="mt-10 flex space-x-4">-->
          <!--  <button class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">-->
          <!--    <img class="h-5.5 w-5.5" src="login-images/logos/google.svg" alt="logo">-->
          <!--    <span>Google</span>-->
          <!--  </button>-->
            
          <!--</div>-->
          <div class="my-7 flex items-center space-x-3">
            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
            <p class="text-tiny+ uppercase">Enter OTP</p>

            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
          </div>
          <form action="{{$base_url}}/agent" method="post">
            @csrf
          <input placeholder="Enter OTP" type="hidden" value="{{$user->id}}"  name="user_id">
          <div class="mt-4 space-y-4">
            <label class="relative flex">
              <input placeholder="Enter OTP" type="number" name="otp" marlength="6" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==6) return false;" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" >
            </label>
          </div>
        <button id="sign_in" class="btn mt-10 h-10 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            Submit
        </button>
      </form>  
        </div>
      </main>
    </div>

    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script>
       $(document).ready(function() {
    <?php if(session()->has('error')){ ?> 
         
         toastr.error("{{Session::get('error')}}");
        <?php session()->forget('error'); ?>
        <?php }?>
        });
    </script>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>
