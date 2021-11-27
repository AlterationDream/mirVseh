@extends('layouts.template')

@section('title','Архив дел')
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
                            <li class="breadcrumb-item active">{{__('app.folders')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.includes.alerts')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h4>{{__('app.folders')}}</h4>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="/folders/create" class="btn btn-primary">{{__('app.new_folder')}}</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTableAlt2" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th style="width: 38px;"></th>
                                                    <th class="">{{__('app.title')}}</th>
                                                    <th class="">Привязанное дело</th>
                                                    <th class="">Создана</th>
                                                    <th class="" style="width: 100px;">{{__('app.action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($folders as $folder)
                                                    <tr>
                                                        <td><a href="folders/{{$folder->slug}}/archive"><img src="/uploads/avatar/folder.png" style="max-height: 38px"></a></td>
                                                        <td><a href="folders/{{$folder->slug}}/archive" class="list-title-link">{{ $folder->title }}</a></td>
                                                        <td> @if($folder->business_case) <a href="cases/{{$folder->business_case->slug}}" class="list-title-link">{{ $folder->business_case->title }}</a> @endif </td>
                                                        <td>{{ $folder->created_at->format('d.m.Y в H:i') }}</td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/folders/{{$folder->slug}}/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.restore')}}"/><i class="fa fa-undo text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/folders/{{$folder->slug}}/delete"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.delete_folder')}}"/><i class="fa fa-remove text-white"></i></button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
