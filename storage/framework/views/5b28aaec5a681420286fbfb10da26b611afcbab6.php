

<?php $__env->startSection('title','Subscriptions'); ?>
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
              <li class="breadcrumb-item active"><?php echo e(__('app.subscription')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
      			<div class="col-md-7 mx-auto">
      				<?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      					<div class="card">
      						<div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h3 class="pull-right"><?php echo e(__('app.subscription_details')); ?></h3>
                        </div>
                        <div class="col-md-12">
                              <div class="table-responsive no-padding">
                    							<table class="table table-striped table-borderless pl-4 table-sm table-bordered">
                    								<tr>
                    									<td class="ml-5"><?php echo e(__('app.name')); ?></td>
                    									<td><?php echo e(auth()->user()->fullname); ?></td>
                    								</tr>
                    								<tr>
                    									<td class="ml-5"><?php echo e(__('app.plan_name')); ?></td>
                    									<td><?php echo e(strtoupper($plan['plan_name'])); ?></td>
                    								</tr>
                    								<tr>
                    									<td class="ml-5"><?php echo e(__('app.plan_status')); ?></td>
                    									<td>
                                          <?php if($plan['status']=='active'): ?>
                                            <span class="text-success">  <?php echo e('Active'); ?></span>
                                          <?php elseif($plan['status']=='trialing'): ?>
                                            <span class="text-danger">  <?php echo e('Trial Version'); ?></span>
                                          <?php endif; ?>
                                      </td>
                    								</tr>
                                    <tr>
                    									<td class="ml-5"><?php echo e(__('app.plan_period')); ?></td>
                    									<td><?php echo e($plan['interval_count']); ?> <?php echo e(ucfirst($plan['interval'])); ?></td>
                    								</tr>
                    								<tr>
                    									<td class="ml-5"><?php echo e(__('app.plan_cost')); ?></td>
                    									<td><?php echo money($plan['amount']); ?> <?php echo e(strtoupper(config('app.currency'))); ?></td>
                    								</tr>
                                    <tr>
                                      <td class="ml-5"><?php echo e(__('app.plan_start_date')); ?></td>
                                      <td><?php echo e($plan['start_date']); ?></td>
                                    </tr>
                                    <tr>
                                      <td class="ml-5"><?php echo e(__('app.plan_expiring_date')); ?></td>
                                      <td><?php echo e($plan['end_date']); ?></td>
                                    </tr>
                    							</table>
                            </div>
                        </div>
                        <div class="col-md-12 mx-auto mt-3">
                          <div class="row">
                            <div class="col-md-6">
                              <a href="/subscription-invoice/<?php echo e($plan['invoiceId']); ?>" class="btn btn-success col-md-12" target="blank"><?php echo e(__('app.generate_invoice')); ?></a>
                            </div>
                            <div class="col-md-6">
                              <a href="/subscription-cancel/<?php echo e($plan['subscriptionId']); ?>" class="btn btn-danger col-md-12" target="blank"><?php echo e(__('app.cancel_subscription')); ?></a>
                            </div>
                          </div>
                        </div>
                    </div>
      						</div>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/subscription/trial.blade.php ENDPATH**/ ?>