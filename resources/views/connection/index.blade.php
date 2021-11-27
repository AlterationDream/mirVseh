@extends('layouts.template')

@section('title',__('app.connections_database'))
@section('style')
    <!--link rel="stylesheet" type="text/css"  href="{{asset('assets/css/articleStyle.css')}}"></link-->
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('app.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('app.connections_database')}}</li>
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
                                        <h4>{{__('app.connections_database')}}</h4>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-4">
                                            <div class="info-box shadow p-3 hover-box" onclick="window.open('/connections/prospector','_self');">
                                                <a href="/connections/prospector"
                                                   class="info-box-icon bg-navy elevation-1"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title=""
                                                   data-original-title="База изыскателей">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <div class="info-box-content">
                                                    <a class="info-box-text list-title-link" href="/connections/prospector">Изыскатели</a>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box shadow p-3 hover-box" onclick="window.open('/connections/customer','_self');">
                                                <a href="/connections/customer"
                                                   class="info-box-icon bg-olive elevation-1"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title=""
                                                   data-original-title="База клиентов">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <div class="info-box-content">
                                                    <a class="info-box-text list-title-link" href="/connections/customer">Клиенты</a>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box shadow p-3 hover-box" onclick="window.open('/connections/programmer','_self');">
                                                <a href="/connections/programmer"
                                                   class="info-box-icon bg-blue elevation-1"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title=""
                                                   data-original-title="База программистов">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <div class="info-box-content">
                                                    <a class="info-box-text list-title-link" href="/connections/programmer">Программисты</a>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
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
