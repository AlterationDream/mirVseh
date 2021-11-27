<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','-Lara-Swift') - @setting('app_name')</title>
    <meta name="description" content="Zeus - Lawyers and Law Firm HTML Template" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/test/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/test/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/test/lib/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/test/lib/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/test/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/test/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>
@include('sweet::alert')

<div class="page-loading">
    <div class="thecube">
        <div class="cube c1"></div>
        <div class="cube c2"></div>
        <div class="cube c4"></div>
        <div class="cube c3"></div>
    </div>
</div>

<div class="wrapper">

    <header>
        <div class="container">
            <div class="header-content d-flex flex-wrap align-items-center">
                <div class="menu-btn">
                    <a href="#" title="">
                        <span class="bar1"></span>
                        <span class="bar2"></span>
                        <span class="bar3"></span>
                    </a>
                </div><!--menu-btn end-->
                <div class="logo">
                    <a href="/test" title="">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" width="80" height="120">
                    </a>
                </div><!-- logo end-->
                <nav>
                    <ul>
                        <li><a {{request()->is('/test')? 'class="active"':''}} href="/test/" title="">Главная</a></li>
                        <li><a {{request()->is('/test/about')? 'class="active"':''}} href="/test/about" title="">О нас</a></li>
                        <li><a {{request()->is('/test/services')? 'class="active"':''}} href="/test/services" title="">Услуги</a></li>
                        <li><a {{request()->is('/test/blog')? 'class="active"':''}} href="/test/blog" title="">Новости</a></li>
                        <li><a {{request()->is('/test/contact')? 'class="active"':''}} href="/test/contact" title="">Контакты</a></li>
                    </ul>
                </nav><!--navigation end-->
                <ul class="contact-head-info ml-auto">
                    <li>
                        <img src="{{ asset('assets/images/phone.svg') }}" alt="">
                        <span>+7(42 42)23 03 73</span>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/mail.svg') }}" alt="">
                        <a href="mailto:example@example.com" title="">info@zeus.com</a>
                    </li>
                </ul><!--contact-head-info end-->
            </div><!--header-content end-->
        </div>
    </header><!--header end-->

    <div class="burger-menu">
        <a href="#" title="" class="close-menu">
            <i class="flaticon-close"></i>
        </a>
        <div class="menu-middle">
            <div class="container">
                <div class="main-menu">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="menu-widget">
                                <h4>SOCIAL MEDIA</h4>
                                <ul>
                                    <li><a href="#" title="">Twitter</a></li>
                                    <li><a href="#" title="">Linkedin</a></li>
                                    <li><a href="#" title="">Instagram</a></li>
                                    <li><a href="#" title="">Facebook</a></li>
                                    <li><a href="#" title="">Telegram</a></li>
                                </ul>
                            </div><!--menu-widget end-->
                        </div>
                        <div class="col-md-4">
                            <div class="menu-widget">
                                <h4>COMPANY</h4>
                                <ul>
                                    <li><a href="/test/about" title="">About Us</a></li>
                                    <li><a href="/test/team" title="">Our Team</a></li>
                                    <li><a href="/test/prices" title="">Prices</a></li>
                                    <li><a href="/test/contact" title="">Contact</a></li>
                                    <li><a href="/test/blog" title="">News</a></li>
                                </ul>
                            </div><!--menu-widget end-->
                        </div>
                        <div class="col-md-4">
                            <div class="menu-widget">
                                <h4>Services</h4>
                                <ul>
                                    <li><a href="/test/services" title="">Judicial protection</a></li>
                                    <li><a href="/test/services" title="">Lawyer consulting</a></li>
                                    <li><a href="/test/services" title="">Debt collection</a></li>
                                    <li><a href="/test/services" title="">Protection of rights</a></li>
                                    <li><a href="/test/services" title="">Real estate lawyer</a></li>
                                </ul>
                            </div><!--menu-widget end-->
                        </div>
                    </div>
                </div><!--main-menu end-->
            </div>
        </div><!--menu-middle end-->
        <div class="menu-footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="menu-footer-logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="">
                        </div><!--menu-footer-logo end-->
                    </div>
                    <div class="col-md-8">
                        <ul class="contact-menu-links">
                            <li>
                                <p>340 Woodland Dr. <br /> Southaven, MS 38671</p>
                            </li>
                            <li><span>+44 62 7146 9812</span></li>
                            <li><a href="mailto:example@exmaple.com" title="">info@zeus.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--menu-footer end-->
    </div><!--burger-menu end-->

    @yield('content')

    <footer>
        <div class="container">
            <div class="top-footer">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-about">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="">
                            <p>340 Woodland Dr. <br /> Southaven, MS 38671</p>
                            <ul>
                                <li><span>+7(42 42)23 03 73</span></li>
                                <li><a href="mailto:example@example.com" title="">info@mirvseh.ru</a></li>
                            </ul>
                        </div><!--widget-about end-->
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-links">
                            <h4 class="widget-title">Мы в соцсетях</h4>
                            <ul>
                                <li><a href="#" title="">Вконтакте&nbsp;</a></li>
                                <li><a href="#" title="">Whatsapp&nbsp;</a></li>
                                <li><a href="#" title="">Instagram</a></li>
                                <li><a href="#" title="">Facebook</a></li>
                                <li><a href="#" title="">Telegram</a></li>
                            </ul>
                        </div><!--widget-links end-->
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-links">
                            <h4 class="widget-title">Наша компания</h4>
                            <ul>
                                <li><a href="/test/about" title="">О нас&nbsp;</a></li>
                                <li><a href="/test/team" title="">Наша команда&nbsp;</a></li>
                                <li><a href="/test/prices" title="">Прайс&nbsp;</a></li>
                                <li><a href="/test/contact" title="">Контакты&nbsp;</a></li>
                                <li><a href="/test/blog" title="">Контакты&nbsp; </a></li>
                            </ul>
                        </div><!--widget-links end-->
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="widget widget-links">
                            <h4 class="widget-title">Услуги</h4>
                            <ul>
                                <li><a href="/test/service-details" title="">Judicial protection</a></li>
                                <li><a href="/test/service-details" title="">Lawyer consulting</a></li>
                                <li><a href="/test/service-details" title="">Debt collection</a></li>
                                <li><a href="/test/service-details" title="">Protection of rights</a></li>
                                <li><a href="/test/service-details" title="">Real estate lawyer</a></li>
                            </ul>
                        </div><!--widget-links end-->
                    </div>
                </div>
            </div>
            <div class="bottom-strip">
                <ul class="bt-links">
                    <li><a href="#" title="">Политика конфиденциальности</a></li>
                    <li><a href="#" title="">Условия и положения</a></li>
                </ul><!--bt-links end-->
            </div>
        </div>
    </footer><!--footer end-->
</div>
<!-- ./wrapper -->
<script src="{{ asset('assets/js/test/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/test/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/test/lib/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/test/html5lightbox.js') }}"></script>
<script src="{{ asset('assets/js/test/counter.js') }}"></script>
<script src="{{ asset('assets/js/test/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/test/scripts.js') }}"></script>
@yield('script')
@yield('chart')
</body>
</html>
