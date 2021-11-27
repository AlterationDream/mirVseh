<?php $__env->startSection('title',__('app.connections_database')); ?>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.connections_database')); ?></li>
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
                                    <div class="col-md-12 row">
                                        <div class="col-md-4">
                                            <div class="info-box shadow p-3 hover-box" onclick="window.open('/connections/prospector','_self');">
                                                <a href="/connections/prospector"
                                                   class="info-box-icon bg-navy elevation-1"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title=""
                                                   data-original-title="База изыскателей">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <div class="info-box-content">
                                                    <a class="info-box-text list-title-link" href="/connections/prospector">Изыскатели</a>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box shadow p-3 hover-box" onclick="window.open('/connections/customer','_self');">
                                                <a href="/connections/customer"
                                                   class="info-box-icon bg-olive elevation-1"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title=""
                                                   data-original-title="База клиентов">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <div class="info-box-content">
                                                    <a class="info-box-text list-title-link" href="/connections/customer">Клиенты</a>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box shadow p-3 hover-box" onclick="window.open('/connections/programmer','_self');">
                                                <a href="/connections/programmer"
                                                   class="info-box-icon bg-blue elevation-1"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title=""
                                                   data-original-title="База программистов">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <div class="info-box-content">
                                                    <a class="info-box-text list-title-link" href="/connections/programmer">Программисты</a>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </div>
                                    </div>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/connection/index.blade.php ENDPATH**/ ?>