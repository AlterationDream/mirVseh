

<?php $__env->startSection('title','Subscription Plans'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo e(__('app.subscription_plans')); ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="/subscription/plan"><?php echo e(__('app.subscription_plans')); ?></a></li>
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
          <div class="col-md-12 mx-auto">
            <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                      <a href="/subscription/plan/create" class="pull-right btn btn-primary"><?php echo e(__('app.create_plan')); ?></a>
                    </div>
                    <div class="col-md-12">
                    <?php if($error_message): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <?php echo e($error_message); ?>

                      </div>
                    <?php endif; ?>
                      <div class="table-responsive no-padding">
                        <table id="dataTable" class="table table-hover table-striped table-borderless">
                          <thead>
                            <tr>
                              <th><?php echo e(__('app.plan_name')); ?></th>
                    				  <th><?php echo e(__('app.plan_frequency')); ?></th>
                              <th><?php echo e(__('app.plan_interval')); ?></th>
                              <th><?php echo e(__('app.amount')); ?></th>
                              <th><?php echo e(__('app.trial_period')); ?></th>
                              <th><?php echo e(__('app.action')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($plan->plan_name); ?></td>
                    					<td><?php echo e($plan->plan_interval); ?></td>
                    					<td><?php echo e($plan->plan_intervalCount); ?></td>
                    					<td><?php echo money($plan->plan_amount); ?></td>
                              <!-- str_plural for days or day indication -->
                    					<td><?php echo e(($plan->trial_period_days < 1 )?  0 : $plan->trial_period_days." ".str_plural('day',$plan->trial_period_days)); ?></td>
                              <td>

                                      <div class="d-inline-block">
                                        <a href="<?php echo e(url('/stripe/plan/edit',['plan_id'=>$plan->plan_id])); ?>"><button class="btn btn-sm btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit_plan')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                                      </div>
                                      <div class="d-inline-block">
                                        <form action="<?php echo e(url('/stripe/plan/delete',['plan_id'=>$plan->plan_id])); ?>" method="POST">
                                          <?php echo csrf_field(); ?>
                                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"  data-target="#deletePlan<?php echo e($plan->plan_id); ?>" title="<?php echo e(__('app.delete_plan')); ?>"/><i class='fa fa-trash text-white'></i></button>
                                          <div class="modal fade" id="deletePlan<?php echo e($plan->plan_id); ?>" tabindex="-1" role="dialog" aria-labelledby="deletePlanLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-body text-center">
                                                  <h3 class="mb-4"><?php echo e(__('app.please_confirm')); ?></h3>
                                                  <p class="mb-5"><?php echo e(__('app.delete_plan_confirm')); ?></p>
                                                  <button type="button" class="btn btn-secondary col-md-5 pull-left" data-dismiss="modal"><?php echo e(__('app.close')); ?></button>
                                                  <button type="submit" class="btn btn-danger col-md-6 pull-right"><?php echo e(__('app.delete_plan')); ?></button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/paymentgateway/stripe/planIndex.blade.php ENDPATH**/ ?>