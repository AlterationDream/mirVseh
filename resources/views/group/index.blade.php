@extends('layouts.template')

@section('title','Группы пользователей')
@section('style')
    <style>
        .dropstyle {
            padding: 4px 0;
            max-height: 180px;
            min-width: 212px;
            overflow-y: scroll;
        }

        .dropstyle li a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .dropstyle li a:hover {
            color: #262626;
            text-decoration: none;
            background-color: #f5f5f5;
        }
    </style>
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
                            <li class="breadcrumb-item active">{{__('app.groups')}}</li>
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
                                        <h4>{{__('app.groups')}}</h4>
                                    </div>
                                    <?php //@if(count($businessCases) > 0) ?>
                                    @can('Операции-с-делами')
                                        <div class="col-md-12 mb-3">
                                            <a href="/groups/create" class="btn btn-primary">{{__('app.new_group')}}</a>
                                        </div>
                                    @endcan
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding" style="overflow-x: unset">
                                            <table id="dataTable" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th>{{__('app.title')}}</th>
                                                    <th>Участники</th>
                                                    <th style="width: 100px;">{{__('app.action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($groups as $group)

                                                    <tr>
                                                        <td>{{ $group->title }}</td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Список пользователей
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropstyle">
                                                                    @foreach($group->users as $user)
                                                                        <li><a href="/user/{{ $user->id }}">{{ $user->fullname }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/groups/{{$group->id}}/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.edit_group')}}"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/groups/{{$group->id}}/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.remove_group')}}"/><i class="fa fa-remove text-white"></i></button></a>
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
