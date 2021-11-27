@extends('layouts.template')

@section('title','Редактирование дела - ' . $businessCase->title)
@section('style')
    <style>
        label[for=folder] {
            display: block;
        }
        #folder-select {
            min-width: 285px;
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
                            <li class="breadcrumb-item"><a href="/cases">{{__('app.business_cases')}}</a></li>
                            <li class="breadcrumb-item"><a href="/cases/{{ $businessCase->slug }}">{{ $businessCase->title }}</a></li>
                            <li class="breadcrumb-item active">{{__('app.edit')}}</li>
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/cases/{{ $businessCase->slug }}/edit" method="POST" class="form-horizontal" id="business-case-create">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-auto croppie-form">
                                                <div id="avatar-holder" class="col-md-12 row">
                                                    <img id="avatar-img" width="40px" height="100px" class="img profile-user-img img-responsive img-circle" src="/{{ $businessCase->image }}" alt="Изображение дела">
                                                    <label class="btn btn-secondary btn-lg d-block mx-auto mt-5 col-sm-12 mb-0" for="upload">
                                                        Обновить изображение
                                                        <input type="file" id="upload" name="image-upload" class="d-none">
                                                        <input type="hidden" name="image_changed" value="0" id="image_changed">
                                                    </label>
                                                </div>

                                                <div id="upload-demo" style="width:300px; height: unset; display: none"></div>
                                                <label class="btn btn-secondary btn-lg mx-auto mt-5 col-sm-12 mb-0" id='cancel-upload' onclick="cancelUpload()" style="display:none">Отменить</label>
                                                <input type="hidden" id="hidden-upload" name="image">
                                            </div>

                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="{{__('app.business_case_title')}}" value="<?php if ( !old('title') ) echo $businessCase->title; else echo old('title'); ?>">
                                                <label for="users" class="mt-2 ml-1">{{__('app.business_case_participants')}}:</label><br>
                                                <div id="user-select"></div>
                                                <label for="folder" class="mt-2 ml-1">{{__('app.select_folder')}}:</label>
                                                <div id="folder-select"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="{{__('app.update_business_case')}}">
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
        folderSelectOptions = [
            { label: 'Не привязывать', value: '0'},
            @foreach($folders as $folderVal)
                { label: '{{$folderVal->title}}', value: '{{$folderVal->id}}'},
            @endforeach
        ];

        VirtualSelect.init({
            ele: '#folder-select',
            options: folderSelectOptions,
            multiple: false,
            search: true,
            name: 'folder',
            placeholder: 'Выберите папку (не обязательно)',
            disableSelectAll: true,
            noOptionsText: 'Папок не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: <?php
                echo ( !old('folder') ) ?
                    ($folder) ? $folder->id : '0'
                :
                    old('folder'); ?>,
            hideClearButton: true,
            noOfDisplayValues: 0,
        });
    </script>

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
            noOptionsText: 'Пользователей не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: [<?php echo ( !old('users') ) ? $userIDs : old('users'); ?>],
            clearButtonText: 'очистить',
            noOfDisplayValues: 0,
        });
    </script>

    <script type="text/javascript">

        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload').on('change', function () {
            console.log( $('#upload').val() );

            if ( $('#upload').val() != '' ) {
                $('#upload-demo').show();
                $('#avatar-holder').hide();
                $("#cancel-upload").show();
                $("#image_changed").val(1);
            } else {
                $('#upload-demo').hide();
                $('#avatar-holder').show();
                $("#cancel-upload").hide();
                $("#image_changed").val(0);
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#business-case-create').submit(function() {
            if ( $('#upload').val() != '' ) {
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    size: 'viewport'
                }).then(function (resp) {
                    $('#hidden-upload').val(resp);
                });
            }
            return true;
        });

        function cancelUpload() {
            $('#upload').val('');
            $('#upload').change();
        }
    </script>
    <!-- /.content-wrapper -->
@endsection
