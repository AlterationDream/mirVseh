<?php $__env->startSection('title','Редактирование папки - ' . $folder->title); ?>
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
                            <li class="breadcrumb-item"><a href="/folders"><?php echo e(__('app.folders')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e($folder->title); ?></li>
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
                        <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e($folder->title); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/folders/<?php echo e($folder->slug); ?>/edit" method="POST" class="form-horizontal" id="folder-create">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('app.folder_title')); ?>" value="<?php if ( !old('title') ) echo $folder->title; else echo old('title'); ?>">
                                                <label id="user-select-label" for="business-case" class="mt-2 ml-1"><?php echo e(__('app.assigned_business_case')); ?>:</label><br>
                                                <select name="businessCase" class="form-control">
                                                    <option value="0" <?php if (!$folder->business_case): ?>selected<?php endif; ?>>Не привязывать</option>
                                                    <?php if($businessCase): ?>
                                                        <option value="<?php echo e($businessCase->id); ?>" selected><?php echo e($businessCase->title); ?></option>
                                                    <?php endif; ?>
                                                    <?php $__currentLoopData = $businessCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($case->id); ?>" <?php if ($folder->business_case && $folder->business_case->id == $case->id):?>selected<?php endif; ?>><?php echo e($case->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.edit_folder')); ?>">
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

    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/folder/edit.blade.php ENDPATH**/ ?>