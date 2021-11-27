<?php
$name = '';
if ($type == 'prospector') $name = 'изыскателя';
elseif ($type == 'customer') $name = 'клиента';
else $name = 'программиста';
?>

<?php $__env->startSection('title','Редактирование ' . $name); ?>
<?php $__env->startSection('style'); ?>
    <style>#change-doc-span {display: none;}</style>
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
                            <li class="breadcrumb-item active">Редактирование <?php echo e($name); ?></li>
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
                                <h3 class="card-title">Редактирование <?php echo e($name); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/connections/<?php echo e($type); ?>/<?php echo e($connection->id); ?>/edit" method="POST" class="form-horizontal" id="connection-create" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <input type="text" name="fullname" class="form-control mb-2" id="fullname" placeholder="<?php echo e(__('app.fullname')); ?>*" value="<?php if ( !old('fullname') ) echo $connection->fullname; else echo old('fullname'); ?>">
                                                <input type="email" name="email" class="form-control mb-2" id="email" placeholder="<?php echo e(__('app.email')); ?>" value="<?php if ( !old('email') ) echo $connection->email; else echo old('email'); ?>">
                                                <input type="tel" name="phone" class="form-control mb-2" id="phone" placeholder="<?php echo e(__('app.phone')); ?>" value="<?php if ( !old('phone') ) echo $connection->phone; else echo old('phone'); ?>">
                                                <?php if($type == 'customer'): ?> <input type="text" name="position" class="form-control mb-2" id="position" placeholder="<?php echo e(__('app.workplace')); ?>" value="<?php if ( !old('position') ) echo $connection->position; else echo old('position'); ?>"> <?php endif; ?>
                                                <input type="text" name="experience" class="form-control mb-2" id="experience" placeholder="<?php echo e(__('app.experience')); ?>" value="<?php if ( !old('experience') ) echo $connection->experience; else echo old('experience'); ?>">
                                                <input type="text" name="age" class="form-control mb-2" id="age" placeholder="<?php echo e(__('app.age')); ?>" value="<?php if ( !old('age') ) echo $connection->age; else echo old('age'); ?>">
                                                <?php if($type == 'prospector' || $type == 'programmer'): ?> <input type="text" name="price" class="form-control mb-2" id="price" <?php if($type == 'prospector'): ?> placeholder="<?php echo e(__('app.income')); ?>" <?php else: ?> placeholder="<?php echo e(__('app.price')); ?>" <?php endif; ?> value="<?php if ( !old('price') ) echo $connection->price; else echo old('price'); ?>"> <?php endif; ?>
                                                <?php if($type == 'customer'): ?> <input type="text" name="contract_date" class="form-control mb-2" id="contract_date" placeholder="<?php echo e(__('app.contract_date')); ?>" value="<?php if ( !old('contract_date') ) echo $connection->contract_date; else echo old('contract_date'); ?>"> <?php endif; ?>
                                                <input type="text" name="region" class="form-control mb-2" id="region" placeholder="<?php echo e(__('app.region')); ?>" value="<?php if ( !old('region') ) echo $connection->region; else echo old('region'); ?>">
                                                <?php if($type == 'customer'): ?> <input type="text" name="address" class="form-control mb-2" id="address" placeholder="<?php echo e(__('app.address')); ?>" value="<?php if ( !old('address') ) echo $connection->address; else echo old('address'); ?>"> <?php endif; ?>
                                                <?php if($type == 'prospector' || $type == 'programmer'): ?> <input type="text" name="position" class="form-control mb-2" id="position" <?php if($type == 'prospector'): ?> placeholder="<?php echo e(__('app.position')); ?>" <?php else: ?> placeholder="<?php echo e(__('app.area')); ?>" <?php endif; ?> value="<?php if ( !old('position') ) echo $connection->position; else echo old('position'); ?>"> <?php endif; ?>
                                                <textarea name="description" class="form-control mb-2" id="description" cols="30" rows="10" <?php if($type == 'customer'): ?> placeholder="<?php echo e(__('app.case_description')); ?>" <?php else: ?> placeholder="<?php echo e(__('app.short_description')); ?>" <?php endif; ?> ><?php if ( !old('description') ) echo $connection->description; else echo old('description'); ?></textarea>
                                                <div class="btn btn-info" id="change-doc">Изменить <?php if ($type == 'customer'): ?><?php echo e(__('app.passport')); ?><?php else: ?><?php echo e(__('app.cv')); ?><?php endif; ?></div>
                                                <span id="change-doc-span">
                                                    <input type="hidden" name='changedoc' value="0" id="change-doc-val">
                                                    <label id="doc-label" for="doc" class="mt-2 ml-1"> <?php if($type == 'customer'): ?> <?php echo e(__('app.passport')); ?>: <?php else: ?> <?php echo e(__('app.cv')); ?>: <?php endif; ?> </label>
                                                    <input type="file" name="doc" id="doc" value="<?php if ( !old('doc') ) echo $connection->doc; else echo old('doc'); ?>">
                                                </span>
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

    <script>$('#change-doc').on('click', function () {
            $('#change-doc-span').show();
            $('#change-doc').hide();
            $('#change-doc-val').val('1');
        });
    </script>

    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/connection/edit.blade.php ENDPATH**/ ?>