<!DOCTYPE html>
<html lang="en">
  <head>
   <style>
    .new{
      background-repeat: no-repeat; 
      background-position: center;
      background-size: cover;

    }
    .card{
      background: transparent !important;
    }
    #imgnew{
        border-radius: 10px;

      }
   </style>
       
    <!-- Meta tags  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Loan Sarovar</title>
    <link rel="icon" type="image/png" href="{{$base_url}}/login-images/Capture23.png">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{$base_url}}/login-css/app.css">

    <!-- Javascript Assets -->
    <script src="{{$base_url}}/login-js/app.js" defer=""></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
          <img class="h-16 w-35" id="imgnew" src="{{$base_url}}/login-images/logo.png" alt="logo">
          {{-- <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
            
          </p> --}}
        </a>
      </div>
      <div class="hidden w-full p-3 place-items-center lg:grid" style="background:url({{$base_url}}/login-images/login1.jpg)">
        
      </div>
      <main class="grid w-full grow grid-cols-1 place-items-center new">
        <div class="w-full max-w-[26rem] p-4 sm:px-5">
          <div class="text-center">
            <img class="mx-auto h-16 w-30" id="imgnew" src="{{$base_url}}/login-images/logo1234.png" alt="logo">
            <div class="mt-4">
              <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                Welcome Back
              </h2>
              <p class="text-slate-400 dark:text-navy-300">
                Please enter Email to continue 
              </p>
            </div>
          </div>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
          @endif
          <form method="POST" action="{{ route('password.update') }}">
           @csrf  
           <input type="hidden" name="token" value="{{ $token }}">
          <div class="card mt-5 rounded-lg p-5 lg:p-7">
            <label class="block">
              <span>Email:</span>
              <span class="relative mt-1.5 flex">
                <input type="email"  required autocomplete="email" autofocus class="form-input @error('email') is-invalid @enderror peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Username" name="email" value="{{ $email ?? old('email') }}">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </span>
                
              </span>
              @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>
            <label class="mt-4 block">
                <span>Password:</span>
                <span class="relative mt-1.5 flex">
                  <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" type="password" name="password">
                  <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                  </span>
                </span>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </label>
              <label class="mt-4 block">
                <span>Confirm Password:</span>
                <span class="relative mt-1.5 flex">
                  <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Enter New Password Again" type="password">
                  <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                  </span>
                </span>
              </label>
            <button type="submit" class="btn mt-5 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
             Change Password
            </button>
        </form>
           
            <!--<div class="my-7 flex items-center space-x-3">-->
            <!--  <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>-->
            <!--  <p>OR</p>-->
            <!--  <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>-->
            <!--</div>-->
            <!--<div class="flex space-x-4">-->
            <!--  <button class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">-->
            <!--    <img class="h-5.5 w-5.5" src="login-images/logos/google.svg" alt="logo">-->
            <!--    <span>Google</span>-->
            <!--  </button>-->
            <!--  <button class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">-->
            <!--    <img class="h-5.5 w-5.5" src="login-images/logos/github.svg" alt="logo">-->
            <!--    <span>Github</span>-->
            <!--  </button>-->
            <!--</div>-->
          </div>
          <div class="mt-8 flex justify-center text-xs text-slate-400 dark:text-navy-300">
            <a href="#">Privacy Notice</a>
            <div class="mx-3 my-1 w-px bg-slate-200 dark:bg-navy-500"></div>
            <a href="#">Term of service</a>
          </div>
        </div>
      </main>
    </div>

    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
     $('#asd').on('click',function(e){
    window.location.href = "https://agent.bharatnidhi.com/";
     }
   );    </script>
  </body>
</html>
