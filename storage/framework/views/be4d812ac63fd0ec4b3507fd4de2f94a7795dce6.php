<?php $__env->startSection('title','Редактирование группы пользователей'); ?>
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
                            <li class="breadcrumb-item"><a href="/groups"><?php echo e(__('app.groups')); ?></a></li>
                            <li class="breadcrumb-item active">Редактирование - <?php echo e($group->title); ?></li>
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
                                <h3 class="card-title"><?php echo e($group->title); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/groups/<?php echo e($group->id); ?>/edit" method="POST" class="form-horizontal" id="folder-create" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('app.group_title')); ?>" value="<?php if ( !old('title') ) echo $group->title; else echo old('title'); ?>">
                                                <label class="mt-2 ml-1" for="users"><?php echo e(__('app.group_users')); ?></label>
                                                <div id="user-select"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" id="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.save_group')); ?>">
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
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            { label: '<?php echo e($user->fullname); ?>', value: '<?php echo e($user->id); ?>'},
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/group/edit.blade.php ENDPATH**/ ?>