<?php $__env->startSection('title','Дела'); ?>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.business_cases')); ?></li>
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
                                        <h4><?php echo e(__('app.business_cases')); ?></h4>
                                    </div>
                                    <?php //@if(count($businessCases) > 0) ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-делами')): ?>
                                        <div class="col-md-12 mb-3">
                                            <a href="/cases/create" class="btn btn-primary"><?php echo e(__('app.new_business_case')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                            <div class="table-responsive no-padding">
                                                <table id="dataTableAlt" class="table table-hover table-striped table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 38px;"></th>
                                                        <th><?php echo e(__('app.title')); ?></th>
                                                        <!--th class=""><?php echo e(__('app.created_at')); ?></th>
                                                        <th class=""><?php echo e(__('app.updated_at')); ?></th-->
                                                        <th>Участники</th>
                                                        <th style="width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php $__currentLoopData = $businessCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <tr>
                                                            <td><a href="cases/<?php echo e($case->slug); ?>"><img src="<?php echo e($case->image); ?>" alt="<?php echo e($case->name); ?>" style="max-height: 38px"></a></td>
                                                            <td><a href="cases/<?php echo e($case->slug); ?>" class="list-title-link"><?php echo e($case->title); ?></a></td>
                                                            <!--td><?php echo e(date('Y-m-d',strtotime($case->created_at))); ?></td>
                                                            <td><?php echo e(date('Y-m-d',strtotime($case->updated_at))); ?></td-->
                                                            <td>
                                                                <?php $__currentLoopData = $case->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if (\Gate::check('Просмотр-пользователей')): ?><a href="/user/<?php echo e($participant->id); ?>"><?php endif; ?><?php echo e($participant->fullname); ?><?php if(\Gate::check('Просмотр-пользователей')): ?></a><?php endif; ?><?php if($loop->remaining > 0): ?>, &#32;<?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="mx-1">
                                                                            <a href="/cases/<?php echo e($case->slug); ?>/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                                                                        </div>
                                                                        <div class="mx-1">
                                                                            <a href="/cases/<?php echo e($case->slug); ?>/delete"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.remove_business_case')); ?>"/><i class="fa fa-remove text-white"></i></button></a>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/business-case/index.blade.php ENDPATH**/ ?>