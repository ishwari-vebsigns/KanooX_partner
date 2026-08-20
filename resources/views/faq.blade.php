@extends('layouts.web-app')
@section('content')


        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <!--Start breadcrumb area-->
        <section class="breadcrumb-area">
            <div class="breadcrumb-area-bg" style="background-image: url(web-assets/images/backgrounds/breadcrumb-area-bg.jpg);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500">
                                <h2>Faq’s</h2>
                            </div>
                            <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="500">
                                <ul>
                                    <li><a href="{{config('app.baseURL')}}\">Home</a></li>
                                    <li class="active">Faq’s</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->


        <!--Start Faq Page One-->
        <section class="faq-page-one">
            <div class="container">
                <div class="sec-title text-center">
                    <h2>Frequently Asked Questions</h2>
                    <div class="sub-title">
                        <p>Find answers to all your queries about our service.</p>
                    </div>
                </div>
                <div class="faq-search-box">
                    <div class="faq-search-box__inner">
                        <form class="search-form" action="#">
                            <input placeholder="Related Keyword..." type="text">
                            <button type="submit">
                                <i class="icon-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">

                    <div class="col-xl-6">
                        <div class="faq-style1__content">
                            <ul class="accordion-box">

                                <li class="accordion block active-block">
                                    <div class="acc-btn active">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>What is the minimum balance?</h3>
                                    </div>
                                    <div class="acc-content current">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>When will I receive my account statement?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>Can I use any branch across India?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>How safe/secure is our net banking a/c?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="faq-style1__content margintop">
                            <ul class="accordion-box">

                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>Can I use any branch across India?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>How safe/secure is our net banking a/c?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>What is the minimum balance?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>What is the rate of interest?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                        <h3>When will I receive my account statement?</h3>
                                    </div>
                                    <div class="acc-content">
                                        <p>Rationally encounter consequences that are extremely painful again
                                            there anyone who loves or pursues desire.</p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--End Faq Page One-->
@endsection

