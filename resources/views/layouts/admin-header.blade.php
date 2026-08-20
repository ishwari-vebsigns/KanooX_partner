<!-- Vectormap -->
<script src="{{$base_url}}/vendordashboard/global/global.min.js"></script>
{{--
<script src="{{$base_url}}/vendordashboard/raphael/raphael.min.js"></script> --}}
{{--
<script src="{{$base_url}}/vendor/morris/morris.min.js"></script> --}}

<style>
    .header-right .nav-item .nav-link {
        color: #464a53;
        /*        font-size: 26px !important;*/
    }

    .header-right .notification_dropdown .nav-link {
        position: relative;
        color: #464a53;
        font-size: 13px !important;
    }

    .sweet-image-message {
        border: none;
        background: transparent;

    }

    @media only screen and (max-width: 767px) {
        #logoview {
            height: 61px;
            width: 159px;
            text-align: center;
            border-radius: 7px;
        }
    }

    @media screen and (min-width: 768px) and (max-width: 1500px) {
        #logoview {
            /*margin-left: -306px;*/
            height: 61px;
            width: 159px;
            /*text-align: center;*/
            border-radius: 7px;
        }


    }

    .content-body {
        margin-left: 78px !important;
        transition: margin-left .2s ease;
    }

    @media (max-width: 767px) {
        .content-body {
            margin-left: 0 !important;
        }
    }

    .nav-header .brand-title {
        margin: auto;
        margin-left: 43px !inportant;
        max-width: 130px !important;
        /* border-radius: 20px; */
        /* height: 43px; */
        height: 30px;
    }

    /* ===== LOGGED-OUT HEADER LOGO FIX ===== */
    #logoview {
        height: 42px;
        width: auto;
        max-width: 170px;
        object-fit: contain;
    }

    /* Tablet */
    @media (min-width: 768px) {
        #logoview {
            height: 48px;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .navbar-brand {
            padding: 0;
        }

        #logoview {
            height: 38px;
            max-width: 150px;
        }
    }

    .nav-control {
        display: none !important;
    }
</style>

<!-- Owl Carousel -->
<script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
<!--<link href="{{$base_url}}/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">-->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@if(Auth::user() != null)
    <div class="nav-header">
        <a href="{{ url('/admin/dashboard') }}" class="brand-logo">
            <img class="logo-compact" src="{{$base_url}}/images/logo-text.png" alt="">

            <img class="brand-title" src="{{$base_url}}/images/logo.png" alt="">
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
@else

@endif
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="search_bar dropdown">

                        @if(Auth::user() == null)
                            <div class="navbar-brand d-flex align-items-center">
                                <img id="logoview" src="{{$base_url}}/login-images/logo.png" alt="logo">
                            </div>
                        @endif



                    </div>
                </div>

                <ul class="navbar-nav header-right">
                    @if(Auth::user() != null)
                        @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)

                            @if(isset($agentqr) && $agentqr->agent_qr != null)
                                <li class="nav-item dropdown notification_dropdown">
                                    <button class="sweet-image-message">
                                        <lord-icon src="https://cdn.lordicon.com/fqrjldna.json" trigger="hover"
                                            colors="outline:#121331,primary:#3a3347,secondary:#fffdfd"
                                            style="width:35px;height:35px">
                                        </lord-icon>
                                    </button>
                                </li>
                            @endif
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa-sharp fa-solid fa-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" id="notidropdown">
                                    <ul class="list-unstyled">
                                        @foreach($mnotifications->take(5) as $mnotification)
                                            @if($mnotification->type == 1)
                                                <li class="media dropdown-item">
                                                    <span class="danger"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                                    <div class="media-body">
                                                        <a class="{{$mnotification->notification_id}}"
                                                            onclick="getnotid({{Auth::user()->id}},{{$mnotification->notification_id}})">
                                                            <p><strong>Admin</strong> has added a
                                                                <strong>{{$mnotification->title}}</strong> Successfully
                                                            </p>
                                                        </a>

                                                    </div>
                                                    <span class="notify-time">{{$mnotification->updated_at}}</span>
                                                </li>
                                            @endif
                                            @if($mnotification->type == 2)
                                                <li class="media dropdown-item">
                                                    <span class="success"><i class="fa-solid fa-file"></i></span>
                                                    <div class="media-body">
                                                        <a class="{{$mnotification->notification_id}}"
                                                            onclick="getnotid({{Auth::user()->id}}, {{$mnotification->notification_id}})">
                                                            <p><strong>Admin</strong> has added a
                                                                <strong>{{$mnotification->title}}</strong> Successfully
                                                            </p>
                                                        </a>

                                                    </div>
                                                    <span class="notify-time">{{$mnotification->updated_at}}</span>
                                                </li>
                                            @endif
                                            @if($mnotification->type == 3)
                                                <li class="media dropdown-item">
                                                    <span class="primary"><i class="fa-sharp fa-solid fa-question"></i></span>
                                                    <div class="media-body">
                                                        <a data-toggle="modal" class="{{$mnotification->notification_id}}"
                                                            onclick="getnotid({{Auth::user()->id}}, {{$mnotification->notification_id}})">
                                                            <p><strong>Admin</strong> has added a
                                                                <strong>{{$mnotification->title}}</strong> Successfully
                                                            </p>
                                                        </a>

                                                    </div>
                                                    <span class="notify-time">{{$mnotification->updated_at}}</span>
                                                </li>

                                            @endif
                                            @if($mnotification->type == 4)
                                                <li class="media dropdown-item">
                                                    <span class="success"><i class="fa-regular fa-image"></i></span>
                                                    <div class="media-body">
                                                        <a class="{{$mnotification->notification_id}}"
                                                            onclick="getnotid({{Auth::user()->id}}, {{$mnotification->notification_id}})">
                                                            <p><strong> Admin</strong> has added
                                                                a<strong>{{$mnotification->title}}</strong> Successfully
                                                            </p>
                                                        </a>
                                                    </div>
                                                    <span class="notify-time">{{$mnotification->updated_at}}</span>
                                                </li>
                                            @endif
                                            @if($mnotification->type == 5)

                                                <li class="media dropdown-item">
                                                    <span class="primary"><i class="ti-panel"></i></span>
                                                    <div class="media-body">
                                                        <a class="{{$mnotification->notification_id}}"
                                                            onclick="getnotid({{Auth::user()->id}},{{$mnotification->notification_id}})">
                                                            <p><strong>Admin</strong>{{$mnotification->title}}</p>
                                                        </a>
                                                    </div>
                                                    <span class="notify-time">{{$mnotification->updated_at}}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li></li>


                                    </ul>
                                    <a class="all-notification" href="{{$base_url}}/admin/all-notifications">See all
                                        notifications <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </li>



                        @endif
                    @endif
                    @if(Auth::user() != null)
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{$base_url}}/admin/agent-profile" class="dropdown-item">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="{{$base_url}}/admin/change-password" class="dropdown-item">
                                    <i class="fa-solid fa-lock"></i>
                                    <span class="ml-2">Change Password </span>
                                </a>
                                <a href="{{$base_url}}/logout" class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript"
    src="https://platform-api.sharethis.com/js/sharethis.js#property=64621a4aa4982d0019d1757d&product=inline-share-buttons&source=platform"
    async="async"></script>

@if(Auth::user() != null)

    @if(isset($agentqr) && $agentqr->agent_qr != null)
        <script>
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && isPrintingOptionOpen()) {
                    event.stopPropagation();
                    event.preventDefault();
                }
            });
            document.addEventListener("DOMContentLoaded", function () {

                const qrBtn = document.querySelector(".sweet-image-message");

                if (qrBtn) {

                    qrBtn.addEventListener("click", function () {

                        axios.get("{{ url('/fetch-qr/' . Auth::user()->agent_access_code) }}")
                            .then(response => {

                                Swal.fire({
                                    html: response.data,
                                    width: 400,
                                    showCancelButton: true,
                                    cancelButtonText: 'Close',
                                    confirmButtonText: 'Print',
                                }).then((result) => {

                                    if (result.isConfirmed) {
                                        const printWindow = window.open(
                                            "{{ url('/fetch-qr/' . Auth::user()->agent_access_code) }}",
                                            "_blank"
                                        );
                                        printWindow.print();
                                    }

                                });

                            })
                            .catch(error => {
                                console.error("QR Load Error:", error);
                            });

                    });

                }

            });

            function printData() {
                var divToPrint = document.getElementById("printable");
                newWin = window.open("{{$base_url}}/fetch-qr");
                newWin.document.write(divToPrint.outerHTML);
                window.print();
                newWin.close();
            }
        </script>

    @endif
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{$base_url}}/js/plugins-init/sweetalert.init.js"></script>