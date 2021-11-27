

<?php $__env->startSection('title','Edit Role'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(ucfirst($role->name)); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('role.index')); ?>"><?php echo e(__('app.role')); ?></a></li>
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
            <form class="form-horizontal" method="POST" action="<?php echo e(route('role.update',$role->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
              <!-- Role Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      <?php echo e(__('app.edit_role')); ?>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="form-group">
                          <div  class="col-md-12 text-center">
                              <input type="text" value="<?php echo e($role->name); ?>"name="name" class="form-control" id="password" placeholder="<?php echo e(__('app.name_of_role')); ?>">
                              <?php if($errors->has('role')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('role')); ?></strong>
                                </span>
                              <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-sm-8 mx-auto"><button type="submit" class="btn btn-success col-sm-12"><?php echo e(__('app.update_role')); ?></button></div>
                    </div>
                      <!-- /.card-body -->
                  </div>
              <!-- Role Creation -->
            </form>
            <!-- form end -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/roles/edit.blade.php ENDPATH**/ ?>