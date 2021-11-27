<?php $__env->startSection('title','Создание роль'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(__('app.roles')); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('role.index')); ?>"><?php echo e(__('app.roles')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.create')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <!-- right column -->
        <div class="col-md-7 mx-auto">
            <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <form class="form-horizontal" method="POST" action="<?php echo e(route('role.store')); ?>">
                    <?php echo csrf_field(); ?>
                  <!-- Role Creation -->
                      <div class="card">
                        <div class="card-header with-border">
                          <?php echo e(__('app.create_role')); ?>

                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="form-group ">
                                <div  class="col-sm-12 mx-auto">
                                    <input type="text" name="name" class="form-control" id="password" placeholder="<?php echo e(__('app.name_of_role')); ?>">
                                    <?php if($errors->has('role')): ?>
                                      <span class="invalid-feedback" role="alert">
                                          <strong><?php echo e($errors->first('role')); ?></strong>
                                      </span>
                                    <?php endif; ?>
                                </div>
                          </div>
                          <div class="col-sm-8 mx-auto"><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12"><?php echo e(__('app.create_role')); ?></button></div>
                          <!-- /.card-body -->
                      </div>
                  <!-- Role Creation -->
                </div>
                <!-- /.card-body -->
              </form>
              <!-- form end -->
          </div>
          <!-- /.card -->
        </div>
      <!-- /.row -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/roles/create.blade.php ENDPATH**/ ?>