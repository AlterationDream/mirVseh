<?php $subfolder = ($subfolders != '');
$title = ($subfolder) ? end($subfolders)->title : $folder->title;
$baseLink = ($folder->business_case) ?
    '/cases/' . $folder->business_case->slug . '/folder/'
    :
    '/folders/' . $folder->slug . '/';?>

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('style'); ?>
    <!--link rel="stylesheet" type="text/css"  href="<?php echo e(asset('assets/css/articleStyle.css')); ?>"></link-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <?php if($folder->business_case): ?>
                                <li class="breadcrumb-item"><a href="/cases"><?php echo e(__('app.business_cases')); ?></a></li>
                                <li class="breadcrumb-item"><a href="/cases/<?php echo e($folder->business_case->slug); ?>"><?php echo e($folder->business_case->title); ?></a></li>
                            <?php else: ?>
                                <li class="breadcrumb-item"><a href="/folders"><?php echo e(__('app.folders')); ?></a></li>
                            <?php endif; ?>
                            <li class="breadcrumb-item <?php if (!$subfolder): ?>active<?php endif; ?>">
                                <?if ($subfolder): ?><a href="<?php echo e($baseLink); ?>"><? endif; ?>
                                        <?php echo e($folder->title); ?>

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
                        <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3><?php if ($subfolder): ?><?php echo e(end($subfolders)->title); ?><?php else: ?><?php echo e($folder->title); ?><?php endif; ?></h3>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?>create"
                                           class="btn btn-primary"><?php echo e(__('app.new_folder')); ?> / Загрузить файл(ы)</a>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-архивом')): ?>
                                            <?php if($isArchive): ?>
                                                <a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?>"
                                                   class="btn btn-primary pull-right">Назад к папке</a>
                                            <?php else: ?> <a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?>archive"
                                                                      class="btn btn-primary pull-right"><?php echo e(__('app.folder_archive')); ?></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTableAlt2" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 38px;"></th>
                                                        <th class=""><?php echo e(__('app.title')); ?></th>
                                                        <th class=""><?php echo e(__('app.created_at')); ?></th>
                                                        <th class="" style="width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php $__currentLoopData = $folder->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?><?php echo e($file->id); ?>" <?php if ($file->type != 'folder'): ?>target="_blank"<?php endif; ?>><span style="display: none"><?php if ($file->type == 'folder'): ?>0<?php else: ?>1<?php endif; ?></span><img src="<?php if ($file->type == 'folder'): ?>/uploads/avatar/folder.png<?php else: ?>/uploads/avatar/file.png<?endif;?>" style="max-height: 38px"></a></td>
                                                        <td data-sort="<?php echo ($file->type == 'folder') ? '0 - ' : '1 - '; ?><?php echo e($file->title); ?><?php echo e($file->extension); ?>"><a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?><?php echo e($file->id); ?>" class="list-title-link" <?php if ($file->type != 'folder'): ?>target="_blank"<?php endif; ?>><?php echo e($file->title); ?><?php if ($file->type == 'file'){ echo $file->extension; }?></a></td>
                                                        <td data-sort="<?php echo e($file->created_at->format('Y-m-d H:i:s')); ?>"><?php echo e($file->created_at->format('H:i:s - d.m.Y')); ?></td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <?php if(!$isArchive): ?>
                                                                        <a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?><?php echo e($file->id); ?>/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Архивировать"/><i class="fa fa-remove text-white"></i></button></a>
                                                                        <?php else: ?>
                                                                        <a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?><?php echo e($file->id); ?>/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Восстановить"/><i class="fa fa-undo text-white"></i></button></a>
                                                                        <a href="<?php if ($subfolder): ?><?php echo e($link); ?>/<?php else: ?><?php echo e($baseLink); ?><?php endif; ?><?php echo e($file->id); ?>/delete"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Удалить с диска"/><i class="fa fa-remove text-white"></i></button></a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/folder/show.blade.php ENDPATH**/ ?>