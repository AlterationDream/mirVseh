

<?php $__env->startSection('title','Show Role'); ?>
<?php $__env->startSection('content'); ?>
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
              <li class="breadcrumb-item active"><?php echo e(__('app.show')); ?></li>
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
              <form class="form-horizontal" method="POST" action="<?php echo e(route('roles_permit',$role->id)); ?>">
                  <?php echo csrf_field(); ?>
                <!-- Role Creation -->
                    <div class="card">
                          <div class="card-header">
                            <?php echo e(__('app.all_permissions')); ?>

                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                          <div class="form-group ">
                  						<?php $__currentLoopData = $allpermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allpermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              	<div class="icheck-primary">
                  							  <input  type="checkbox" name="permissions[]" value="<?php echo e($allpermission->name); ?>"  id="role<?php echo e($allpermission->id); ?>"
                                   <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e(($permission->name ==$allpermission->name) ? 'checked' : ''); ?>

                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   >
                  							  <label for="role<?php echo e($allpermission->id); ?>">
                  								          <?php echo e(ucfirst($allpermission->name)); ?>

                  							  </label>
                  							</div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                          <div class="col-sm-8 mx-auto"><button type="submit" class="btn btn-primary col-sm-12"><?php echo e(__('app.update_permission')); ?></button></div>
                      </div>
                        <!-- /.card-body -->
                    </div>
                <!-- Role Creation -->
              </form>
              <!-- form end -->
          </div>
        </div>
        <!--/.col (right) -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/roles/show.blade.php ENDPATH**/ ?>