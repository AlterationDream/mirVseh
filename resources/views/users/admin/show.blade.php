@extends('layouts.template')

@section('title','Пользователь ' . $user->fullname)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$user->fullname}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">{{__('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user.index')}}">{{__('app.users')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('app.profile')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    @include('layouts.includes.alerts')
                    <!-- Profile Image -->
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="img profile-user-img img-responsive img-circle" src="{{$user->avatar}}"
                                     alt="User profile picture">
                                <h5 class="mt-3 mb-0"><b>{{$user->fullname}}</b></h5>
                                <p>{{$user->email}}</p>
                                <div class="col-md-12">
                                    <span class="mt-0 d-block">
                                        <p><b>Дата последнего входа:</b>
                                            {{empty($user->last_login_at)? 'Не входил': ($user->last_login_at)->diffForHumans() }}
                                        </p>
                                    </span>
                                    <span class="mt-0 d-block"><p><b>{{__('app.joined')}}:</b>
                                          {{$user->created_at}}
                                        </p>
                                    </span>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            @canany(['Операции-с-пользователями', 'Просмотр-истории-активности'])
                                <div class="card-header">
                                    @can('Операции-с-пользователями')
                                    <div class="mx-1 pull-right">
                                        <a href="/edit">
                                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Редактировать" data-target="#deleteUser3">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mx-1 pull-right">
                                        <a href="/user/{{ $user->id }}/edit">
                                            <button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mx-1 pull-right">
                                        <a href="/impersonate/take/{{ $user->id }}">
                                            <button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom"
                                                    title="" data-original-title="Зайти от лица пользователя">
                                                <i class="fa text-white fa-user-secret"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('Просмотр-истории-активности')
                                    <div class="mx-1 pull-right">
                                        <a href="/user/{{ $user->id }}/activity-log">
                                            <button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom"
                                                    title="" data-original-title="История активности">
                                                <i class="fa text-white fa-history"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endcan
                                </div>
                            @endcanany
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label>{{__('app.role')}}</label>
                                        <p>{{ str_replace('-', ' ', $user_role->name) }}</p>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label>{{__('app.status')}}</label>
                                        <p>@if($user->status == 'active')
                                                Активный
                                            @elseif($user->status == 'banned')
                                                Заблокирован
                                            @endif</p>
                                    </div>
                                    <div id="birthday" class="col-sm-6 mb-1 mt-1">
                                        <label for="name">{{__('app.birthday')}}</label>
                                        <p>@if($user->birthday)
                                            {{ \Jenssegers\Date\Date::parse($user->birthday)->format("j F Y") }}
                                            @else Не указан @endif</p>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div><label class="label-block">{{__('app.phone')}}</label></div>
                                        <p>@if($user->phone != '') {{ $user->phone }} @else Не указан @endif</p>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="mobile">{{__('app.country')}}</label>
                                        <p>@if($user->country != '') {{ $user->country }} @else Не указана @endif</p>
                                    </div>
                                    <div class="col-sm-6 mt-1">
                                        <label for="address"
                                               class="control-label">{{__('app.address')}}</label>
                                        <p>@if($user->address != '') {{ $user->address }} @else Не указан @endif</p>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card -->
                        </div>
                    </div>
                <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
