@extends('layouts.template')

<?php
$name = '';
if ($type == 'prospector') $name = 'изыскатель';
elseif ($type == 'customer') $name = 'клиент';
else $name = 'программист';
?>

@section('title','Новый ' . $name)
@section('style')
    <!--link rel="stylesheet" type="text/css"  href="{{asset('assets/css/articleStyle.css')}}"></link-->
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="/connections">{{__('app.connections_database')}}</a></li>
                            <li class="breadcrumb-item"><a href="/connections/{{ $type }}">{{__('app.' . $type . 's_database')}}</a></li>
                            <li class="breadcrumb-item active">Новый {{ $name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fliud">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        @include('layouts.includes.alerts')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Новый {{ $name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/connections/{{ $type }}/create" method="POST" class="form-horizontal" id="connection-create" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="fullname" class="form-control mb-2" id="fullname" placeholder="{{__('app.fullname')}}*" value="{{ old('fullname') }}">
                                                <input type="email" name="email" class="form-control mb-2" id="email" placeholder="{{__('app.email')}}" value="{{ old('email') }}">
                                                <input type="tel" name="phone" class="form-control mb-2" id="phone" placeholder="{{__('app.phone')}}" value="{{ old('phone') }}">
                                                @if($type == 'customer') <input type="text" name="position" class="form-control mb-2" id="position" placeholder="{{__('app.workplace')}}" value="{{ old('position') }}"> @endif
                                                <input type="text" name="experience" class="form-control mb-2" id="experience" placeholder="{{__('app.experience')}}" value="{{ old('experience') }}">
                                                <input type="text" name="age" class="form-control mb-2" id="age" placeholder="{{__('app.age')}}" value="{{ old('age') }}">
                                                @if($type == 'prospector' || $type == 'programmer') <input type="text" name="price" class="form-control mb-2" id="price" @if ($type == 'prospector') placeholder="{{__('app.income')}}" @else placeholder="{{__('app.price')}}" @endif value="{{ old('price') }}"> @endif
                                                @if($type == 'customer') <input type="text" name="contract_date" class="form-control mb-2" id="contract_date" placeholder="{{__('app.contract_date')}}" value="{{ old('contract_date') }}"> @endif
                                                <input type="text" name="region" class="form-control mb-2" id="region" placeholder="{{__('app.region')}}" value="{{ old('region') }}">
                                                @if($type == 'customer') <input type="text" name="address" class="form-control mb-2" id="address" placeholder="{{__('app.address')}}" value="{{ old('address') }}"> @endif
                                                @if($type == 'prospector' || $type == 'programmer') <input type="text" name="position" class="form-control mb-2" id="position" @if ($type == 'prospector') placeholder="{{__('app.position')}}" @else placeholder="{{__('app.area')}}" @endif value="{{ old('position') }}"> @endif
                                                <textarea name="description" class="form-control mb-2" id="description" cols="30" rows="10" @if($type == 'customer') placeholder="{{__('app.case_description')}}" @else placeholder="{{__('app.short_description')}}" @endif ></textarea>
                                                <label id="doc-label" for="doc" class="mt-2 ml-1"> @if($type == 'customer') {{__('app.passport')}}: @else {{__('app.cv')}}: @endif </label>
                                                <input type="file" name="doc" id="doc" value="{{ old('doc') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="{{__('app.save')}}">
                                        </div>
                                    </form>
                                </article>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
