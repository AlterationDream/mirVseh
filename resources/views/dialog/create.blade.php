@extends('layouts.template')

@section('title', 'Новый диалог')
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
                            <li class="breadcrumb-item"><a href="/cases">{{__('app.business_cases')}}</a></li>
                            <li class="breadcrumb-item"><a href="/cases/{{ $businessCase->slug }}">{{ $businessCase->title }}</a></li>
                            <li class="breadcrumb-item active">{{__('app.new_dialog')}}</li>
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
                                <h3 class="card-title"> {{__('app.new_dialog')}} </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/cases/{{ $businessCase->slug }}/new-dialog" method="POST" class="form-horizontal" id="business-case-create">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="{{__('app.dialog_title')}}">
                                                <label id="user-select-label" for="users" class="mt-2 ml-1" style="display: none">{{__('app.dialog_participants')}}:</label>
                                                <div id="user-select" style="display: none"></div>
                                                @can('Операции-с-диалогами')
                                                <label for="pinned" class="mt-4 ml-1">Закрепить диалог</label>
                                                <input type="checkbox" name="pinned" value="1">
                                                @endcan
                                                <br>
                                                <label for="tetatet" class="mt-2 ml-1">Частный диалог</label>
                                                <input type="checkbox" name="tetatet" value="1" id="tetatet" onclick="userSelectChange(this)">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="{{__('app.publish_dialog')}}">
                                        </div>
                                    </form>
                                </article>
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

    <script>
        userSelectOptions = [
            @foreach($users as $user)
                { label: '{{$user->fullname}}', value: '{{$user->id}}'},
            @endforeach
        ];

        VirtualSelect.init({
            ele: '#user-select',
            options: userSelectOptions,
            multiple: true,
            search: true,
            name: 'users',
            disableSelectAll: true,
            placeholder: "Выберите пользователей",
            noOptionsText: 'Пользователей не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: '{{ \Auth::user()->id }}',
            clearButtonText: 'очистить',
            noOfDisplayValues: 0,
        });

        function userSelectChange(element) {
            let state = element.checked;
            if (state) {
                $('#user-select-label').show();
                $('#user-select').show();
            } else {
                $('#user-select-label').hide();
                $('#user-select').hide();
            }
        }
    </script>

    <!-- /.content-wrapper -->
@endsection
