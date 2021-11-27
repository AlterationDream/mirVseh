@extends('layouts.front')

@section('title','404 - Страница не найдена')
@section('content')

<section class="error-page overlay">
    <div class="container">
        <div class="error-content text-center">
            <h2>404</h2>
            <h4>Page not found</h4>
            <p>This page is missing or you assembled the link incorrectly. Try again or come back</p>
            <a href="/test/" title="" class="btn-style2">Home</a>
        </div><!--error-content end-->
    </div>
</section><!--error-page end-->

@endsection

