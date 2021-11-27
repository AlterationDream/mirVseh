<?php $__env->startSection('title','Пользователь ' . $user->fullname); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?php echo e($user->fullname); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('user.index')); ?>"><?php echo e(__('app.users')); ?></a>
                            </li>
                            <li class="breadcrumb-item active"><?php echo e(__('app.profile')); ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- Profile Image -->
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="img profile-user-img img-responsive img-circle" src="<?php echo e($user->avatar); ?>"
                                     alt="User profile picture">
                                <h5 class="mt-3 mb-0"><b><?php echo e($user->fullname); ?></b></h5>
                                <p><?php echo e($user->email); ?></p>
                                <div class="col-md-12">
                                    <span class="mt-0 d-block">
                                        <p><b>Дата последнего входа:</b>
                                            <?php echo e(empty($user->last_login_at)? 'Не входил': ($user->last_login_at)->diffForHumans()); ?>

                                        </p>
                                    </span>
                                    <span class="mt-0 d-block"><p><b><?php echo e(__('app.joined')); ?>:</b>
                                          <?php echo e($user->created_at); ?>

                                        </p>
                                    </span>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-пользователями')): ?>
                                <div class="card-header">
                                    <div class="mx-1 pull-right">
                                        <a href="/edit">
                                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Редактировать" data-target="#deleteUser3">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mx-1 pull-right">
                                        <a href="/user/<?php echo e($user->id); ?>/edit">
                                            <button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mx-1 pull-right">
                                        <a href="/impersonate/take/<?php echo e($user->id); ?>">
                                            <button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom"
                                                    title="" data-original-title="Зайти от лица пользователя">
                                                <i class="fa text-white fa-user-secret"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label><?php echo e(__('app.role')); ?></label>
                                        <p><?php echo e($user_role->name); ?></p>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label><?php echo e(__('app.status')); ?></label>
                                        <p><?php if($user->status == 'active'): ?>
                                                Активный
                                            <?php elseif($user->status == 'banned'): ?>
                                                Заблокирован
                                            <?php endif; ?></p>
                                    </div>
                                    <div id="birthday" class="col-sm-6 mb-1 mt-1">
                                        <label for="name"><?php echo e(__('app.birthday')); ?></label>
                                        <p><?php if($user->birthday): ?>
                                            <?php echo e(\Jenssegers\Date\Date::parse($user->birthday)->format("j F Y")); ?>

                                            <?php else: ?> Не указан <?php endif; ?></p>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div><label class="label-block"><?php echo e(__('app.phone')); ?></label></div>
                                        <p><?php if($user->phone != ''): ?> <?php echo e($user->phone); ?> <?php else: ?> Не указан <?php endif; ?></p>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="mobile"><?php echo e(__('app.country')); ?></label>
                                        <p><?php if($user->country != ''): ?> <?php echo e($user->country); ?> <?php else: ?> Не указана <?php endif; ?></p>
                                    </div>
                                    <div class="col-sm-6 mt-1">
                                        <label for="address"
                                               class="control-label"><?php echo e(__('app.address')); ?></label>
                                        <p><?php if($user->address != ''): ?> <?php echo e($user->address); ?> <?php else: ?> Не указан <?php endif; ?></p>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card -->
                        </div>
                    </div>
                <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/users/admin/show.blade.php ENDPATH**/ ?>