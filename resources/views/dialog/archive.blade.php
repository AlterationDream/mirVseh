@extends('layouts.template')

@section('title', 'Архив диалогов - ' . $businessCase->title)
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
                            <li class="breadcrumb-item"><a href="/cases/archive">{{__('app.business_cases_archive')}}</a></li>
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
                                <br>
                                <p class="pull-left mt-2 mb-0">Участники:
                                    @foreach($businessCaseUsers as $participant)
                                        {{ $participant->fullname }}@if ($loop->remaining > 0), &#32;@endif
                                    @endforeach
                                </p>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <a href="/cases/{{ $businessCase->slug }}"
                                   class="btn btn-primary pull-right">{{__('app.back_to_case')}}</a>
                                <div style="clear:both"></div>

                                <div class="row">
                                    <?php $tablesCount = 0; ?>
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
                                                                <th aria-label="Удален">
                                                                    Удалён
                                                                </th>
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Действие"
                                                                    style="width: 60px">
                                                                    Действие
                                                                </th>
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
                                                                    <td>{{ \Jenssegers\Date\Date::parse($dialog->deleted_at)->format('j F Y в H:i') }}</td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="mx-1">
                                                                                    <a href="/cases/{{$businessCase->slug}}/{{$dialog->id}}/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.recover')}}"/><i class="fa fa-undo text-white"></i></button></a>
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
                                    </div>
                                    @endif

                                    @if(count($tetatetDialogs) > 0) <?php $tablesCount++; ?>
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
                                                                <th aria-label="Удален">
                                                                    Удалён
                                                                </th>
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Действие"
                                                                    style="width: 60px">
                                                                    Действие
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($tetatetDialogs as $dialog)

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
                                                                            {{ $participant->fullname }}@if ($loop->remaining > 0), &#32;@endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ \Jenssegers\Date\Date::parse($dialog->deleted_at)->format('j F Y в H:i') }}</td>
                                                                    <td style="min-width: 100px">
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="mx-1">
                                                                                    <a href="/cases/{{$businessCase->slug}}/{{$dialog->id}}/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.recover')}}"/><i class="fa fa-undo text-white"></i></button></a>
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
                                    </div>
                                    @endif

                                    @if($tablesCount == 0)
                                        <div class="col-md-12 mt-1">
                                            <h5><i>Архивированные диалоги для этого дела пока что отсутствуют.</i></h5>
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
