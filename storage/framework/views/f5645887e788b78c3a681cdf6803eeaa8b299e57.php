

<?php $__env->startSection('title','Role'); ?>
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
              <li class="breadcrumb-item"><a href="<?php echo e(route('role.index')); ?>"><?php echo e(__('app.role')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.view')); ?></li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <a href="<?php echo e(route('role.create')); ?>" class="pull-right btn btn-primary"><?php echo e(__('app.create_role')); ?></a>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive no-padding">
                <table id="dataTable" class="table table-hover table-borderless table-striped">
                  <thead>
                  <tr>
                    <th class=""><?php echo e(__('app.id')); ?></th>
                    <th class=""><?php echo e(__('app.name')); ?></th>
                    <th class=""><?php echo e(__('app.created_at')); ?></th>
                    <th class=""><?php echo e(__('app.updated_at')); ?></th>
                    <th class=""><?php echo e(__('app.action')); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($role->id); ?></td>
                    <td><?php echo e($role->name); ?></td>
                    <td><?php echo e($role->created_at); ?></td>
                    <td><?php echo e($role->updated_at); ?></td>
                    <td>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="mx-1">
                            <a href="<?php echo e(route('role.show',$role->id)); ?>"><button class="btn btn-success btn-sm" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.add_permission')); ?>"/><i class="fa fa-shield"></i></button></a>
                          </div>
                          <div class="mx-1">
                            <a href="<?php echo e(route('role.edit',$role->id)); ?>"><button class="btn btn-info btn-sm" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit_role')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                          </div>
                          <?php if($role->removable): ?>
                          <div class="mx-1">
                            <form action="<?php echo e(route('role.destroy',$role->id)); ?>" method="POST">
                              <?php echo method_field('DELETE'); ?>
                              <?php echo csrf_field(); ?>
                              <button class="btn btn-danger btn-sm" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.delete_role')); ?>"/><i class='fa fa-trash text-white'></i></button>
                            </form>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                </table>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/roles/index.blade.php ENDPATH**/ ?>