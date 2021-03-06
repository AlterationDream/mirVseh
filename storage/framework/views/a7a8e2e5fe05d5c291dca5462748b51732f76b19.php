<?php $__env->startSection('title', __("app.prospectors_database") ); ?>
<?php $__env->startSection('style'); ?>
    <!--link rel="stylesheet" type="text/css"  href="<?php echo e(asset('assets/css/articleStyle.css')); ?>"></link-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/connections"><?php echo e(__('app.connections_database')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('app.prospectors_database')); ?></li>
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
                                        <h4><?php echo e(__('app.connections_database')); ?></h4>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="/connections/prospector/create" class="btn btn-primary mb-2"><?php echo e(__('app.new_prospector')); ?></a>
                                    </div>
                                    <div class="table_show mb-3">
                                        <input type="checkbox" id="fullname" checked>
                                        <label for="fullname">??????</label>
                                        <input type="checkbox" id="email" checked>
                                        <label for="email"><?php echo e(__('app.email')); ?></label>
                                        <input type="checkbox" id="phone" checked>
                                        <label for="phone"><?php echo e(__('app.phone')); ?></label>
                                        <input type="checkbox" id="experience" checked>
                                        <label for="experience"><?php echo e(__('app.experience')); ?></label>
                                        <input type="checkbox" id="age" checked>
                                        <label for="age"><?php echo e(__('app.age')); ?></label>
                                        <input type="checkbox" id="price" checked>
                                        <label for="price"><?php echo e(__('app.price')); ?></label>
                                        <input type="checkbox" id="region" checked>
                                        <label for="region"><?php echo e(__('app.region')); ?></label>
                                        <input type="checkbox" id="position" checked>
                                        <label for="position">??????????????????</label>
                                        <input type="checkbox" id="description" checked>
                                        <label for="description">????????</label>
                                        <input type="checkbox" id="doc" checked>
                                        <label for="doc">????????????</label>
                                        <input type="checkbox" id="action" checked>
                                        <label for="action">????????????????</label>
                                    </div>
                                    <style>
                                        .table_show {
                                            margin-left: 8px;
                                        }
                                        .table_show input {
                                            cursor: pointer;
                                        }
                                        .table_show label {
                                            margin-right: 12px;
                                            cursor: pointer;
                                            -webkit-user-select: none; /* Safari */
                                            -moz-user-select: none; /* Firefox */
                                            -ms-user-select: none; /* IE10+/Edge */
                                            user-select: none; /* Standard */
                                        }
                                    </style>
                                    <div class="col-md-12">
                                        <div class="table-responsive no-padding">
                                            <table id="dataTable" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th class="fullname_col">??????</th>
                                                    <th class="email_col"><?php echo e(__('app.email')); ?></th>
                                                    <th class="phone_col"><?php echo e(__('app.phone')); ?></th>
                                                    <th class="experience_col"><?php echo e(__('app.experience')); ?></th>
                                                    <th class="age_col"><?php echo e(__('app.age')); ?></th>
                                                    <th class="price_col"><?php echo e(__('app.price')); ?></th>
                                                    <th class="region_col"><?php echo e(__('app.region')); ?></th>
                                                    <th class="position_col">??????????????????</th>
                                                    <th class="description_col">????????</th>
                                                    <th class="doc_col">????????????</th>
                                                    <th class="action_col" style="min-width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $__currentLoopData = $connections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prospector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="fullname_col"><?php echo e($prospector->fullname); ?></td>
                                                        <td class="email_col"><?php echo e($prospector->email); ?></td>
                                                        <td class="phone_col"><?php echo e($prospector->phone); ?></td>
                                                        <td class="experience_col"><?php echo e($prospector->experience); ?></td>
                                                        <td class="age_col"><?php echo e($prospector->age); ?></td>
                                                        <td class="price_col"><?php echo e($prospector->price); ?></td>
                                                        <td class="region_col"><?php echo e($prospector->region); ?></td>
                                                        <td class="position_col"><?php echo e($prospector->position); ?></td>
                                                        <td class="description_col"><?php echo e($prospector->description); ?></td>
                                                        <td class="doc_col"> <?php if($prospector->doc != ''): ?> <a href="<?php echo e($prospector->doc); ?>" target="_blank">??????????????</a> <?php else: ?> ?????? ???????????? <?php endif; ?> </td>
                                                        <td class="action_col">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/connections/prospector/<?php echo e($prospector->id); ?>/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/connections/prospector/<?php echo e($prospector->id); ?>/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.remove_prospector')); ?>"/><i class="fa fa-remove text-white"></i></button></a>
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
                                    <script>
                                        $('.table_show input').change(function(){
                                            console.log($($(this).attr('id') + "_col"));
                                            if ($(this).prop('checked')) {
                                                $('.' + $(this).attr('id') + "_col").show();
                                            } else {
                                                $('.' + $(this).attr('id') + "_col").hide();
                                            }
                                        });
                                    </script>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/connection/index-prospector.blade.php ENDPATH**/ ?>