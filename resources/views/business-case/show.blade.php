@extends('layouts.template')

@section('title',$businessCase->title)
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
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="/cases">{{__('app.business_cases')}}</a></li>
                            <li class="breadcrumb-item active">{{ $businessCase->title }}</li>
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
                                <h3 class="card-title">{{ $businessCase->title }}</h3>
                                @can('Операции-с-делами')
                                <div class="mx-1 pull-right">
                                    <a href="{{ $businessCase->slug }}/delete">
                                        <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Архивировать">
                                            <i class="fa fa-remove text-white"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="mx-1 pull-right">
                                    <a href="{{ $businessCase->slug }}/edit">
                                        <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Редактировать">
                                            <i class="fa fa-edit text-white"></i>
                                        </button>
                                    </a>
                                </div>
                                @endcan
                                <?php $canViewFolder = false;
                                    foreach($businessCaseUsers as $participant) {
                                        if (\Auth::user()->id == $participant->id) $canViewFolder = true;
                                    }
                                ?>
                                @if($businessCase->folder && $canViewFolder)
                                    <div class="mx-1 pull-right">
                                        <a href="{{ $businessCase->slug }}/folder">
                                            <button class="btn btn-info">
                                                <i class="fa fa-folder text-white"></i>&nbsp;Папка дела
                                            </button>
                                        </a>
                                    </div>
                                @endif
                                <br>
                                <p class="pull-left mt-2 mb-0">Участники:
                                    @foreach($businessCaseUsers as $participant)
                                        <?php if (\Gate::check('Просмотр-пользователей')): ?><a href="/user/{{ $participant->id }}"><?php endif; ?>{{ $participant->fullname }}<?php if(\Auth::user()->can('Просмотр-пользователей')): ?></a><?php endif; ?>@if ($loop->remaining > 0), &#32;@endif
                                    @endforeach
                                </p>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <a href="/cases/{{ $businessCase->slug }}/new-dialog"
                                   class="btn btn-primary">{{__('app.new_dialog')}}</a>
                                @can('Операции-с-архивом')
                                <a href="/cases/{{ $businessCase->slug }}/archive"
                                   class="btn btn-primary pull-right">{{__('app.dialog_archive')}}</a>
                                @endcan
                                <div class="row">
                                    <?php $tablesCount = 0; ?>
                                    <?php if (!$businessCase->guests()->find(\Auth::user()->id)): ?>
                                    @if(count($publicDialogs) > 0) <?php $tablesCount++; ?>
                                    <div class="col-md-12">
                                        <h5 class="mb-0 mt-3">Публичные диалоги</h5>
                                        <div class="table-responsive no-padding">
                                            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-hover table-striped table-borderless dataTable no-footer"
                                                               role="grid" aria-describedby="dataTableAlt_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Закреплён"
                                                                        style="width: 80px">
                                                                        Закреплён</th>
                                                                    <th tabindex="0" rowspan="1" colspan="1"
                                                                        aria-label="Название">
                                                                        Название
                                                                    </th>
                                                                    @can('Операции-с-диалогами')
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Действие"
                                                                        style="width: 100px">
                                                                        Действие
                                                                    </th>
                                                                    @endcan
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                    @foreach($publicDialogs as $dialog)

                                                                    <tr role="row" class="@if($loop->count % 2 == 0)odd @else even @endif">
                                                                        <td>
                                                                            @if($dialog->pinned)
                                                                                <i class="fa fa-thumb-tack"></i>
                                                                            @endif
                                                                        </td>
                                                                        <td class="sorting_1">
                                                                            <a href="{{$businessCase->slug}}/{{ $dialog->id }}"
                                                                               class="list-title-link">{{ $dialog->title }}</a>
                                                                        </td>
                                                                        @can('Операции-с-диалогами')
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/{{ $businessCase->slug }}/{{ $dialog->id }}/edit">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Редактировать">
                                                                                                <i class="fa fa-edit text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/{{ $businessCase->slug }}/{{ $dialog->id }}/delete">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Архивировать">
                                                                                                <i class="fa fa-remove text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        @endcan
                                                                    </tr>

                                                                    @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <?php endif; ?>
                                    <?php $tetatetShown = 0;
                                    foreach($tetatetDialogs as $dialog)
                                        if ($dialog->users->where('id', \Auth::user()->id)->first()) $tetatetShown++; ?>

                                    @if(count($tetatetDialogs) > 0 & $tetatetShown > 0) <?php $tablesCount++; ?>
                                        <div class="col-md-12">
                                            <h5 class="mb-0 mt-5">Частные диалоги</h5>
                                            <div class="table-responsive no-padding">
                                                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table class="table table-hover table-striped table-borderless dataTable no-footer"
                                                                   role="grid" aria-describedby="dataTableAlt_info">
                                                                <thead>
                                                                <tr role="row">
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Закреплён"
                                                                        style="width: 80px">
                                                                        Закреплён</th>
                                                                    <th tabindex="0" rowspan="1" colspan="1"
                                                                        aria-label="Название">
                                                                        Название
                                                                    </th>
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Участники">
                                                                        Участники
                                                                    </th>
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Действие"
                                                                        style="width: 100px">
                                                                        Действие
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($tetatetDialogs as $dialog)
                                                                    @if($dialog->users()->find(\Auth::user()->id) || \Gate::check('Операции-с-диалогами'))
                                                                    <tr role="row" class="@if($loop->count % 2 == 0)odd @else even @endif">
                                                                        <td>
                                                                            @if($dialog->pinned)
                                                                                <i class="fa fa-thumb-tack"></i>
                                                                            @endif
                                                                        </td>
                                                                        <td class="sorting_1">
                                                                            <a href="{{$businessCase->slug}}/{{ $dialog->id }}"
                                                                               class="list-title-link">{{ $dialog->title }}</a>
                                                                        </td>
                                                                        <td>
                                                                            @foreach($dialog->users as $participant)
                                                                                <?php if (\Gate::check('Просмотр-пользователей')): ?><a href="/user/{{ $participant->id }}"><?php endif; ?>{{ $participant->fullname }}<?php if(\Gate::check('Просмотр-пользователей')): ?></a><?php endif; ?>@if ($loop->remaining > 0), &#32;@endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td style="min-width: 100px">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/{{ $businessCase->slug }}/{{ $dialog->id }}/edit">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Редактировать">
                                                                                                <i class="fa fa-edit text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    @can('Операции-с-диалогами')
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/{{ $businessCase->slug }}/{{ $dialog->id }}/delete">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Архивировать">
                                                                                                <i class="fa fa-remove text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    @endcan
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($tablesCount == 0)
                                        <div class="col-md-12 mt-4">
                                            <h5><i>Диалоги пока что отсутствуют.</i></h5>
                                        </div>
                                    @endif
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
