@extends('layouts.template')

@section('title', __("app.programmers_database") )
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
                            <li class="breadcrumb-item"><a href="/connections">{{__('app.connections_database')}}</a></li>
                            <li class="breadcrumb-item active">{{__('app.programmers_database')}}</li>
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
                                        <h4>{{__('app.programmers_database')}}</h4>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="/connections/programmer/create" class="btn btn-primary mb-2">{{__('app.new_programmer')}}</a>
                                    </div>
                                    <div class="table_show mb-3">
                                        <input type="checkbox" id="fullname" checked>
                                        <label for="fullname">Имя</label>
                                        <input type="checkbox" id="email" checked>
                                        <label for="email">{{__('app.email')}}</label>
                                        <input type="checkbox" id="phone" checked>
                                        <label for="phone">{{__('app.phone')}}</label>
                                        <input type="checkbox" id="experience" checked>
                                        <label for="experience">{{__('app.experience')}}</label>
                                        <input type="checkbox" id="age" checked>
                                        <label for="age">{{__('app.age')}}</label>
                                        <input type="checkbox" id="price" checked>
                                        <label for="price">{{__('app.price')}}</label>
                                        <input type="checkbox" id="position" checked>
                                        <label for="position">Деятельность</label>
                                        <input type="checkbox" id="description" checked>
                                        <label for="description">Опыт</label>
                                        <input type="checkbox" id="doc" checked>
                                        <label for="doc">Резюме</label>
                                        <input type="checkbox" id="action" checked>
                                        <label for="action">Действие</label>
                                    </div>
                                    <style>
                                        .table_show {
                                            margin-left: 8px;
                                        }
                                        .table_show input {
                                            cursor: pointer;
                                        }
                                        .table_show label {
                                            margin-right: 12px;
                                            cursor: pointer;
                                            -webkit-user-select: none; /* Safari */
                                            -moz-user-select: none; /* Firefox */
                                            -ms-user-select: none; /* IE10+/Edge */
                                            user-select: none; /* Standard */
                                        }
                                    </style>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTable" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th class="fullname_col">Имя</th>
                                                    <th class="email_col">{{__('app.email')}}</th>
                                                    <th class="phone_col">{{__('app.phone')}}</th>
                                                    <th class="experience_col">{{__('app.experience')}}</th>
                                                    <th class="age_col">{{__('app.age')}}</th>
                                                    <th class="price_col">{{__('app.price')}}</th>
                                                    <th class="region_col">Регион</th>
                                                    <th class="position_col">Деятельность</th>
                                                    <th class="description_col">Опыт</th>
                                                    <th class="doc_col">Резюме</th>
                                                    <th class="action_col" style="min-width: 100px;">{{__('app.action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($connections as $programmer)
                                                    <tr>
                                                        <td class="fullname_col">{{ $programmer->fullname }}</td>
                                                        <td class="email_col">{{ $programmer->email }}</td>
                                                        <td class="phone_col">{{ $programmer->phone }}</td>
                                                        <td class="experience_col">{{ $programmer->experience }}</td>
                                                        <td class="age_col">{{ $programmer->age }}</td>
                                                        <td class="price_col">{{ $programmer->price }}</td>
                                                        <td class="region_col">{{ $programmer->region }}</td>
                                                        <td class="position_col">{{ $programmer->position }}</td>
                                                        <td class="description_col">{{ $programmer->description }}</td>
                                                        <td class="doc_col"> @if($programmer->doc != '') <a href="{{ $programmer->doc }}" target="_blank">Открыть</a> @else Нет резюме @endif </td>
                                                        <td class="action_col">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/connections/programmer/{{$programmer->id}}/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.edit')}}"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/connections/programmer/{{$programmer->id}}/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.remove_programmer')}}"/><i class="fa fa-remove text-white"></i></button></a>
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
                                    <script>
                                        $('.table_show input').change(function(){
                                            console.log($($(this).attr('id') + "_col"));
                                            if ($(this).prop('checked')) {
                                                $('.' + $(this).attr('id') + "_col").show();
                                            } else {
                                                $('.' + $(this).attr('id') + "_col").hide();
                                            }
                                        });
                                    </script>
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
