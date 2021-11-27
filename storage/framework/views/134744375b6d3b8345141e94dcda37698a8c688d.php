<?php $__env->startSection('title', 'Архив диалогов - ' . $businessCase->title); ?>
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
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases"><?php echo e(__('app.business_cases')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases/archive"><?php echo e(__('app.business_cases_archive')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e($businessCase->title); ?></li>
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
                                <h3 class="card-title"><?php echo e($businessCase->title); ?></h3>
                                <div class="mx-1 pull-right">
                                    <a href="<?php echo e($businessCase->slug); ?>/delete">
                                        <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Архивировать">
                                            <i class="fa fa-remove text-white"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="mx-1 pull-right">
                                    <a href="<?php echo e($businessCase->slug); ?>/edit">
                                        <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Редактировать">
                                            <i class="fa fa-edit text-white"></i>
                                        </button>
                                    </a>
                                </div>
                                <br>
                                <p class="pull-left mt-2 mb-0">Участники:
                                    <?php $__currentLoopData = $businessCaseUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($participant->fullname); ?><?php if($loop->remaining > 0): ?>, &#32;<?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <a href="/cases/<?php echo e($businessCase->slug); ?>"
                                   class="btn btn-primary pull-right"><?php echo e(__('app.back_to_case')); ?></a>
                                <div style="clear:both"></div>

                                <div class="row">
                                    <?php $tablesCount = 0; ?>
                                    <?php if(count($publicDialogs) > 0): ?> <?php $tablesCount++; ?>
                                    <div class="col-md-12">
                                        <h5 class="mb-0 mt-3">Публичные диалоги</h5>
                                        <div class="table-responsive no-padding">
                                            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-hover table-striped table-borderless dataTable no-footer"
                                                               role="grid" aria-describedby="dataTableAlt_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Закреплён"
                                                                    style="width: 80px">
                                                                    Закреплён</th>
                                                                <th tabindex="0" rowspan="1" colspan="1"
                                                                    aria-label="Название">
                                                                    Название
                                                                </th>
                                                                <th aria-label="Удален">
                                                                    Удалён
                                                                </th>
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Действие"
                                                                    style="width: 60px">
                                                                    Действие
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php $__currentLoopData = $publicDialogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dialog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <tr role="row" class="<?php if($loop->count % 2 == 0): ?>odd <?php else: ?> even <?php endif; ?>">
                                                                    <td>
                                                                        <?php if($dialog->pinned): ?>
                                                                            <i class="fa fa-thumb-tack"></i>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="sorting_1">
                                                                        <a href="<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>"
                                                                           class="list-title-link"><?php echo e($dialog->title); ?></a>
                                                                    </td>
                                                                    <td><?php echo e(\Jenssegers\Date\Date::parse($dialog->deleted_at)->format('j F Y в H:i')); ?></td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="mx-1">
                                                                                    <a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.recover')); ?>"/><i class="fa fa-undo text-white"></i></button></a>
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
                                    </div>
                                    <?php endif; ?>

                                    <?php if(count($tetatetDialogs) > 0): ?> <?php $tablesCount++; ?>
                                    <div class="col-md-12">
                                        <h5 class="mb-0 mt-5">Частные диалоги</h5>
                                        <div class="table-responsive no-padding">
                                            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-hover table-striped table-borderless dataTable no-footer"
                                                               role="grid" aria-describedby="dataTableAlt_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Закреплён"
                                                                    style="width: 80px">
                                                                    Закреплён</th>
                                                                <th tabindex="0" rowspan="1" colspan="1"
                                                                    aria-label="Название">
                                                                    Название
                                                                </th>
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Участники">
                                                                    Участники
                                                                </th>
                                                                <th aria-label="Удален">
                                                                    Удалён
                                                                </th>
                                                                <th rowspan="1" colspan="1"
                                                                    aria-label="Действие"
                                                                    style="width: 60px">
                                                                    Действие
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php $__currentLoopData = $tetatetDialogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dialog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <tr role="row" class="<?php if($loop->count % 2 == 0): ?>odd <?php else: ?> even <?php endif; ?>">
                                                                    <td>
                                                                        <?php if($dialog->pinned): ?>
                                                                            <i class="fa fa-thumb-tack"></i>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="sorting_1">
                                                                        <a href="<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>"
                                                                           class="list-title-link"><?php echo e($dialog->title); ?></a>
                                                                    </td>
                                                                    <td>
                                                                        <?php $__currentLoopData = $dialog->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php echo e($participant->fullname); ?><?php if($loop->remaining > 0): ?>, &#32;<?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </td>
                                                                    <td><?php echo e(\Jenssegers\Date\Date::parse($dialog->deleted_at)->format('j F Y в H:i')); ?></td>
                                                                    <td style="min-width: 100px">
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="mx-1">
                                                                                    <a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/restore"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.recover')); ?>"/><i class="fa fa-undo text-white"></i></button></a>
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
                                    </div>
                                    <?php endif; ?>

                                    <?php if($tablesCount == 0): ?>
                                        <div class="col-md-12 mt-1">
                                            <h5><i>Архивированные диалоги для этого дела пока что отсутствуют.</i></h5>
                                        </div>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/dialog/archive.blade.php ENDPATH**/ ?>