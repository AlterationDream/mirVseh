@extends('layouts.template')

@section('title','Роли пользователей')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Роли пользователей</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">{{__('app.home')}}</a></li>
              <li class="breadcrumb-item active">Роли пользователей</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <a href="{{route('role.create')}}" class="pull-right btn btn-primary">{{__('app.create_role')}}</a>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive no-padding">
                <table id="dataTable" class="table table-hover table-borderless table-striped">
                  <thead>
                  <tr>
                    <th class="">{{__('app.name')}}</th>
                    <th class="">{{__('app.created_at')}}</th>
                    <th class="">{{__('app.updated_at')}}</th>
                    <th class="">{{__('app.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($roles as $role)
                  <tr>
                    <td>{{str_replace('-', ' ', $role->name)}}</td>
                    <td data-sort="{{$role->created_at}}">{{$role->created_at->format('d.m.Y в H:i')}}</td>
                    <td data-sort="{{$role->updated_at}}">{{$role->updated_at->format('d.m.Y в H:i')}}</td>
                    <td>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="mx-1">
                            <a href="{{route('role.show',$role->id)}}"><button class="btn btn-success btn-sm" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.add_permission')}}"/><i class="fa fa-shield"></i></button></a>
                          </div>
                          <div class="mx-1">
                            <a href="{{route('role.edit',$role->id)}}"><button class="btn btn-info btn-sm" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.edit_role')}}"/><i class="fa fa-edit text-white"></i></button></a>
                          </div>
                          @if($role->removable)
                          <div class="mx-1">
                            <form action="{{route('role.destroy',$role->id)}}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.delete_role')}}"/><i class='fa fa-trash text-white'></i></button>
                            </form>
                          </div>
                          @endif
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
