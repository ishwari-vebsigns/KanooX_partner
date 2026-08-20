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
                                <h2>Careers</h2>
                            </div>
                            <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="500">
                                <ul>
                                    <li><a href="{{config('app.baseURL')}}\">Home</a></li>
                                    <li class="active">Careers</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->

        <!--Start Intro Style2 Area-->
        <section class="intro-style2-area">
            <div class="container">

                <div class="row">
                    <div class="col-xl-6">
                        <div class="intro-style2-img-box">
                            <div class="inner">
                                <img src="web-assets/images/resources/intro-style2-1.jpg" alt="">
                                <div class="shape-1">
                                    <img src="web-assets/images/shapes/intro-style2-img-box-shape-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="intro-style2-content-box">
                            <div class="sec-title">
                                <h2>Mountains Move<br> for a Determined Team</h2>
                            </div>
                            <div class="text">
                                <p>Desire that they cannot foresee the pain & trouble that are bound too
                                    ensue equal blame belongs through shrinking.</p>
                                <p>To enjoy a pleasure that has no annoying consequences.</p>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon-box">
                                        <span class="icon-checkbox-mark"></span>
                                    </div>
                                    <p>Great explorer of the master-builder</p>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <span class="icon-checkbox-mark"></span>
                                    </div>
                                    <p>On the other hand</p>
                                </li>
                            </ul>
                            <div class="send-resume-box">
                                <div class="icon">
                                    <span class="icon-cv"></span>
                                </div>
                                <div class="title">
                                    <h4><a href="#">Send Resume</a></h4>
                                    <h3><a href="mailto:info@templatepath.com">careerpath@finbank.com</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12">
                        <div class="job-list-table-box">

                            <div class="table-outer">
                                <table class="job-list-table">

                                    <thead class="header">
                                        <tr>
                                            <th>Department</th>
                                            <th>Job Role</th>
                                            <th>Location</th>
                                            <th>Last Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td class="department">
                                                <h3>Marketing</h3>
                                            </td>
                                            <td class="job-role">
                                                <h3>Regional Head</h3>
                                            </td>
                                            <td class="location">
                                                <p>Los Angeles</p>
                                            </td>
                                            <td class="last-date">
                                                <p>18th Jul, 2022</p>
                                            </td>
                                            <td>
                                                <div class="btn-box">
                                                    <a class="btn-one" href="#">
                                                        <span class="txt">Apply</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="department">
                                                <h3>Marketing</h3>
                                            </td>
                                            <td class="job-role">
                                                <h3>Team Leader</h3>
                                            </td>
                                            <td class="location">
                                                <p>Los Angeles</p>
                                            </td>
                                            <td class="last-date">
                                                <p>25th Jul, 2022</p>
                                            </td>
                                            <td>
                                                <div class="btn-box">
                                                    <a class="btn-one" href="#">
                                                        <span class="txt">Apply</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="department">
                                                <h3>Finance</h3>
                                            </td>
                                            <td class="job-role">
                                                <h3>Assistant Manager</h3>
                                            </td>
                                            <td class="location">
                                                <p>California</p>
                                            </td>
                                            <td class="last-date">
                                                <p>10th Aug, 2022</p>
                                            </td>
                                            <td>
                                                <div class="btn-box">
                                                    <a class="btn-one" href="#">
                                                        <span class="txt">Apply</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="department">
                                                <h3>Office</h3>
                                            </td>
                                            <td class="job-role">
                                                <h3>Office Executive</h3>
                                            </td>
                                            <td class="location">
                                                <p>Newyork</p>
                                            </td>
                                            <td class="last-date">
                                                <p>10th Aug, 2022</p>
                                            </td>
                                            <td>
                                                <div class="btn-box">
                                                    <a class="btn-one" href="#">
                                                        <span class="txt">Apply</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="department">
                                                <h3>Customer Care</h3>
                                            </td>
                                            <td class="job-role">
                                                <h3>Help Desk Job</h3>
                                            </td>
                                            <td class="location">
                                                <p>San Fransisco</p>
                                            </td>
                                            <td class="last-date">
                                                <p>23rd Sep, 2022</p>
                                            </td>
                                            <td>
                                                <div class="btn-box">
                                                    <a class="btn-one" href="#">
                                                        <span class="txt">Apply</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12">
                        <div class="subscribe-box-style1 subscribe-box-style1--style2">
                            <div class="icon">
                                <img src="web-assets/images/icon/subscribe-3.png" alt="">
                            </div>
                            <div class="inner-title">
                                <h3>Subscribe us to<br> Recieve Career Updates</h3>
                            </div>
                            <form class="subscribe-form-style1" action="#">
                                <div class="input-box">
                                    <input type="email" name="email" placeholder="Email address">
                                    <div class="inner-icon">
                                        <i class="far fa-envelope-open"></i>
                                    </div>
                                </div>
                                <button class="btn-one" type="submit">
                                    <span class="txt">Subscribe</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--End Intro Style2 Area-->









       @endsection