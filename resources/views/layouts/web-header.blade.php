
<header class="main-header main-header-style1">

                <!--Start Main Header Style1 Top-->
                <div class="main-header-style1-top">
                    <div class="auto-container">
                        <div class="outer-box">
                            <!--Start Main Header Style1 Top Left-->
                            <div class="main-header-style1-top__left">
                                <div class="looking-banking-box ">
                                    <div class="inner-title">
                                        <span class="icon-binoculars"></span>
                                        <p>Looking</p>
                                    </div>
                                    <div class="select-box clearfix">
                                        <select class="wide">
                                            <option data-display="Personal Banking">
                                                Personal Banking
                                            </option>
                                            <option value="1">Business Banking</option>
                                            <option value="2">Personal Banking 01</option>
                                            <option value="3">Personal Banking 02</option>
                                            <option value="4">Personal Banking 03</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="nearest-branch">
                                    <span class="icon-map"></span>
                                    <a href="#">Find Nearest Branch</a>
                                </div>
                            </div>
                            <!--End Main Header Style1 Top Left-->

                            <!--Start Main Header Style1 Top Right-->
                            <div class="main-header-style1-top__right">
                                <div class="header-menu-style1">
                                    <ul>
                                        <li><a href="{{$base_url}}\careers">Careers</a></li>
                                        <li><a href="{{$base_url}}\faq">Faq’s</a></li>
                                        <!-- <li><a href="#">Offers</a></li> -->
                                        <!-- <li><a href="#">Calendar</a></li> -->
                                    </ul>
                                </div>
                                <div class="box-search-style1">
                                    <a href="#" class="search-toggler">
                                        <span class="icon-search"></span>
                                        Search
                                    </a>
                                </div>
                                <div class="language-switcher">
                                    <div id="polyglotLanguageSwitcher">
                                        <form action="#">
                                            <select id="polyglot-language-options">
                                                <option id="en" value="en" selected="">English</option>
                                                <option id="fr" value="fr">French</option>
                                                <option id="de" value="de">German</option>
                                                <option id="it" value="it">Italian</option>
                                                <option id="es" value="es">Spanish</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Main Header Style1 Top Right-->

                        </div>
                    </div>
                </div>
                <!--End Main Header Style1 Top-->

                <nav class="main-menu main-menu-style1">
                    <div class="main-menu__wrapper clearfix">
                        <div class="container">
                            <div class="main-menu__wrapper-inner">

                                <div class="main-menu-style1-left">
                                    <div class="logo-box-style1">
                                        <a href="{{$base_url}}\">
                                            <img src="{{$base_url}}\web-assets/images/resources/logo.png" alt="Awesome Logo" title="">
                                        </a>
                                    </div>

                                    <div class="main-menu-box">
                                        <a href="#" class="mobile-nav__toggler">
                                            <i class="icon-menu"></i>
                                        </a>

                                        <ul class="main-menu__list">
                                            <li class="megamenu">
                                                <a class="headers_menu" href="{{$base_url}}\">Home</a>
                                               
                                            </li>

                                            <li class="dropdown">
                                                <a class="headers_menu" href="#">Services</a>
                                                <ul>
                                                    <!-- <li class="dropdown">
                                                        <a href="#">Accounts</a>
                                                        <ul>
                                                            <li><a href="{{$base_url}}\accounts">All Accounts</a></li>
                                                            <li><a href="{{$base_url}}\account-savings">Savings Account</a></li>
                                                            <li><a href="{{$base_url}}\account-current">Current Account</a></li>
                                                            <li><a href="{{$base_url}}\account-fd">Fixed Deposit Account</a>
                                                            </li>
                                                            <li><a href="{{$base_url}}\account-salary">Salary Account</a></li>
                                                            <li><a href="{{$base_url}}\account-rd">Recuring Deposit a/c</a>
                                                            </li>
                                                            <li><a href="{{$base_url}}\account-nri">NRI Account</a></li>
                                                        </ul>
                                                    </li> -->
                                                    <li class="dropdown">
                                                        <a href="#">Cards</a>
                                                        <ul>
                                                            <li><a class="headers_menu" href="{{$base_url}}\cards">Our All Cards</a></li>
                                                            <li><a class="headers_menu" href="{{$base_url}}\credit">Credit Card</a></li>
                                                            <li><a class="headers_menu" href="{{$base_url}}\step-up">Step-up Card</a></li>
                                                            <!-- <li><a href="cards-law-interest.html">Low Interest</a></li> -->
                                                            <!-- <li><a href="cards-rewards.html">Rewards</a></li> -->
                                                            <!-- <li><a href="cards-secured.html">Secured</a></li> -->
                                                            <!-- <li><a href="cards-travel-hotel.html">Travel & Hotel</a></li> -->
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="headers_menu" href="#">Loans</a>
                                                        <ul>
                                                        @foreach($loans as $loan)
                                                        <li><a class="headers_menu" href="{{config('app.baseURL')}}/loan/{{$loan->url}}">{{$loan->loan_name}}</a></li>
                                                        @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="dropdown">
                                                <a class="headers_menu" href="#">About</a>
                                                <ul>
                                                    <li><a class="headers_menu" href="{{$base_url}}\about">About Us</a></li>
                                                    <li><a class="headers_menu" href="{{$base_url}}\team">Board of Directors</a></li>
                                                    <li><a class="headers_menu" href="{{$base_url}}\careers">Careers</a></li>
                                                    <!-- <li><a href="careers-details.html">Career Detail</a></li> -->
                                                    <li><a href="{{$base_url}}\faq">Faq’s</a></li>
                                                    <!-- <li><a href="testimonials.html">Testimonials</a></li> -->
                                                    <!-- <li><a href="404.html">404 Error</a></li> -->
                                                </ul>
                                            </li>
                                            <!-- <li class="dropdown">
                                                <a href="#">News</a>
                                                <ul>
                                                    <li><a href="blog.html">Grid View</a></li>
                                                    <li><a href="blog-2.html">List View</a></li>
                                                    <li><a href="blog-3.html">Large Image</a></li>
                                                    <li><a href="blog-single.html">Single Post</a></li>
                                                </ul>
                                            </li> -->
                                            <!--<li class="dropdown">-->
                                            <!--    <a class="headers_menu" href="#">Apply Now</a>-->
                                            <!--    <ul>-->
                                            <!--        @foreach($loans as $loan)-->
                                            <!--        <li><a class="headers_menu" href="{{config('app.baseURL')}}/loan\{{$loan->url}}">{{$loan->loan_name}}</a></li>-->
                                            <!--        @endforeach                                                        -->
                                            <!--    </ul>-->
                                            <!--</li>-->
                                            <li>
                                                <a href="{{config('app.baseURL')}}/register-agent">Become An Agent</a>
                                            </li>
                                            <!-- <li class="others-options dropdown">
                                                <a href="https://reg.paypointindia.co.in/" class="login-btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Log In</a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    
                                                    <a class="dropdown-item" href="" >Retailer</a>
                                                    <a class="dropdown-item" href="" >Distributor</a>
                                                    <a class="dropdown-item" href="" >Super Distributor</a>
                                                    <a class="dropdown-item" href="" >Associate Partner</a>
                                                    <a class="btn btn-primary" href="" target="_blank"> Register</a>
                                                </ul>
                                            </li> -->
                                            <li class="dropdown">
                                                <a class="headers_menu" href="#">Log In</a>
                                                <ul>
                                                    <li><a class="headers_menu" href="#">Retailer</a></li>
                                                    <li><a class="headers_menu" href="#">Distributor</a></li>
                                                    <li><a class="headers_menu" href="#">Super Distributor</a></li>
                                                    <li><a class="headers_menu" href="#">Associate Partner</a></li>
                                                    @if(Auth::user()!="")
                                                    <a class="dropdown-item btn btn-primary" href="{{$base_url}}\logout"> Logout</a>
                                                    @else
                                                    <a class="dropdown-item btn btn-primary" href="{{$base_url}}\register-user"> Register</a>
                                                    
                                                    @endif
                                                </ul>
                                            </li>
                                            <!-- <li>
                                                <a href="{{config('app.baseURL')}}/contact">Get In Touch</a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>

                                <!-- <div class="main-menu-style1-right">
                                    <div class="header-btn-one">
                                        <a href="#">
                                            <span class="icon-home-button"></span>Login
                                        </a>
                                        <a class="style2" href="#">
                                            <span class="icon-payment"></span>Open an Account
                                        </a>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                    </div>
                </nav>

                <!--Start Main Header Style1 Bottom-->
                <div class="main-header-style1-bottom">
                    <div class="auto-container">
                        <div class="outer-box">
                            <div class="update-box">
                                <div class="inner-title">
                                    <span class="icon-megaphone"></span>
                                    <h4>Updates:</h4>
                                </div>
                                <div class="text">
                                    <p>Get upto 4%* on our Savings Account Balances with Bank.</p>
                                    <a href="#"><span class="icon-chevron"></span>More Details</a>
                                </div>
                            </div>
                            <div class="slogan-box">
                                <p>Dear Customer, We have launched Video KYC facility for New customer to open savings ac
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Main Header Style1 Bottom-->

            </header>