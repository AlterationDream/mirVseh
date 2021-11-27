@extends('layouts.front')

@section('title','Блог - страница')
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
                    <li><span>News  </span></li>
                </ul><!--breadcrumb end-->
                <h2 class="page-title">News</h2>
            </div><!--pager-content end-->
        </div><!--main-banner-content end-->
    </div>
</section><!--pager-section end-->

<section class="page-content pt-0">
    <div class="blog-page-head">
        <div class="container">
            <ul>
                <li><a href="#" title="">All</a></li>
                <li><a href="#" title="">Bankruptcy</a></li>
                <li><a href="#" title="">World</a></li>
                <li><a class="active" href="#" title="">Judical Law</a></li>
                <li><a href="#" title="">Land law</a></li>
                <li><a href="#" title="">Political newspolitical</a></li>
                <li><a href="#" title="">Real estate</a></li>
            </ul>
        </div>
        <div class="search_form">
            <form>
                <input type="text" name="search" placeholder="Search">
                <button type="submit"><i class="flaticon-search"></i></button>
            </form>
        </div><!--search_form end-->
    </div><!--blog-page-head end-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-post-single">
                    <h2>Pandemic. What is it and how to act?</h2>
                    <img src="https://via.placeholder.com/880x449" alt="" class="w-100">
                    <span>Chine 2020</span>
                    <p>Maecenas id dui quis nisi placerat ornare vel quis libero. Ut ullamcorper diam non pre blandit at malesuada. Phasellus bibendum tincidunt placerat. Duis mollis placerat for in magna, id convall eros ultrices vitae. Maecenas at nisi orci. Integer fermentum from nisl neque, fermentum molest dui lacinia non. Nam vel diam at erat viverra lacinia. Morbi auctor, lectus eu interdum efficitur, no velit consequat odio, ac placerat press magna libero a leo. Orci varius natoque penatibus et levis dis parturient montes, nascetur ridiculus mus. Phasellus blandit sapien ut blandit bibendum. </p>
                    <p>Phasellus in neque nec mi porta congue. Integer placerat pretium arcu quis pulvinar. In id ligula eu nisl eleifend tincidunt quis sed magna. Cras tristique odio sit amet vesti Curabitur in lectus blandit, efficitur turpis a, imperdiet enim. Donec consequat vel at ultrices. Nullam vitae vestibul.</p>
                    <img src="https://via.placeholder.com/880x494" alt="" class="w-100">
                    <p>Natoque id dui quis nisi placerat ornare vel quis libero. Ut ullamcorper diam non pre blandit at malesuada. Phasellus bibendum tincidunt placerat. Duis mollis placerat for in magna, id convall eros ultrices vitae. Maecenas at nisi orci. Integer fermentum from nisl neque, fermentum molest dui lacinia non. Nam vel diam at erat viverra lacinia. Morbi auctor, lectus eu interdum efficitur, no velit consequat odio, ac placerat press magna libero a leo. Orci varius natoque penatibus et levis dis parturient montes, nascetur ridiculus mus. Phasellus blandit sapien ut blandit bibendum. </p>
                    <p>Consequat in neque nec mi porta congue. Integer placerat pretium arcu quis pulvinar. In id ligul eu nisl eleifend tincidunt quis sed magna. Cras tristique odio sit amet vesti Curabitur in lectus blandit, efficitur turpis a, imperdiet enim. Donec consequat vel at ultrices. Nullam vitae vestibul.</p>
                    <blockquote> “ Praesent lacinia, libero et consectetur pretium, ipsum urna commodo eros, id fermentum velit dolor at mi. Suspendisse sit amet dictum enim, sed elementum purus. Sed aliquam dolor ac egestas tincidunt. Proin urna libero, mattis blandit posuere ac, auctor at massa. Integer quis neque a tellus efficitur luctus vitae non est. Aliquam dui nunc, bibendum eu cursus a, finibus vitae ipsum. Phasellus sit amet cursus lorem. ” </blockquote>
                </div><!--blog-post-single end-->
                <div class="tags-list">
                    <h4>Tags:</h4>
                    <ul>
                        <li><a href="#" title="">Law</a></li>
                        <li><a href="#" title="">Pandemic</a></li>
                        <li><a href="#" title="">World</a></li>
                    </ul>
                </div><!--tags-list end-->
                <div class="related-posts">
                    <div class="section-title">
                        <h2 class="h-title dark-clr">Viewed news</h2>
                    </div><!--section-title end-->
                    <div class="blog-posts">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Family relation</h4>
                                        <h2><a href="#" title="">What should I do if the landlord terminates the contract?</a></h2>
                                        <span>23 October 2019</span>
                                    </div>
                                </div><!--blog-post end-->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Business</h4>
                                        <h2><a href="#" title="">How to take out <br /> a loan with minimal interest </a></h2>
                                        <span>18 April 2020</span>
                                    </div>
                                </div><!--blog-post end-->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Business</h4>
                                        <h2><a href="#" title="">New method of safe home purchase in Russia</a></h2>
                                        <span>18 April 2020</span>
                                    </div>
                                </div><!--blog-post end-->
                            </div>
                        </div>
                    </div><!--blog-posts end-->
                </div><!--related-posts end-->
            </div>
            <div class="col-lg-4">
                <div class="sidebar blog-sidebar">
                    <div class="widget widget-newsletter">
                        <h3 class="widget-title">Newsletter</h3>
                        <form>
                            <input type="text" name="newsletter" placeholder="Your e-mail">
                            <button type="submit"><i class="flaticon-send"></i></button>
                        </form>
                    </div><!--widget-newsletter end-->
                    <div class="widget widget-posts">
                        <h3 class="widget-title">Latest news</h3>
                        <ul>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="#" title="">Recent amendments to the Constitution</a></h4>
                                        <span>Jul 21, 2020</span>
                                    </div>
                                </div><!--wd-post end-->
                            </li>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="#" title="">How to choose the right law firm</a></h4>
                                        <span>Dec 9, 2019</span>
                                    </div>
                                </div><!--wd-post end-->
                            </li>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="#" title="">Pandemic. What is it and how to act?</a></h4>
                                        <span>Dec 9, 2020</span>
                                    </div>
                                </div><!--wd-post end-->
                            </li>
                        </ul>
                    </div><!--widget-posts end-->
                    <div class="widget widget-posts">
                        <h3 class="widget-title">Popular news</h3>
                        <ul>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="#" title="">Land surveying. What is it?</a></h4>
                                        <span>Dec 9, 2019</span>
                                    </div>
                                </div><!--wd-post end-->
                            </li>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="#" title="">Law, what literature will help a beginner?</a></h4>
                                        <span>Jul 21, 2020</span>
                                    </div>
                                </div><!--wd-post end-->
                            </li>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x344" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="#" title="">Law, what literature will help a beginner?</a></h4>
                                        <span>Dec 9, 2019</span>
                                    </div>
                                </div><!--wd-post end-->
                            </li>
                        </ul>
                    </div><!--widget-posts end-->
                    <div class="widget widget-advertisement">
                        <img src="https://via.placeholder.com/675x900" alt="" class="w-100">
                    </div><!--widget-advertisement end-->
                </div><!--sidebar end-->
            </div>
        </div>
    </div>
</section><!--page-content end-->

@endsection
