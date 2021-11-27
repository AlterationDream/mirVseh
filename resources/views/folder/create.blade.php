@extends('layouts.template')

@section('title','Новая папка')
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
                            <li class="breadcrumb-item"><a href="/folders">{{__('app.folders')}}</a></li>
                            <li class="breadcrumb-item active">{{__('app.new_folder')}}</li>
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
                                <h3 class="card-title">{{__('app.new_folder')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/folders/create" method="POST" class="form-horizontal" id="folder-create">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="{{__('app.folder_title')}}" value="{{ old('title') }}">
                                                <label id="user-select-label" for="businessCase" class="mt-2 ml-1">{{__('app.assigned_business_case')}}:</label><br>
                                                <select name="businessCase" class="form-control">
                                                    <option value="0" selected>Не привязывать</option>
                                                    @foreach($businessCases as $case)
                                                    <option value="{{$case->id}}">{{$case->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="{{__('app.publish_folder')}}">
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
