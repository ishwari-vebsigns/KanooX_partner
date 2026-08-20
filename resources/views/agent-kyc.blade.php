<!DOCTYPE html>
<html lang="en">
  <head>
      <style>
        .drop-container {
  position: relative;
  display: flex;
  gap: 10px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 200px;
  padding: 20px;
  border-radius: 10px;
  border: 2px dashed #555;
  color: #444;
  cursor: pointer;
  transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
  background: #eee;
  border-color: #111;
}

.drop-container:hover .drop-title {
  color: #222;
}

.drop-title {
  color: #444;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
}
          .bg-primary {
    background-color: #542f6d !important;
}
#sign_in{
        background: #0F3264 !important;
      }
        .afont-color{
        color: blue;
      }
      </style>
    <!-- Meta tags  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Register</title>
    <link rel="icon" type="login-image/png" href="{{$base_url}}/login-images/favicon.png">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{$base_url}}/login-css/app.css">

    <!-- Javascript Assets -->
    <script src="{{$base_url}}/login-js/app.js" defer=""></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2.css?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
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
          <img class="h-12 w-30" src="{{$base_url}}/login-images/logo.png" alt="logo">
          {{-- <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
            Vebsigns
          </p> --}}
        </a>
      </div>
      <div class="hidden w-full p-3 place-items-center lg:grid" style="background:url({{$base_url}}/login-images/login1.jpg); background-repeat: no-repeat; background-size: 150%; margin-left: -63px; margin-right: -9px;"></div>
      <main class="flex w-full flex-col items-center bg-white dark:bg-navy-700">
        <div class="flex w-full max-w-sm grow flex-col justify-center p-5">
          <div class="text-center">
            <img class="mx-auto h-16 w-16 lg:hidden" src="{{$base_url}}/login-images/logo.png" alt="logo">
            <div class="mt-4">
              <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                Welcome To Loan Sarovar
              </h2>
              <p class="text-slate-400 dark:text-navy-300">
                Please enter Details to continue
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
            <p class="text-tiny+ uppercase">Bank Account Details</p>

            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
          </div>
          <form action="{{$base_url}}/agent-kyc" method="post"  enctype='multipart/form-data'>
            @csrf
          <div class="mt-4 space-y-4">
            <label class="relative flex">
            <input placeholder="Bank Name" name="id" type="hidden" value="{{$id}}">
              <input placeholder="Bank Name" name="bank_name" value="{{old('bank_name')}}" type="text" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
            </label>
            @if ($errors->has('bank_name'))
            <span class="help-block">
            <strong>{{ $errors->first('bank_name') }}</strong>
            </span> 
            @endif
            <label class="relative flex">
              <input placeholder="Account Holder Name" name="name" value="{{old('name')}}" type="text" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
            </label>
            @if ($errors->has('name'))
            <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
            </span> 
            @endif
            <label class="relative flex">
              <input placeholder="IFSC Code" value="{{old('ifsc_code')}}" name="ifsc_code" type="ifsc" data-gtm-form-interact-field-id="0" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
            </label>
            @if ($errors->has('ifsc_code'))
            <span class="help-block">
            <strong>{{ $errors->first('ifsc_code') }}</strong>
            </span> 
            @endif
            <label class="relative flex">
              <input placeholder="Account No." value="{{old('account_number')}}" name="account_number" type="number" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==15) return false;" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
            </label>
            @if ($errors->has('account_number'))
            <span class="help-block">
            <strong>{{ $errors->first('account_number') }}</strong>
            </span> 
            @endif
            <label class="relative flex">
                Upload Aadhar Front             
            </label>

              <input placeholder="Upload Aadhar Front" name="front" type="file" accept="image/*" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
              @if ($errors->has('front'))
              <span class="help-block">
              <strong>{{ $errors->first('front') }}</strong>
              </span> 
              @endif
            <label class="relative flex">
                Upload Aadhar back 
            </label>
              <input placeholder="Upload Aadhar Front" name="back" type="file" accept="image/*" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
              @if ($errors->has('back'))
              <span class="help-block">
              <strong>{{ $errors->first('back') }}</strong>
              </span> 
              @endif
            <label class="relative flex">
                Upload PAN Card 
            </label>
              <input placeholder="Upload Aadhar Front" name="pan" type="file" accept="image/*" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
                @if ($errors->has('pan'))
              <span class="help-block">
              <strong>{{ $errors->first('pan') }}</strong>
              </span> 
              @endif
              <label class="relative flex">
                Upload KYC Video (Please upload kyc within 5MB) 
            </label>
              <input placeholder="Upload KYCVideo" name="kyc_video" type="file" accept="video/*" class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" required>
              @if ($errors->has('kyc_video'))
            <span class="help-block">
            <strong>{{ $errors->first('kyc_video') }}</strong>
            </span> 
            @endif
            </div>
            <div class="mt-4 flex items-center space-x-2">
              <input class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent" name="privacy" type="checkbox" required>
              <p class="">
                I agree to the <a href="{{$base_url}}/assets/t&c.docx" class="afont-color">Terms of Agreement & Privacy Policy </a> of Loan Sarovar
                
              </p>
               

            </div>
            @if ($errors->has('privacy'))
            <span class="help-block">
            <strong>{{ $errors->first('privacy') }}</strong>
            </span> 
            @endif
          <button id='sign_in' class="btn mt-10 h-10 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            Submit
          </button>
      </form>
          <!-- <div class="mt-4 text-center text-xs+">
            <p class="line-clamp-1">
              <span>Already have an account? </span>
              <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{config('app.baseURL')}}/login">Sign In</a>
            </p>
          </div> -->
        </div>
      </main>
    </div>

    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#sign_in').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var submitButton = $(this);

            if (!submitButton.prop('disabled')) {
                submitButton.prop('disabled', true); // Disable the button

                // Perform any additional actions before form submission if needed

                // Submit the form after a short delay
                setTimeout(function() {
                    submitButton.prop('disabled', false); // Enable the button
                    submitButton.closest('form').submit(); // Submit the form
                }, 500); // Adjust the delay as needed
            }
        });
    });
</script>

    <!-- <script>
        $("[type=file]").on("change", function(){
  // Name of file and placeholder
  var file = this.files[0].name;
  var dflt = $(this).attr("placeholder");
  if($(this).val()!=""){
    $(this).next().text(file);
  } else {
    $(this).next().text(dflt);
  }
});
    </script> -->
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>
