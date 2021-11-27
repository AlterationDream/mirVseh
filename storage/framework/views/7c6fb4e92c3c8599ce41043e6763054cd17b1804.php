<?php $__env->startSection('title','Папки дел'); ?>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.folders')); ?></li>
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
                                        <h4><?php echo e(__('app.folders')); ?></h4>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="/folders/create" class="btn btn-primary"><?php echo e(__('app.new_folder')); ?></a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTableAlt4" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th style="width: 38px;"></th>
                                                    <th class=""><?php echo e(__('app.title')); ?></th>
                                                    <th class="">Привязанное дело</th>
                                                    <th class="">Создана</th>
                                                    <th class="" style="width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><a href="folders/<?php echo e($folder->slug); ?>"><img src="/uploads/avatar/folder.png" style="max-height: 38px"></a></td>
                                                        <td><a href="folders/<?php echo e($folder->slug); ?>" class="list-title-link"><?php echo e($folder->title); ?></a></td>
                                                        <td <?php if(!$folder->business_case): ?> data-sort="ι" <?php endif; ?> > <?php if($folder->business_case): ?> <a href="cases/<?php echo e($folder->business_case->slug); ?>" class="list-title-link"><?php echo e($folder->business_case->title); ?></a> <?php endif; ?> </td>
                                                        <td data-sort="<?php echo e($folder->created_at->format('Y-m-d H:i:s')); ?>"><?php echo e($folder->created_at->format('d.m.Y в H:i')); ?></td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/folders/<?php echo e($folder->slug); ?>/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/folders/<?php echo e($folder->slug); ?>/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.remove_folder')); ?>"/><i class="fa fa-remove text-white"></i></button></a>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/folder/index.blade.php ENDPATH**/ ?>