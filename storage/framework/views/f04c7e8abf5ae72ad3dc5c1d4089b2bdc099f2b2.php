<?php $__env->startSection('title', __("app.programmers_database") ); ?>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.programmers_database')); ?></li>
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
                                        <h4><?php echo e(__('app.programmers_database')); ?></h4>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="/connections/programmer/create" class="btn btn-primary mb-2"><?php echo e(__('app.new_programmer')); ?></a>
                                    </div>
                                    <div class="table_show mb-3">
                                        <input type="checkbox" id="fullname" checked>
                                        <label for="fullname">Имя</label>
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
                                        <input type="checkbox" id="position" checked>
                                        <label for="position">Деятельность</label>
                                        <input type="checkbox" id="description" checked>
                                        <label for="description">Опыт</label>
                                        <input type="checkbox" id="doc" checked>
                                        <label for="doc">Резюме</label>
                                        <input type="checkbox" id="action" checked>
                                        <label for="action">Действие</label>
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
                                                    <th class="fullname_col">Имя</th>
                                                    <th class="email_col"><?php echo e(__('app.email')); ?></th>
                                                    <th class="phone_col"><?php echo e(__('app.phone')); ?></th>
                                                    <th class="experience_col"><?php echo e(__('app.experience')); ?></th>
                                                    <th class="age_col"><?php echo e(__('app.age')); ?></th>
                                                    <th class="price_col"><?php echo e(__('app.price')); ?></th>
                                                    <th class="region_col">Регион</th>
                                                    <th class="position_col">Деятельность</th>
                                                    <th class="description_col">Опыт</th>
                                                    <th class="doc_col">Резюме</th>
                                                    <th class="action_col" style="min-width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $__currentLoopData = $connections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="fullname_col"><?php echo e($programmer->fullname); ?></td>
                                                        <td class="email_col"><?php echo e($programmer->email); ?></td>
                                                        <td class="phone_col"><?php echo e($programmer->phone); ?></td>
                                                        <td class="experience_col"><?php echo e($programmer->experience); ?></td>
                                                        <td class="age_col"><?php echo e($programmer->age); ?></td>
                                                        <td class="price_col"><?php echo e($programmer->price); ?></td>
                                                        <td class="region_col"><?php echo e($programmer->region); ?></td>
                                                        <td class="position_col"><?php echo e($programmer->position); ?></td>
                                                        <td class="description_col"><?php echo e($programmer->description); ?></td>
                                                        <td class="doc_col"> <?php if($programmer->doc != ''): ?> <a href="<?php echo e($programmer->doc); ?>" target="_blank">Открыть</a> <?php else: ?> Нет резюме <?php endif; ?> </td>
                                                        <td class="action_col">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/connections/programmer/<?php echo e($programmer->id); ?>/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/connections/programmer/<?php echo e($programmer->id); ?>/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.remove_programmer')); ?>"/><i class="fa fa-remove text-white"></i></button></a>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/connection/index-programmer.blade.php ENDPATH**/ ?>