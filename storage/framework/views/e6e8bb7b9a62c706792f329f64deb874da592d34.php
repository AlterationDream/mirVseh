

<?php $__env->startSection('title','Permission'); ?>
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
                <a href="<?php echo e(route('permission.create')); ?>" class="pull-right btn btn-primary">Create Permission</a>
              </div>

              <div class="col-md-12">
              <table id="dataTable" class="table table-hover table-borderless table-striped">
                <thead>
                <tr>
                  <th class=""><?php echo e(__('app.id')); ?></th>
                  <th class=""><?php echo e(__('app.name')); ?></th>
                  <th class=""><?php echo e(__('app.action')); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($permission->id); ?></td>
                    <td><?php echo e($permission->name); ?></td>
                    <td>
                      <div class="col-md-12">
                          <div class="row">
                            <div class="mx-1">
                                <a href="<?php echo e(route('permission.edit',$permission->id)); ?>"><button class="btn btn-sm btn-info" data-toggle="tooltip"  data-placement="bottom" title="Edit <?php echo e(__('app.permission')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                            </div>
                            <?php if($permission->removable): ?>
                            <div class="mx-1">
                              <form action="<?php echo e(route('permission.destroy',$permission->id)); ?>" method="POST">
                                <?php echo method_field('DELETE'); ?>
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-xs btn-danger btn-sm" data-toggle="tooltip"  data-placement="bottom" title="Delete <?php echo e(__('app.permission')); ?>"/><i class='fa fa-trash text-white'></i></button>
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
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('js/datatable.js')); ?>" charset="utf-8"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/permission/index.blade.php ENDPATH**/ ?>