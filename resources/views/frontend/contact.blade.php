@extends('layouts.front')

@section('title','Контакты')
@section('content')

<section class="pager-section overlay">
    <div class="container">
        <div class="main-banner-content p-relative">
            <div class="social-links">
                <ul>
                    <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div><!--social-links end-->
            <div class="pager-content">
                <ul class="breadcrumb-list">
                    <li><a href="#" title="">Home</a></li>
                    <li><span>Contacts  </span></li>
                </ul><!--breadcrumb end-->
                <h2 class="page-title">Contacts</h2>
            </div><!--pager-content end-->
        </div><!--main-banner-content end-->
    </div>
</section><!--pager-section end-->

<section class="block2">
    <div class="container">
        <div class="contact_section">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="contact_info">
                        <ul>
                            <li>
                                <span>
                                    <i class="flaticon-pin"></i>
                                </span>
                                <div class="ccn-info">
                                    <p>340 Woodland Dr. Southaven, MS 38671</p>
                                </div>
                            </li>
                            <li>
                                <span>
                                    <i class="flaticon-clock"></i>
                                </span>
                                <div class="ccn-info">
                                    <p><span>Mon-Sat: </span> 8 am til 5 pm</p>
                                    <p><span>Sunday:  </span> Closed</p>
                                </div>
                            </li>
                            <li>
                                <span>
                                    <i class="flaticon-phone"></i>
                                </span>
                                <div class="ccn-info">
                                    <p>+44 62 7146 9812</p>
                                </div>
                            </li>
                            <li>
                                <span>
                                    <i class="flaticon-email"></i>
                                </span>
                                <div class="ccn-info">
                                    <a href="mailto:example@example.com" title="">info@zeus.com</a>
                                </div>
                            </li>
                        </ul>
                    </div><!--contact_info end-->
                </div>
                <div class="col-lg-8">
                    <div class="cnst-form">
                        <div class="section-title">
                            <h2 class="h-title dark-clr mw-100">Receive consultation</h2>
                            <span>We will call you back within 15 minutes</span>
                        </div>
                        <div class="consulation-form">
                            <form id="contact-form" method="post" action="#">
                                <div class="response"></div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control name" placeholder="Your name">
                                        </div><!--form-group end-->
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <input type="number" name="phone" class="form-control email" placeholder="Phone*">
                                        </div><!--form-group end-->
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="submit" id="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!--cnst-form end-->
                </div>
            </div>
        </div><!--contact_section end-->
    </div>
</section>

<section class="map-sec">
    <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
    </iframe>
</section>

<section class="block2">
    <div class="fixed-bg light-bg"></div>
    <div class="container">
        <div class="pt-logos text-center">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">IDENTITY</h4>
                    </div><!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">MOUNTA</h4>
                    </div><!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">GLOBE</h4>
                    </div><!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">CIRCLE</h4>
                    </div><!--pt-logos end-->
                </div>
            </div>
        </div><!--pt-logos end-->
    </div>
</section>

@endsection
