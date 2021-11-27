@extends('layouts.template')

@section('title','Дела')
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
                            <li class="breadcrumb-item active">{{__('app.business_cases')}}</li>
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
                                        <h4>{{__('app.business_cases')}}</h4>
                                    </div>
                                    <?php //@if(count($businessCases) > 0) ?>
                                        @can('Операции-с-делами')
                                        <div class="col-md-12 mb-3">
                                            <a href="/cases/create" class="btn btn-primary">{{__('app.new_business_case')}}</a>
                                        </div>
                                        @endcan
                                        <div class="col-md-12">
                                            <div class="table-responsive no-padding">
                                                <table id="dataTableAlt" class="table table-hover table-striped table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 38px;"></th>
                                                        <th>{{__('app.title')}}</th>
                                                        <!--th class="">{{__('app.created_at')}}</th>
                                                        <th class="">{{__('app.updated_at')}}</th-->
                                                        <th>Участники</th>
                                                        <th style="width: 100px;">{{__('app.action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach ($businessCases as $case)

                                                        <tr>
                                                            <td><a href="cases/{{$case->slug}}"><img src="{{ $case->image }}" alt="{{ $case->name }}" style="max-height: 38px"></a></td>
                                                            <td><a href="cases/{{$case->slug}}" class="list-title-link">{{ $case->title }}</a></td>
                                                            <!--td>{{ date('Y-m-d',strtotime($case->created_at))}}</td>
                                                            <td>{{ date('Y-m-d',strtotime($case->updated_at))}}</td-->
                                                            <td>
                                                                @foreach($case->users as $participant)
                                                                    <?php if (\Gate::check('Просмотр-пользователей')): ?><a href="/user/{{ $participant->id }}"><?php endif; ?>{{ $participant->fullname }}<?php if(\Gate::check('Просмотр-пользователей')): ?></a><?php endif; ?>@if ($loop->remaining > 0), &#32;@endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="mx-1">
                                                                            <a href="/cases/{{$case->slug}}/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.edit')}}"/><i class="fa fa-edit text-white"></i></button></a>
                                                                        </div>
                                                                        <div class="mx-1">
                                                                            <a href="/cases/{{$case->slug}}/delete"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.remove_business_case')}}"/><i class="fa fa-remove text-white"></i></button></a>
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
                                    <?php /*@else
                                        <div class="col-md-12 mt-4">
                                            <h5><i>Дела пока что отсутствуют.</i></h5>
                                        </div>
                                    @endif */?>
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
