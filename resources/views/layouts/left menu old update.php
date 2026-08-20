@if(Auth::user()->role_id==1)
<style>
    
    .main-menu.menu-light .navigation .navigation-header {
    color: #fff;
    /* margin: 2rem 0 0.8rem 2.2rem; */
    padding: 0;
    line-height: 1.5;
    letter-spacing: .01rem;
    background: dodgerblue;
    margin-top: 10px;
    margin-bottom: 17px;
    padding: 10px;
    text-align: center;
    font-weight: 700 !important;
    margin-left: 0px;
}
.logo-image {
    width: 133px !important;
}
.main-menu.menu-light .navigation .navigation-header span {
    font-weight: 900;
    font-size: 16px;
}
/*.logo-image{*/
/*    width:200px !important;*/
/*}*/
.main-menu.menu-light .navigation>li.open>a, .main-menu.menu-light .navigation>li.sidebar-group-active>a {
    color: #fff;
    background: #542f6d;
    transition: transform .25s ease 0s;
    border-radius: 0px;
    /* margin-bottom: 7px; */
}
.main-menu.menu-light .navigation>li {
    padding: 0 0px;
}

.main-menu.menu-light .navigation>li.nav-item>a, .main-menu.menu-light .navigation>li.sidebar-group-active>a {
    color: #fff;
    background: #6f6f6f !important;
    transition: transform .25s ease 0s;
    border-radius: 0px;
    /* margin-bottom: 7px; */
}

.dot {
  height: 25px;
  width: 25px;
  background-color: #eb2a2a;
  border-radius: 50%;
  display: inline-block;
}
.flip-card {
    position: relative;
    -webkit-perspective: 800;
    -moz-perspective: 800;
    -ms-perspective: 800;
    -o-perspective: 800;
    perspective: 800;
    border-radius: 10px;
}
.widget-bank-card {
    margin: 20px;
}
.flip-card .card {
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 10px;
    box-shadow: none;
    cursor: pointer;
    /* background: linear-gradient(82.27deg, #3c488d 30.13%, #505dad 127.45%) !important; */
    background: linear-gradient(82.27deg, #0a2578 30.13%, #1247e5 127.45%) !important;
}
.flip-card .card div {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -o-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 10px;
    color: #d3d3d3;
    padding: 0px 8px;
    font: 16px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-smoothing: antialiased;
}
.flip-card .card .back {
    position: absolute;
    /* top: 15%; */
    left: 0%;
    width: 100%;
}
.active{
 left: 0;
}
h1{

  text-align: center;
  font-weight: 500;
  font-size: 25px;
  padding-bottom: 13px;
  font-family: sans-serif;
  letter-spacing: 2px;
}

 .menu{
 width: 100%;
 /* margin-top: 10px;
 margin-bottom: 12px; */
}

 .menu .item{
  background: #6f6f6f !important;
 position: relative;
 cursor: pointer;
}

 .menu .item a{
 color: #fff;
 font-size: 16px;
 text-decoration: none;
 display: block;
 padding: 5px 30px;
 line-height: 60px;
}

 .menu .item a:hover{
 
 transition: 0.3s ease;
}

.menu .item i{
  /* background: #33363a; */
 margin-right: 15px;
}

 .menu .item a .dropdown{
 
 position: absolute;
 right: 0;
 margin: 8px;
 transition: 0.3s ease;
 left: 232px;

}

 .menu .item .sub-menu{
 background: #54d0ff;
 display: none;
}

 .menu .item .sub-menu a{
 padding-left: 80px;
}
.main-menu.menu-light .navigation li a {
    color: #fff !important;
}
.rotate{
 transform: rotate(90deg);
}

.close-btn{
 position: absolute;
 color: #fff;

 font-size: 23px;
 right:  0px;
 margin: 15px;
 cursor: pointer;
}

.menu-btn{
 position: absolute;
 color: rgb(0, 0, 0);
 font-size: 35px;
 margin: 25px;
 cursor: pointer;
}

.main{
 height: 100vh;
 display: flex;
 justify-content: center;
 align-items: center;
 padding: 50px;
}

.main h1{
 color: rgba(255, 255, 255, 0.8);
 font-size: 60px;
 text-align: center;
 line-height: 80px;
}

@media (max-width: 900px){
 .main h1{
   font-size: 40px;
   line-height: 60px;
 }
}
#margin-top{
  margin-top:0px !important;
}
.main-menu{
  background-color: #6f6f6f !important;
}
</style>

@php
$user=Auth::user();
$role_id=$user->role_id;
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" href="javascript:void(0);">
       
             
             <img src="{{$base_url}}/web-assets/images/resources/logo.png" alt="logo" class="logo-image">
       
       
      </a></li>

    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      
       <li class="nav-item" id="margin-top">
                        <a href="{{config('app.baseURL')}}/admin/dashboard">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Dashboard</span>
                                                    </a>
                                                                                         
    
    </li>
      
      
      
     
    <!-- <div class="side-bar"> -->

    
     <div class="menu">
     
      <li class="item">
         <a class="sub-btn" style="margin-left: 32px;"><span class="menu-title" data-i18n="">Services</span><i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
         <a href="{{$base_url}}/admin/service/all" class="sub-item" style="margin-left: 32px;">All Services</a>
         <a href="{{$base_url}}/admin/sub-services/all" class="sub-item" style="margin-left: 32px;">All Sub-Services</a>
         <!-- <a href="{{$base_url}}/admin/bank/all" class="sub-item" style="margin-left: 32px;">All Banks</a> -->
          
         </div>
      </li>
      
     </div>
<!-- </div> -->
      <li class="nav-item ">
                        <a href="{{$base_url}}/admin/bank/all">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Banks</span>
                                                    </a>
                                                                                            
    
    </li>
    <li class="nav-item ">
                        <a href="{{$base_url}}/admin/help&support/all">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Help & Support</span>
                                                    </a>
                                                                                            
    
    </li>
      
    
      <li class="nav-item ">
                        <a href="{{$base_url}}/admin/agent-profile">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Profile</span>
                                                    </a>
                                                                                            
    
    </li>
    
    <!-- <li class="nav-item ">
                        <a href="javascript:void(0);">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Training</span>
                                                    </a>
                                                                                            
    
    </li> -->
    
       <!-- <li class="nav-item ">
                        <a href="{{$base_url}}/admin/support">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Help & Support</span>
                                                    </a>
                                                                                            
    
    </li> -->
    
     
    <div class="menu">
     
     <li class="item">
       <a class="sub-btn" style="margin-left: 32px;"><span class="menu-title" data-i18n="">Reports</span><i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="{{$base_url}}/admin/report/customer-report" class="sub-item" style="margin-left: 32px;">Loan Reports</a>
         <a href="{{$base_url}}/admin/report/commision-report" class="sub-item" style="margin-left: 32px;">Commission Report</a>
         <!-- <a href="{{$base_url}}/admin/services/cards" class="sub-item" style="margin-left: 32px;">Cards</a> -->
         <!-- <a href="{{$base_url}}/admin/services/bank/loan-type" class="sub-item" style="margin-left: 32px;">Mutual Funds</a> -->
         <!-- <a href="{{$base_url}}/admin/services/bank/loan-type" class="sub-item" style="margin-left: 32px;">Lockers</a> -->

       </div>
</li>
    
    
   </div>
    
      
      
      
      
     

            
<!--<div class="buy-now no-print" style="margin-left:20px;">-->
<!--    <a href="{{config('app.baseURL')}}" class="btn btn-danger">Switch To Website</a>-->
<!--</div>-->
              
     
            
           
            
             



            </ul>
          </div>
        </div>
<!-- END: Main Menu-->
<script type="text/javascript">
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     $('.menu-btn').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn').css("visibility", "visible");
     });
   });
   </script>
@endif
@if(Auth::user()->role_id==2)
<style>
    
    .main-menu.menu-light .navigation .navigation-header {
    color: #fff;
    /* margin: 2rem 0 0.8rem 2.2rem; */
    padding: 0;
    line-height: 1.5;
    letter-spacing: .01rem;
    background: dodgerblue;
    margin-top: 10px;
    margin-bottom: 17px;
    padding: 10px;
    text-align: center;
    font-weight: 700 !important;
    margin-left: 0px;
}
.logo-image {
    width: 133px !important;
}
.main-menu.menu-light .navigation .navigation-header span {
    font-weight: 900;
    font-size: 16px;
}
/*.logo-image{*/
/*    width:200px !important;*/
/*}*/
.main-menu.menu-light .navigation>li.open>a, .main-menu.menu-light .navigation>li.sidebar-group-active>a {
    color: #fff;
    background: #542f6d;
    transition: transform .25s ease 0s;
    border-radius: 0px;
    /* margin-bottom: 7px; */
}
.main-menu.menu-light .navigation>li {
    padding: 0 0px;
}
.main-menu ul.navigation-main>li:first-child {
    margin-top: 0px !important;
}
.main-menu.menu-light .navigation>li.nav-item>a, .main-menu.menu-light .navigation>li.sidebar-group-active>a {
    color: #fff;
    background: #31abfc !important;
    transition: transform .25s ease 0s;
    border-radius: 0px;
    /* margin-bottom: 7px; */
}

.dot {
  height: 25px;
  width: 25px;
  background-color: #eb2a2a;
  border-radius: 50%;
  display: inline-block;
}
.flip-card {
    position: relative;
    -webkit-perspective: 800;
    -moz-perspective: 800;
    -ms-perspective: 800;
    -o-perspective: 800;
    perspective: 800;
    border-radius: 10px;
}
.widget-bank-card {
    margin: 20px;
}
.flip-card .card {
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 10px;
    box-shadow: none;
    cursor: pointer;
    /* background: linear-gradient(82.27deg, #3c488d 30.13%, #505dad 127.45%) !important; */
    background: linear-gradient(82.27deg, #0a2578 30.13%, #1247e5 127.45%) !important;
}
.flip-card .card div {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -o-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 10px;
    color: #d3d3d3;
    padding: 0px 8px;
    font: 16px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-smoothing: antialiased;
}
.flip-card .card .back {
    position: absolute;
    /* top: 15%; */
    left: 0%;
    width: 100%;
}
.active{
 left: 0;
}
h1{

  text-align: center;
  font-weight: 500;
  font-size: 25px;
  padding-bottom: 13px;
  font-family: sans-serif;
  letter-spacing: 2px;
}

 .menu{
 width: 100%;
 /* margin-top: 10px;
 margin-bottom: 12px; */
}

 .menu .item{
  background: #31abfc !important;
 position: relative;
 cursor: pointer;
}

 .menu .item a{
 color: #fff;
 font-size: 16px;
 text-decoration: none;
 display: block;
 padding: 5px 30px;
 line-height: 60px;
}

 .menu .item a:hover{
 
 transition: 0.3s ease;
}

.menu .item i{
  /* background: #33363a; */
 margin-right: 15px;
}

 .menu .item a .dropdown{
 
 position: absolute;
 right: 0;
 margin: 8px;
 transition: 0.3s ease;
 left: 232px;

}

 .menu .item .sub-menu{
 background: #54d0ff;
 display: none;
}

 .menu .item .sub-menu a{
 padding-left: 80px;
}
.main-menu.menu-light .navigation li a {
    color: #fff !important;
}
.rotate{
 transform: rotate(90deg);
}

.close-btn{
 position: absolute;
 color: #fff;

 font-size: 23px;
 right:  0px;
 margin: 15px;
 cursor: pointer;
}

.menu-btn{
 position: absolute;
 color: rgb(0, 0, 0);
 font-size: 35px;
 margin: 25px;
 cursor: pointer;
}

.main{
 height: 100vh;
 display: flex;
 justify-content: center;
 align-items: center;
 padding: 50px;
}

.main h1{
 color: rgba(255, 255, 255, 0.8);
 font-size: 60px;
 text-align: center;
 line-height: 80px;
}

@media (max-width: 900px){
 .main h1{
   font-size: 40px;
   line-height: 60px;
 }
}


</style>

@php
$user=Auth::user();
$role_id=$user->role_id;
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" href="javascript:void(0);">
       
             
             <img src="http://fintech.vebsignsautomation.com/web-assets/images/resources/logo.png" alt="logo" class="logo-image">
       
       
      </a></li>

    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      
       <li class="nav-item">
                        <a href="{{config('app.baseURL')}}/admin/dashboard">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Dashboard</span>
                                                    </a>
                                                                                         
    
    </li>
      
      
      
     


    
     <div class="menu">
     
     <li class="item">
         <a class="sub-btn" style="margin-left: 32px;"><span class="menu-title" data-i18n="">Services</span><i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
          @foreach($mservices as $service)
           <a href="{{$base_url}}/admin/services/{{$service->service_url}}" class="sub-item" style="margin-left: 32px;">{{$service->service_name}}</a>
          @endforeach 
         </div>
</li>
     </div>

    
      
    
      <li class="nav-item ">
                        <a href="{{$base_url}}/admin/agent-profile">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Profile</span>
                                                    </a>
                                                                                            
    
    </li>
    
    <li class="nav-item ">
                        <a href="javascript:void(0);">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Training</span>
                                                    </a>
                                                                                            
    
    </li>
    
       <li class="nav-item ">
                        <a href="{{$base_url}}/admin/help&support/all">
                            <i class="feather icon-shopping-cart" style="visibility:hidden;"></i>
                            <span class="menu-title" data-i18n="">Help & Support</span>
                                                    </a>
                                                                                            
    
    </li>
    
     
    <div class="menu">
     
     <li class="item">
       <a class="sub-btn" style="margin-left: 32px;"><span class="menu-title" data-i18n="">Reports</span><i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="{{$base_url}}/admin/report/customer-report" class="sub-item" style="margin-left: 32px;">Loan Reports</a>
         <a href="{{$base_url}}/admin/report/commision-report" class="sub-item" style="margin-left: 32px;">Commission Report</a>
         <!-- <a href="{{$base_url}}/admin/services/cards" class="sub-item" style="margin-left: 32px;">Cards</a> -->
         <!-- <a href="{{$base_url}}/admin/services/bank/loan-type" class="sub-item" style="margin-left: 32px;">Mutual Funds</a> -->
         <!-- <a href="{{$base_url}}/admin/services/bank/loan-type" class="sub-item" style="margin-left: 32px;">Lockers</a> -->

       </div>
</li>
    
    
   </div>
    

      
      
      
      
     

            
<!--<div class="buy-now no-print" style="margin-left:20px;">-->
<!--    <a href="{{config('app.baseURL')}}" class="btn btn-danger">Switch To Website</a>-->
<!--</div>-->
              
     
            
           
            
             



            </ul>
          </div>
        </div>
<!-- END: Main Menu-->
<script type="text/javascript">
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     $('.menu-btn').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn').css("visibility", "visible");
     });
   });
   </script>
@endif
