<!DOCTYPE html>
<html lang="en">
<style>
    .col-form-label {
        color: black !important;
    }
    .profile {
        margin-bottom: 30px;
        text-align: center;
    }
    .radio-inputs{
            margin: auto !important;
        }
    .profile img {
        display: block;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        margin: 0 auto;
    }

    .profile h3 {
        color: #ffffff;
        margin: 10px 0 5px;
    }

    .profile p {
        color: rgb(206, 240, 253);
        font-size: 14px;
    }

    .nav-header .logo-abbr {
        max-width: 70px !important;
        border-radius: 50%;
    }

    p {
        margin-left: 12px;
    }
    @media only screen and (max-width: 300px){
        .nav-header {
            width: 0px !important;
        }
        #chatbox{
            width:auto;
        }
    }
     
    @media only screen and (max-width: 767px){
        .nav-header {
            width: 0px !important;
        }
        #chatbox{
            width:auto;
        }
    }
     
    @media (max-width: 685px) { 
        #chatbox{
            width:auto;
        }
        
        main header div {
        margin-left: 10px;
        margin-right: 100px;
        }
        #chat .me .triangle {
        border-color: transparent transparent #6fbced transparent;
        margin-left: 251px !important;
        }
        main footer textarea {
        width: 100% !important;
        text-align: center !important;


        }
        #sendbutton {
        margin-top: -106px !important;
        margin-left: 221px !important;
        }
        main header div {
        margin-left: 10px !important;
        margin-right: 100px !important;
        }
        .radio-inputs{
            margin: auto !important;
        }
        iframe{
            width: auto !important;
            height: auto !important;
        }
        #service-view{
            margin: auto !important;
        }
        #notidropdown{
            margin-right: -20px;
            left: -90px;
        }
        #notidropdown li{
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
        }
    }
    @media (max-width: 1215px) { 
        .profile {
            display: none !important;
        }
    }
    @if(Auth::user()!=null)
    @if(Auth::user()->role_id==2)

    .quixnav {
        background-color: #0F3264 !important;
    }
    .nav-header {
        background-color: #0F3264 !important;
    }
    @endif
    /*@if(Auth::user()->role_id==1)*/
    /*.quixnav {*/
    /*    background-color: #59676a !important;*/
    /*}*/
    /*.nav-header {*/
    /*    background-color: #59676a !important;*/
    /*}*/
    /*@endif*/
    @endif
    .odd{
    color:#000000 !important;
}
.even{
    color:#000000 !important;
}

</style>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/bfef24457e.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>KanooX</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{$base_url}}/login-images/favicon.png">
    <link rel="stylesheet" href="{{ $base_url }}/vendordashboard/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ $base_url }}/vendordashboard/owl-carousel/css/owl.theme.default.min.css">
    <link href="{{ $base_url }}/vendordashboard/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="{{ $base_url }}/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{$base_url}}/vendordashboard/metismenu/css/metisMenu.min.css">
    
     <link rel="stylesheet" href="https://bharatnidhi.com/panel/vendor/perfect-scrollbar/css/perfect-scrollbar.css">
    <!--<script src="{{$base_url}}/vendor/metismenu/css/metisMenu.min.css"></script>-->
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->

        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.admin-header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
            
        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts.left-menu')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('layouts.admin-footer')
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
      
        function getnotid(id, notid){
            var id1 = id;
            var notifid = notid;
            /* alert(id); */
            $.ajax({
                url:"{{$base_url}}/sendnotificationdetails",
                type:"post",
                data:{
                "_token": "{{ csrf_token() }}","id1":id1,"notifid":notifid,
                },
                /* success:function(res){
                $('#newappend').append(res);
                } */
            });
                
            }

            $(document).ready(function() {
            var isJobsVisible = false;
            var jobsElement = $('#jobs');

            $('.hamburger').click(function() {
                if (isJobsVisible) {
                jobsElement.hide();
                isJobsVisible = false;
                } else {
                jobsElement.show();
                isJobsVisible = true;
                }
            });
            });


    </script>
    <!-- Required vendors -->


    <!-- Vectormap -->
    <script src="{{ $base_url }}/vendordashboard/raphael/raphael.min.js"></script>
    <script src="{{ $base_url }}/vendordashboard/morris/morris.min.js"></script>
    

    <script src="{{ $base_url }}/vendordashboard/circle-progress/circle-progress.min.js"></script>
    <script src="{{ $base_url }}/vendordashboard/chart.js/Chart.bundle.min.js"></script>

    <script src="{{ $base_url }}/vendordashboard/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="{{ $base_url }}/vendordashboard/flot/jquery.flot.js"></script>
    <script src="{{ $base_url }}/vendordashboard/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="{{ $base_url }}/vendordashboard/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="{{ $base_url }}/vendordashboard/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="{{ $base_url }}/vendordashboard/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="{{ $base_url }}/vendordashboard/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="{{ $base_url }}/js/dashboard/dashboard-1.js"></script>

</body>

</html>
