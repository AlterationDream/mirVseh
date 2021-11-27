@extends('layouts.front')

@section('title','FAQ')
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
                    <li><span>Operating Procedure</span></li>
                </ul><!--breadcrumb end-->
                <h2 class="page-title">Operating Procedure</h2>
            </div><!--pager-content end-->
        </div><!--main-banner-content end-->
    </div>
</section><!--pager-section end-->

<section class="block2">
    <div class="container">
        <div class="section-title">
            <h2 class="h-title dark-clr mw-100">Stages of working with us:</h2>
        </div><!--section-title end-->
        <div class="procedures">
            <ul>
                <li>
                    <div class="producere">
                        <div class="prod-icon">
                            <img src="{{ asset('assets/images/icon1.png') }}" alt="">
                            <h3>01.</h3>
                        </div>
                        <h4>Leave a request</h4>
                    </div>
                </li>
                <li class="v2">
                    <div class="producere">
                        <div class="prod-icon">
                            <img src="{{ asset('assets/images/icon2.png') }}" alt="">
                            <h3>02.</h3>
                        </div>
                        <h4>We will call You back</h4>
                    </div>
                </li>
                <li class="v3">
                    <div class="producere">
                        <div class="prod-icon">
                            <img src="{{asset('assets/images/icon3.png')}}" alt="">
                            <h3>03.</h3>
                        </div>
                        <h4>We define goals and ways to solve them</h4>
                    </div>
                </li>
                <li class="v4">
                    <div class="producere">
                        <div class="prod-icon">
                            <img src="{{asset('assets/images/icon4.png')}}" alt="">
                            <h3>04.</h3>
                        </div>
                        <h4>Choose the appropriate fare for your situation</h4>
                    </div>
                </li>
                <li class="v5">
                    <div class="producere">
                        <div class="prod-icon">
                            <img src="{{asset('assets/images/icon2.png')}}" alt="">
                            <h3>05.</h3>
                        </div>
                        <h4>We sign the contract and start working</h4>
                    </div>
                </li>
                <li class="v6">
                    <div class="producere mw-100">
                        <div class="prod-icon">
                            <img src="{{asset('assets/images/icon6.png')}}" alt="">
                            <h3>06.</h3>
                        </div>
                        <h4>We work to the end, solving the set tasks</h4>
                    </div>
                </li>
            </ul>
        </div><!--procedures end-->
        <div class="faqs-section">
            <div class="section-title">
                <h2 class="h-title dark-clr mw-100">Answers to frequently <br /> asked questions</h2>
            </div><!--section-title end-->
            <div class="row toggle">
                <div class="col-lg-6">
                    <div class="togglee">
                        <div class="toggle-item">
                            <h2 class="active">Do you go to your home or office?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                        <div class="toggle-item">
                            <h2>Do You have an office that could be reached?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                        <div class="toggle-item">
                            <h2>Can I call a separate lawyer and consult?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                    </div><!--toggle end-->
                </div>
                <div class="col-lg-6">
                    <div class="togglee v2">
                        <div class="toggle-item">
                            <h2 class="active">How can I pay for your services?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                        <div class="toggle-item">
                            <h2>How long does it take to solve the problem?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                        <div class="toggle-item">
                            <h2>If you don't solve my problem, what happens?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                        <div class="toggle-item">
                            <h2>Can I get help on weekends or holidays?</h2>
                            <div class="content">
                                <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                            </div>
                        </div>
                    </div><!--toggle end-->
                </div>
            </div>
        </div><!--faqs-section end-->
    </div>
</section>

<section class="block overlay">
    <div class="fixed-bg bg2"></div>
    <div class="container">
        <div class="section-title">
            <h2 class="h-title mw-100">Receive consultation</h2>
            <span>We will call you back within 15 minutes</span>
        </div><!--section-title end-->
        <div class="consulation-form">
            <form>
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your name">
                        </div><!--form-group end-->
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="number" name="phone" class="form-control" placeholder="Phone*">
                        </div><!--form-group end-->
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <button type="submit" class="submit">Send</button>
                    </div>
                </div>
            </form>
        </div><!--consulation-form end-->
    </div>
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
