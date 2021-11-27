<?php $__env->startSection('title',$businessCase->title); ?>
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
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-делами')): ?>
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
                                <?php endif; ?>
                                <?php $canViewFolder = false;
                                    foreach($businessCaseUsers as $participant) {
                                        if (\Auth::user()->id == $participant->id) $canViewFolder = true;
                                    }
                                ?>
                                <?php if($businessCase->folder && $canViewFolder): ?>
                                    <div class="mx-1 pull-right">
                                        <a href="<?php echo e($businessCase->slug); ?>/folder">
                                            <button class="btn btn-info">
                                                <i class="fa fa-folder text-white"></i>&nbsp;Папка дела
                                            </button>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <br>
                                <p class="pull-left mt-2 mb-0">Участники:
                                    <?php $__currentLoopData = $businessCaseUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if (\Gate::check('Просмотр-пользователей')): ?><a href="/user/<?php echo e($participant->id); ?>"><?php endif; ?><?php echo e($participant->fullname); ?><?php if(\Auth::user()->can('Просмотр-пользователей')): ?></a><?php endif; ?><?php if($loop->remaining > 0): ?>, &#32;<?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <a href="/cases/<?php echo e($businessCase->slug); ?>/new-dialog"
                                   class="btn btn-primary"><?php echo e(__('app.new_dialog')); ?></a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-архивом')): ?>
                                <a href="/cases/<?php echo e($businessCase->slug); ?>/archive"
                                   class="btn btn-primary pull-right"><?php echo e(__('app.dialog_archive')); ?></a>
                                <?php endif; ?>
                                <div class="row">
                                    <?php $tablesCount = 0; ?>
                                    <?php if (!$businessCase->guests()->find(\Auth::user()->id)): ?>
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
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-диалогами')): ?>
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Действие"
                                                                        style="width: 100px">
                                                                        Действие
                                                                    </th>
                                                                    <?php endif; ?>
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
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-диалогами')): ?>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/edit">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Редактировать">
                                                                                                <i class="fa fa-edit text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/delete">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Архивировать">
                                                                                                <i class="fa fa-remove text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <?php endif; ?>
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
                                    <?php endif; ?>
                                    <?php $tetatetShown = 0;
                                    foreach($tetatetDialogs as $dialog)
                                        if ($dialog->users->where('id', \Auth::user()->id)->first()) $tetatetShown++; ?>

                                    <?php if(count($tetatetDialogs) > 0 & $tetatetShown > 0): ?> <?php $tablesCount++; ?>
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
                                                                    <th rowspan="1" colspan="1"
                                                                        aria-label="Действие"
                                                                        style="width: 100px">
                                                                        Действие
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <?php $__currentLoopData = $tetatetDialogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dialog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($dialog->users()->find(\Auth::user()->id) || \Gate::check('Операции-с-диалогами')): ?>
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
                                                                                <?php if (\Gate::check('Просмотр-пользователей')): ?><a href="/user/<?php echo e($participant->id); ?>"><?php endif; ?><?php echo e($participant->fullname); ?><?php if(\Gate::check('Просмотр-пользователей')): ?></a><?php endif; ?><?php if($loop->remaining > 0): ?>, &#32;<?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </td>
                                                                        <td style="min-width: 100px">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/edit">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Редактировать">
                                                                                                <i class="fa fa-edit text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-диалогами')): ?>
                                                                                    <div class="mx-1">
                                                                                        <a href="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/delete">
                                                                                            <button class="btn btn-info"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="bottom"
                                                                                                    title=""
                                                                                                    data-original-title="Архивировать">
                                                                                                <i class="fa fa-remove text-white"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php endif; ?>
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
                                        <div class="col-md-12 mt-4">
                                            <h5><i>Диалоги пока что отсутствуют.</i></h5>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/business-case/show.blade.php ENDPATH**/ ?>