<?php $__env->startSection('title','Редактирование диалога - ' . $dialog->title); ?>
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
                            <li class="breadcrumb-item"><a href="/cases"><?php echo e(__('app.business_cases')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases/<?php echo e($businessCase->slug); ?>"><?php echo e($businessCase->title); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>"><?php echo e($dialog->title); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('app.edit')); ?></li>
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
                                <h3 class="card-title"><?php echo e($dialog->title); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/edit" method="POST" class="form-horizontal" id="business-case-create">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('app.dialog_title')); ?>"
                                                       value="<?php if (!old('title')) echo $dialog->title; else echo old('title');?>">
                                                <label for="users" class="mt-2 ml-1"><?php echo e(__('app.dialog_participants')); ?>:</label><br>
                                                <div id="user-select"></div>
                                                <label for="pinned" class="mt-4 ml-1">Закрепить диалог</label>
                                                <input type="checkbox" name="pinned" value="1" <?php if($dialog->pinned): ?> checked <?php endif; ?> >
                                                <br>
                                                <label for="pinned" class="mt-2 ml-1">Частный диалог</label>
                                                <input type="checkbox" name="tetatet" value="1" id="tetatet"
                                                        <?php if($dialog->tetatet): ?> checked <?php endif; ?> >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.update_dialog')); ?>">
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
            disableSelectAll: true,
            noOptionsText: 'Пользователей не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: [<?php echo ( !old('users') ) ? $userIDs : old('users'); ?>],
            clearButtonText: 'очистить',
            noOfDisplayValues: 0,
        });
    </script>

    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/dialog/edit.blade.php ENDPATH**/ ?>