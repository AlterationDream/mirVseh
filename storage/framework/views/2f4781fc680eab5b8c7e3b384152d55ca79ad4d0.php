

<?php $__env->startSection('title','Activity Logs'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.activity_log')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                 <div class="card-body">
                   <div class="row">
                     <div class="col-md-12 mb-3">
                       <h3 class="pull-right"><?php echo e(__('app.activity_log')); ?></h3>
                     </div>
                     <div class="col-md-12">
                       <div class="table-responsive no-padding">
                         <table id="dataTable" class="table table-hover table-striped table-borderless">
                           <thead>
                             <tr>
                               <th class=""><?php echo e(__('app.activity_log_name')); ?></th>
                               <th class=""><?php echo e(__('app.activity_log_description')); ?></th>
                               <th class=""><?php echo e(__('app.activity_log_actionby')); ?></th>
                               <th class=""><?php echo e(__('app.created_at')); ?></th>
                             </tr>
                             </thead>
                             <tbody>
                             <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr>
                               <td><?php echo e(($activity->properties['name'])?$activity->properties['name']:'N/A'); ?></td>
                               <td><?php echo e($activity->description); ?></td>
                               <td><?php echo e($activity->properties['by']); ?></td>
                               <td><?php echo e(date('Y-m-d h:i',strtotime($activity->created_at))); ?></td>
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
              </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/activitylog/adminLog.blade.php ENDPATH**/ ?>