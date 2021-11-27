<?php $__env->startSection('title','Группы пользователей'); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .dropstyle {
            padding: 4px 0;
            max-height: 180px;
            min-width: 212px;
            overflow-y: scroll;
        }

        .dropstyle li a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .dropstyle li a:hover {
            color: #262626;
            text-decoration: none;
            background-color: #f5f5f5;
        }
    </style>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.groups')); ?></li>
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
                                        <h4><?php echo e(__('app.groups')); ?></h4>
                                    </div>
                                    <?php //@if(count($businessCases) > 0) ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-делами')): ?>
                                        <div class="col-md-12 mb-3">
                                            <a href="/groups/create" class="btn btn-primary"><?php echo e(__('app.new_group')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding" style="overflow-x: unset">
                                            <table id="dataTable" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__('app.title')); ?></th>
                                                    <th>Участники</th>
                                                    <th style="width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <tr>
                                                        <td><?php echo e($group->title); ?></td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Список пользователей
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropstyle">
                                                                    <?php $__currentLoopData = $group->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><a href="/user/<?php echo e($user->id); ?>"><?php echo e($user->fullname); ?></a></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/groups/<?php echo e($group->id); ?>/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit_group')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/groups/<?php echo e($group->id); ?>/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.remove_group')); ?>"/><i class="fa fa-remove text-white"></i></button></a>
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
                                    <?php /*@else
                                        <div class="col-md-12 mt-4">
                                            <h5><i>Дела пока что отсутствуют.</i></h5>
                                        </div>
                                    @endif */?>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/group/index.blade.php ENDPATH**/ ?>