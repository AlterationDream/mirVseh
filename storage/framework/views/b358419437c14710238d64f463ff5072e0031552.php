

<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(__('app.dashboard')); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.dashboard')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="row">
		<!--============================ View for Non-Admin ============================-->
		<?php if(!auth()->check() || ! auth()->user()->hasRole('admin')): ?>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3">
              <a href="/profile"  Class="info-box-icon bg-dark elevation-1" data-toggle="tooltip" data-placement="bottom" title="See <?php echo e(__('app.profile')); ?>"><i class="fa fa-user-circle-o"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.profile')); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3">
              <a href="<?php echo e(route('activity-log.index')); ?>"  Class="info-box-icon bg-navy elevation-1" data-toggle="tooltip" data-placement="bottom" title="See <?php echo e(__('app.activity_log')); ?>"><i class="fa fa-list"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.activity_log')); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3">
              <a href="/premium-content"  Class="info-box-icon bg-info elevation-1" data-toggle="tooltip" data-placement="bottom" title="See <?php echo e(__('app.premium_content')); ?>"><i class="fa fa-user-circle-o"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.premium_content')); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3">
              <a href="/subscription"  Class="info-box-icon bg-danger elevation-1" data-toggle="tooltip" data-placement="bottom" title="See <?php echo e(__('app.subscription')); ?>"><i class="fa fa-money"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.subscription')); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

    <?php endif; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/dashboard/default.blade.php ENDPATH**/ ?>