

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
      <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
      <!-- Info boxes -->
        <div class="row mb-2">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3">
              <a href="<?php echo e(route('user.index')); ?>"  Class="info-box-icon bg-dark elevation-1" data-toggle="tooltip" data-placement="bottom" title="See All Users"><i class="fa fa-users"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.total_users')); ?></span>
                <span class="info-box-number lead">
                  <?php echo e($users); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3">
              <a href="<?php echo e(route('user.index')); ?>"  Class="info-box-icon bg-navy elevation-1" data-toggle="tooltip" data-placement="bottom" title="See Users"><i class="fa fa-user-plus"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.new_users')); ?></span>
                <span class="info-box-number lead">
                  <?php echo e($latest_users); ?>

                </span>
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
              <a href="<?php echo e(route('role.index')); ?>"  Class="info-box-icon bg-primary elevation-1" data-toggle="tooltip" data-placement="bottom" title="See Roles"><i class="fa fa-tag"></i></a>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('app.roles')); ?></span>
                <span class="info-box-number lead">
                  <?php echo e($roles); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


       <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box shadow p-3">
            <a href="/subscription-income"  Class="info-box-icon bg-success elevation-1" data-toggle="tooltip" data-placement="bottom" title="See Total Income"><i class="fa fa-money"></i></a>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo e(__('app.total_income')); ?></span>
              <span class="info-box-number lead">
                <?php echo money($total_income); ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        </div>
        <!-- /.row -->



      <div class="row">

        <div class="col-lg-7 col-xs-11 h-100 mb-3">
          <!-- small box -->
          <div class="card bg-white shadow">
            <div class="card-header bg-primary">
              <?php echo e(__('app.reg_history')); ?>

            </div>
            <div class="card-body">
              <?php echo $latestUser->container(); ?>

              <?php if($latestUser): ?>
                <?php echo $latestUser->script(); ?>

              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-5 col-xs-11 h-100 mb-3">
          <!-- small box -->
          <div class="card bg-white shadow">
            <div class="card-header bg-primary">
              <?php echo e(__('app.recent_subscription')); ?>

              <span class="pull-right"><a href="/subscribed-users" class=" text-white hover-danger">View all</a></span>
            </div>
            <div class="card-body p-0">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                  <table class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th><?php echo e(__('app.users')); ?></th>
                          <th><?php echo e(__('app.plan')); ?></th>
                          <th><?php echo e(__('app.amount')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(setting('stripe_status')): ?>
                        <?php if(count($latestSubscription) > 0): ?>
                            <?php $__currentLoopData = $latestSubscription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($latest['fullname']); ?></td>
                              <td><?php echo e($latest['plan_name']); ?></td>
                              <td><?php echo money($latest['amount']); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                          <tr>
                            <td colspan="3" class="text-center text-muted"><h5><i><?php echo e(__('app.no_record')); ?></i></h5></td>
                          </tr>
                        <?php endif; ?>
                      <?php else: ?>
                      <tr>
                        <td colspan="3" class="text-center text-muted">
                          <h5><i><?php echo e(__('app.payment_disabled')); ?></i></h5>
                        </td>
                      </tr>
                      <?php endif; ?>
                      </tbody>
                    </table>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->

      </div>
		<?php endif; ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>