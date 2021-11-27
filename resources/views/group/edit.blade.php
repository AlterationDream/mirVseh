@extends('layouts.template')

@section('title','Редактирование группы пользователей')
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
                            <li class="breadcrumb-item"><a href="/groups">{{__('app.groups')}}</a></li>
                            <li class="breadcrumb-item active">Редактирование - {{ $group->title }}</li>
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
                                <h3 class="card-title">{{ $group->title }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/groups/{{ $group->id }}/edit" method="POST" class="form-horizontal" id="folder-create" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="{{__('app.group_title')}}" value="<?php if ( !old('title') ) echo $group->title; else echo old('title'); ?>">
                                                <label class="mt-2 ml-1" for="users">{{__('app.group_users')}}</label>
                                                <div id="user-select"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" id="submit" class="btn btn-primary col-md-12" value="{{__('app.save_group')}}">
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
            placeholder: 'Выберите пользователей',
            disableSelectAll: true,
            noOptionsText: 'Пользователей не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: <?php
            echo ( !old('users') ) ?
                '\'' . Auth::user()->id . '\''
                :
                '[' . old('users') . ']'; ?>,
            clearButtonText: 'очистить',
            noOfDisplayValues: 0,
        });
    </script>

    <!-- /.content-wrapper -->
@endsection
