<?php
$name = '';
if ($type == 'prospector') $name = 'изыскатель';
elseif ($type == 'customer') $name = 'клиент';
else $name = 'программист';
?>

<?php $__env->startSection('title','Новый ' . $name); ?>
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
                            <li class="breadcrumb-item"><a href="/connections"><?php echo e(__('app.connections_database')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/connections/<?php echo e($type); ?>"><?php echo e(__('app.' . $type . 's_database')); ?></a></li>
                            <li class="breadcrumb-item active">Новый <?php echo e($name); ?></li>
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
                                <h3 class="card-title">Новый <?php echo e($name); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/connections/<?php echo e($type); ?>/create" method="POST" class="form-horizontal" id="connection-create" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="fullname" class="form-control mb-2" id="fullname" placeholder="<?php echo e(__('app.fullname')); ?>*" value="<?php echo e(old('fullname')); ?>">
                                                <input type="email" name="email" class="form-control mb-2" id="email" placeholder="<?php echo e(__('app.email')); ?>" value="<?php echo e(old('email')); ?>">
                                                <input type="tel" name="phone" class="form-control mb-2" id="phone" placeholder="<?php echo e(__('app.phone')); ?>" value="<?php echo e(old('phone')); ?>">
                                                <?php if($type == 'customer'): ?> <input type="text" name="position" class="form-control mb-2" id="position" placeholder="<?php echo e(__('app.workplace')); ?>" value="<?php echo e(old('position')); ?>"> <?php endif; ?>
                                                <input type="text" name="experience" class="form-control mb-2" id="experience" placeholder="<?php echo e(__('app.experience')); ?>" value="<?php echo e(old('experience')); ?>">
                                                <input type="text" name="age" class="form-control mb-2" id="age" placeholder="<?php echo e(__('app.age')); ?>" value="<?php echo e(old('age')); ?>">
                                                <?php if($type == 'prospector' || $type == 'programmer'): ?> <input type="text" name="price" class="form-control mb-2" id="price" <?php if($type == 'prospector'): ?> placeholder="<?php echo e(__('app.income')); ?>" <?php else: ?> placeholder="<?php echo e(__('app.price')); ?>" <?php endif; ?> value="<?php echo e(old('price')); ?>"> <?php endif; ?>
                                                <?php if($type == 'customer'): ?> <input type="text" name="contract_date" class="form-control mb-2" id="contract_date" placeholder="<?php echo e(__('app.contract_date')); ?>" value="<?php echo e(old('contract_date')); ?>"> <?php endif; ?>
                                                <input type="text" name="region" class="form-control mb-2" id="region" placeholder="<?php echo e(__('app.region')); ?>" value="<?php echo e(old('region')); ?>">
                                                <?php if($type == 'customer'): ?> <input type="text" name="address" class="form-control mb-2" id="address" placeholder="<?php echo e(__('app.address')); ?>" value="<?php echo e(old('address')); ?>"> <?php endif; ?>
                                                <?php if($type == 'prospector' || $type == 'programmer'): ?> <input type="text" name="position" class="form-control mb-2" id="position" <?php if($type == 'prospector'): ?> placeholder="<?php echo e(__('app.position')); ?>" <?php else: ?> placeholder="<?php echo e(__('app.area')); ?>" <?php endif; ?> value="<?php echo e(old('position')); ?>"> <?php endif; ?>
                                                <textarea name="description" class="form-control mb-2" id="description" cols="30" rows="10" <?php if($type == 'customer'): ?> placeholder="<?php echo e(__('app.case_description')); ?>" <?php else: ?> placeholder="<?php echo e(__('app.short_description')); ?>" <?php endif; ?> ></textarea>
                                                <label id="doc-label" for="doc" class="mt-2 ml-1"> <?php if($type == 'customer'): ?> <?php echo e(__('app.passport')); ?>: <?php else: ?> <?php echo e(__('app.cv')); ?>: <?php endif; ?> </label>
                                                <input type="file" name="doc" id="doc" value="<?php echo e(old('doc')); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.save')); ?>">
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/connection/create.blade.php ENDPATH**/ ?>