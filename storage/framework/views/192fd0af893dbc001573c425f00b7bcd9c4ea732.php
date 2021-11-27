

<?php $__env->startSection('title','Edit Permission'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(__('app.permissions')); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('permission.index')); ?>"><?php echo e(__('app.permission')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.edit')); ?></li>
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
            <form class="form-horizontal" method="POST" action="<?php echo e(route('permission.update',$permission->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
              <!-- Permission Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      <?php echo e(__('app.permission')); ?>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group ">
                            <div  class="col-sm-12">
                                <input type="text" value="<?php echo e($permission->name); ?>"name="name" class="form-control" id="password" placeholder="<?php echo e(__('app.name_of_permission')); ?>">
                                <?php if($errors->has('permission')): ?>
                                  <span class="invalid-feedback" role="alert">
                                      <strong><?php echo e($errors->first('permission')); ?></strong>
                                  </span>
                                <?php endif; ?>
                            </div>
                      </div>
                      <div class="col-sm-8 mx-auto"><button type="submit" class="btn btn-success col-sm-12"><?php echo e(__('app.edit_permission')); ?></button></div>
                    </div>
                      <!-- /.card-body -->
              <!-- Permission Edit-->
                </div>
            </form>
            <!-- form end -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/permission/edit.blade.php ENDPATH**/ ?>