@extends('layouts.template')

<?php $subfolder = ($subfolders != '');
$title = ($subfolder) ? end($subfolders)->title : $folder->title;
$baseLink = ($folder->business_case) ?
    '/cases/' . $folder->business_case->slug . '/folder/'
    :
    '/folders/' . $folder->slug . '/';?>

@section('title', $title)

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
                            @if($folder->business_case)
                                <li class="breadcrumb-item"><a href="/cases">{{ __('app.business_cases') }}</a></li>
                                <li class="breadcrumb-item"><a href="/cases/{{ $folder->business_case->slug }}">{{ $folder->business_case->title }}</a></li>
                            @else
                                <li class="breadcrumb-item"><a href="/folders">{{ __('app.folders') }}</a></li>
                            @endif
                            <li class="breadcrumb-item <?php if (!$subfolder): ?>active<?php endif; ?>">
                                <?if ($subfolder): ?><a href="{{ $baseLink }}"><? endif; ?>
                                        @if($folder->business_case)
                                            Папка дела
                                        @else
                                            {{ $folder->title }}
                                        @endif
                                <?if ($subfolder): ?></a><? endif; ?>
                            </li>
                            <?php if ($subfolder) {
                                $link = substr($baseLink, 0, -1);
                                foreach ($subfolders as $key => $sub) {
                                    if ($subfolders[$key] == end($subfolders)) {
                                        $link .= '/' . $sub->id;
                                        echo '<li class="breadcrumb-item active">' . $sub->title . '</li>';
                                    } else {
                                        $link .= '/' . $sub->id;
                                        echo '<li class="breadcrumb-item"><a href="' . $link . '">' . $sub->title . '</a></li>';
                                    }
                                }
                            } ?>
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
                                        <h3><?php if ($subfolder): ?>{{ end($subfolders)->title }}<?php else: ?>{{ $folder->title }}<?php endif; ?></h3>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>create"
                                           class="btn btn-primary">{{__('app.new_folder')}} / Загрузить файл(ы)</a>

                                        @can('Операции-с-архивом')
                                            @if($isArchive)
                                                <a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>"
                                                   class="btn btn-primary pull-right">Назад к папке</a>
                                            @else <a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>archive"
                                                                      class="btn btn-primary pull-right">{{__('app.folder_archive')}}</a>
                                            @endif
                                        @endcan
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTableAlt2" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 38px;"></th>
                                                        <th class="">{{__('app.title')}}</th>
                                                        <th class="">{{__('app.created_at')}}</th>
                                                        <th class="" style="width: 100px;">{{__('app.action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($folder->files as $file)
                                                    <tr>
                                                        <td><a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>{{$file->id}}" <?php if ($file->type != 'folder'): ?>target="_blank"<?php endif; ?>><span style="display: none"><?php if ($file->type == 'folder'): ?>0<?php else: ?>1<?php endif; ?></span><img src="<?php if ($file->type == 'folder'): ?>/uploads/avatar/folder.png<?php else: ?>/uploads/avatar/file.png<?endif;?>" style="max-height: 38px"></a></td>
                                                        <td data-sort="<?php echo ($file->type == 'folder') ? '0 - ' : '1 - '; ?>{{$file->title}}{{$file->extension}}"><a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>{{$file->id}}" class="list-title-link" <?php if ($file->type != 'folder'): ?>target="_blank"<?php endif; ?>>{{ $file->title }}<?php if ($file->type == 'file'){ echo $file->extension; }?></a></td>
                                                        <td data-sort="{{ $file->created_at->format('Y-m-d H:i:s') }}">{{ $file->created_at->format('H:i:s - d.m.Y') }}</td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        @if(!$isArchive)
                                                                        <a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>{{$file->id}}/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Архивировать"/><i class="fa fa-remove text-white"></i></button></a>
                                                                        @else
                                                                        <a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>{{$file->id}}/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Восстановить"/><i class="fa fa-undo text-white"></i></button></a>
                                                                        <a href="<?php if ($subfolder): ?>{{ $link }}/<?php else: ?>{{ $baseLink }}<?php endif; ?>{{$file->id}}/delete"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Удалить с диска"/><i class="fa fa-remove text-white"></i></button></a>
                                                                        @endif
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
