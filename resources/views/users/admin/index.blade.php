@extends('layouts.template')
@section('title','Пользователи')
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
                            <li class="breadcrumb-item active">{{__('app.users')}}</li>
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
                                        <h4>{{__('app.users')}}</h4>
                                    </div>
                                    @can('Операции-с-пользователями')
                                    <div class="col-md-12 mb-3">
                                        <a href="{{route('user.create')}}"
                                           class="pull-right btn btn-primary">{{__('app.create_user')}}</a>
                                    </div>
                                    @endcan
                                    <!--div class="col-md-4 mb-2">
                                        <form class="form" action="" method="GET">
                                            <div class="input-group">
                                                <input type="text" name="search"
                                                       value="{{ request()->input('search') }}" class="form-control"
                                                       placeholder="{{__('app.search')}}">
                                                @if(request()->input('search') && request()->input('search')!= '')
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary"
                                                           href="{{route('user.index')}}" type="submit"><i
                                                                class="fa fa-close"></i></a>
                                                    </div>
                                                @endif
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit"><i
                                                            class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div-->
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTableUsers" class="table table-hover table-borderless table-striped">
                                                <thead>
                                                <tr>
                                                    <th>{{__('app.picture')}}</th>
                                                    <th>{{__('app.fullname')}}</th>
                                                    <th>{{__('app.username')}}</th>
                                                    <th>{{__('app.email')}}</th>
                                                    <th>{{__('app.status')}}</th>
                                                    <th>Зарегистрирован</th>
                                                    @can('Операции-с-пользователями')
                                                        <th style="min-width:100px">{{__('app.action')}}</th>@endcan
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($users))
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td><a href="{{route('user.show',$user->id)}}"><img
                                                                        class="img-fluid rounded-circle" width="50px"
                                                                        src="{{($user->avatar)? $user->avatar : asset('uploads/avatar/avatar.png')}}"
                                                                        alt="icon"></a></td>
                                                            <td>
                                                                <a href="{{route('user.show',$user->id)}}">{{$user->fullname}}</a>
                                                            </td>
                                                            <td>{{$user->username}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>
                                                                @if($user->status=='active')
                                                                    <span class="badge badge-success">Активен</span>
                                                                @elseif($user->status=='banned')
                                                                    <span class="badge badge-danger">Заблокирован</span>
                                                                @endif
                                                            </td>
                                                            <td data-sort="{{$user->getAttributes()['created_at']}}">{{$user->created_at}}</td>

                                                            @can('Операции-с-пользователями')
                                                            <td>
                                                                <div class="d-inline-block">
                                                                    <div class="dropdown">
                                                                        @if($user->username != 'admin')
                                                                            @canBeImpersonated($user)
                                                                            <a href="{{route('impersonate',$user->id)}}"
                                                                               class="btn btn-success btn-sm"
                                                                               data-toggle="tooltip"
                                                                               data-placement="bottom"
                                                                               title="{{__('app.impersonate_user')}}"><i
                                                                                    class="fa text-white fa-user-secret"></i></a>
                                                                            @endCanBeImpersonated
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <a href="{{route('user.edit',$user->id)}}"
                                                                       class="btn btn-primary btn-sm"><i
                                                                            class="fa fa-edit" data-toggle="tooltip"
                                                                            data-placement="bottom"
                                                                            title="{{__('app.edit')}}"></i></a>
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    @if($user->username != 'admin')
                                                                        <form
                                                                            action="{{route('user.destroy',$user->id)}}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#deleteUser{{$user->id}}">
                                                                                <i class='fa fa-trash'
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="bottom"
                                                                                   title="{{__('app.delete')}}"></i>
                                                                            </button>
                                                                            <div class="modal fade"
                                                                                 id="deleteUser{{$user->id}}"
                                                                                 tabindex="-1" role="dialog"
                                                                                 aria-labelledby="deleteUserLabel"
                                                                                 aria-hidden="true">
                                                                                <div class="modal-dialog"
                                                                                     role="document">
                                                                                    <div class="modal-content">
                                                                                        <div
                                                                                            class="modal-body text-center">
                                                                                            <h3 class="mb-4">{{__('app.please_confirm')}}</h3>
                                                                                            <p class="mb-5">{{__('app.delete_user_confirm')}}</p>
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary col-md-5 pull-left"
                                                                                                    data-dismiss="modal">{{__('app.close')}}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-danger col-md-6 pull-right">{{__('app.delete')}}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                                <!-- </div> -->
                                                            </td>
                                                            @endcan
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <p><i>{{__('app.no_record')}}</i></p>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <?php //{{$users->links()}}?>
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
