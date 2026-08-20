<footer class="footer-area">
            <div class="right-shape">
                <img src="{{$base_url}}/web-assets/images/shapes/footer-right-shape.png" alt="">
            </div>

            <!--Start Footer Top-->
            <div class="footer-top">
                <div class="lef-shape">
                    <span class="icon-origami"></span>
                </div>
                <div class="container">
                    <div class="row">
                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Loans</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                    @foreach($loans as $loan)
                                        <li><a href="{{$base_url}}/loan\{{$loan->url}}">{{$loan->loan_name}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->
                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Rates & Charges</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                        <li><a href="#">Interest Rates</a></li>
                                        <li><a href="#">Gold Rate Today</a></li>
                                        <li><a href="#">Service Charges & Fees</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single-footer-widget single-footer-widget--link-box-style2">
                                <div class="title">
                                    <h3>Online</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                        <li><a href="#">Mobile Banking</a></li>
                                        <li><a href="#">Internet Banking</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>About Us</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                        <li><a href="#">Our Story</a></li>
                                        <li><a href="#">Board of Directors</a></li>
                                        <li><a href="#">Management Committee</a></li>
                                        <li><a href="#">Media</a></li>
                                        <li><a href="#">Investor Relations</a></li>
                                        <li><a href="#">Awards & Recognition</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Services</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                        <li><a href="#">Savings Account</a></li>
                                        <li><a href="#">Current Account</a></li>
                                        <li><a href="#">Deposits</a></li>
                                        <li><a href="#">Cards</a></li>
                                        <li><a href="#">Payments</a></li>
                                        <li><a href="#">Insurance</a></li>
                                        <li><a href="#">Locker Facility</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->
                    </div>
                </div>
            </div>
            <!--End Footer Top-->

            <!--Start Footer-->
            <div class="footer">
                <div class="container">
                    <div class="row">

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="single-footer-widget marbtm50">
                                <div class="our-company-info">
                                    <div class="footer-logo-style1">
                                        <a href="index.html">
                                            <img src="{{$base_url}}\web-assets/images/resources/logo.png" alt="Awesome Logo" title="">
                                        </a>
                                    </div>
                                    <div class="copyright-text">
                                        <p>
                                            Copyright &copy; 2023 <a href="index.html">Vebsigns.</a> Licensed by<br>
                                            vebsigns technologies.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="single-footer-widget marbtm50">
                                <div class="footer-widget-contact-info">
                                    <ul>
                                        <li>
                                            <h3>
                                                <a href="tel:2512353256">(800) 123 456 78</a>
                                            </h3>
                                            <p>Customer Care</p>
                                        </li>
                                        <li>
                                            <h3>Mon - Fri: 9.00am to 5.00pm</h3>
                                            <p>Banking Hours</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="single-footer-widget">
                                <div class="single-footer-widget-right-colum">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                Download Forms
                                                <span class="icon-download"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Register Your Complaint
                                                <span class="icon-feedback"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                    </div>
                </div>
            </div>
            <!--End Footer-->

            <div class="footer-bottom">
                <div class="container">
                    <div class="bottom-inner">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">Disclaimer</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Online Security Tips</a></li>
                            </ul>
                        </div>
                        <div class="footer-social-link">
                            <ul class="clearfix">
                                <li>
                                    <a href="#">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </footer>