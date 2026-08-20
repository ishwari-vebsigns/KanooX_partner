@extends('layouts.admin-app')
@section('content')
<style>
  #card1{
    background-color: #b39ab429;
  }
  .default{
    visibility:hidden;
  }
    .navpaddingone{
        padding-left:20px;
    }
    .nav-pills>li.active>a.navpaddingone {
    color: #fff;
    background-color: #542f6d;
    padding: 10px;
    border-radius: 5px;
    margin-left: 10px;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Loans</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="{{$base_url}}/admin/dashboard"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{$base_url}}/admin/services"> Services </a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{$base_url}}/admin/services/bank"> Loans </a>
              </li>
              <li class="breadcrumb-item">
              All                                </li>
            </ol> 
          </div>
        </div>
      </div>
    </div>

  </div>                    
  <div class="content-body">

  <ul class="nav nav-pills">
    <li class="navpadding active"><a class="navpaddingone" data-toggle="pill" href="#home">Axis bank</a></li>
    <li class="navpadding"><a  class="navpaddingone" data-toggle="pill" href="#menu1">Kotak Bank</a></li>
    <li class="navpadding"><a  class="navpaddingone" data-toggle="pill" href="#menu2">ICICI Bank</a></li>
    <li class="navpadding"><a  class="navpaddingone" data-toggle="pill" href="#menu3">HDFC Bank</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active show">
    <section id="dashboard-analytics">
      <div class="row">  
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%; background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start">
               <img src="{{$base_url}}/web-assets/images/resources/personal-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Personal Loan</h2>
                </a>
                  <p class="headline2-loan"></p>
                  <a href="#" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/home-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Home Loan</h2>
                </a>
                  <p class="headline2-loan"></p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/gold-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Gold Loan</h2>
                </a>
                  <p class="headline2-loan"></p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/vehical-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Vehical Loan</h2>
                </a>
                  <p class="headline2-loan"></p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <div id="menu1" class="tab-pane fade">
    <section id="dashboard-analytics">
      <div class="row">  
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div id="card1" class="card" style="width:100%;">
            <div class="card-header d-flex flex-column align-items-start">
               <img src="{{$base_url}}/web-assets/images/resources/personal-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Personal Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="#" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div id="card1" class="card" style="width:100%; background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/home-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Home Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/gold-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Gold Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/vehical-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Vehical Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/vehical-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Vehical Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <div id="menu2" class="tab-pane fade">
    <section id="dashboard-analytics">
      <div class="row">  
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start">
               <img src="{{$base_url}}/web-assets/images/resources/personal-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Personal Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="#" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/home-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Home Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/gold-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Gold Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/vehical-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Vehical Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <div id="menu3" class="tab-pane fade">
    <section id="dashboard-analytics">
      <div class="row">  
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start">
               <img src="{{$base_url}}/web-assets/images/resources/personal-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Personal Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="#" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/home-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Home Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/gold-loan-icon.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Gold Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 d-flex">
          <div class="card" style="width:100%;  background-color: #b39ab429;">
            <div class="card-header d-flex flex-column align-items-start pb-0">
               <img src="{{$base_url}}/web-assets/images/resources/vehical-loan-icon1.png" class="rounded-lg object-cover img-design" alt="image"  width="80" height="80">
                <a href="#">
                  <h2 class="headline-loan">Vehical Loan</h2>
                </a>
                  <p class="headline2-loan">Total Registered Users</p>
                  <a href="" class="bank-button btn btn-red">Check <i class="feather icon-right"></i></a>                
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
  </div>

</div>

<main id="removedefault" class="default">      
        <!-- <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
          <div class="col-span-12 sm:col-span-8">
            <div class="card p-4 sm:p-5">
              <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                Form
              </p>
            
            </div>
          </div>
        </div> -->
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="card space-y-5 p-4 col-span-12 sm:col-span-6">
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                Apply
              </p>
              <!-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-12"> -->
                  <label class="block sm:col-span-8">
                    <span>Pincode</span>
                    <div class="relative mt-1.5 flex">
                      <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Pincode" type="text">
                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="feather icon-map-pin"></i>
                      </span>
                    </div>
                  </label>
                <!-- </div> -->
                <!-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-12"> -->
                  <label class="block sm:col-span-8">
                    <span>Phone No.</span>
                    <div class="relative mt-1.5 flex">
                      <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Email Phone No." type="text">
                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="feather icon-phone"></i>
                      </span>
                    </div>
                  </label>
                <!-- </div> -->
                  <div class="flex justify-end">
                  <a href="{{$base_url}}/admin/services/bank/loan/otp" style="color: white !important;"><button class="btn space-x-2 bg-primary font-medium text-white focus:bg-primary-focus dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    Next</a>
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewbox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg> -->
                  </button>
                </div>
            </div>
            
          </div>
      </main>
<script class="">
  $(".bank-button").click(function(){
    $("#dashboard-analytics").hide();
    $("#removedefault").removeClass("default");
    
});

$(".navpaddingone").click(function(){
    // $("#dashboard-analytics").hide();
    // $("#removedefault").hide();
    
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

