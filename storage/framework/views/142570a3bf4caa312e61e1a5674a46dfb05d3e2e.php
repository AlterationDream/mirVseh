
<?php $__env->startSection('title','Subscribed Users'); ?>
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
              <li class="breadcrumb-item active"><?php echo e(__('app.subscribed_users')); ?></li>
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
  		           <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <h3 class="pull-right pr-2"><?php echo e(__('app.subscribed_users')); ?></h3>
                          </div>
                          <div class="col-md-12">
                            <?php if($error_message): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo e($error_message); ?>

                            </div>
                            <?php endif; ?>
                            <div class="table-responsive no-padding">
                              <table id="dataTable" class="table table-hover table-borderless table-striped">
                                <thead>
                                  <tr>
                                    <th><?php echo e(__('app.action')); ?></th>
                                    <th><?php echo e(__('app.fullname')); ?></th>
                                    <th><?php echo e(__('app.subscription_plan')); ?></th>
                                    <th><?php echo e(__('app.subscription_amount')); ?></th>
                                    <th><?php echo e(__('app.subscription_status')); ?></th>
                                    <th><?php echo e(__('app.start_date')); ?></th>
                                    <th><?php echo e(__('app.end_date')); ?></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!is_null($subscription['subscription'])): ?>
                                      <tr>
                                        <td>
                                          <a href="/user-subscription-invoice/<?php echo e($subscription['subscription']->latest_invoice); ?>" class="" target="_blank"><button class="btn btn-sm btn-info mt-1" data-toggle="tooltip"  data-placement="bottom" title="Subscription Invoice PDF"/><i class="fa fa-file-pdf-o text-white"></i></button></a>
                                          <a type="button" data-toggle="modal" data-target="#cancelSub<?php echo e($subscription['subscription']->id); ?>"><button class="btn btn-sm btn-danger mt-1" data-toggle="tooltip"  data-placement="bottom" title="Cancel Subscription"/><i class="fa fa-remove text-white"></i></button></a>
                                          <div class="modal fade" id="cancelSub<?php echo e($subscription['subscription']->id); ?>" tabindex="-1" role="dialog" aria-labelledby="cancelSubLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-body text-center">
                                                  <h3 class="mb-4"><?php echo e(__('app.please_confirm')); ?></h3>
                                                  <p class="mb-5"><?php echo e(__('app.subscription_confirm_cancel')); ?></p>
                                                  <button type="button" class="btn btn-secondary col-md-5 pull-left" data-dismiss="modal"><?php echo e(__('app.close')); ?></button>
                                                  <a type="button" href="/user-subscription-cancel/<?php echo e($subscription['subscription']->id); ?>" class="btn btn-danger col-md-6 pull-right"><?php echo e(__('app.cancel_subscription')); ?></a>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </td>
                                        <td><a href="/user/"><?php echo e(($subscription['fullname'])? $subscription['fullname'] : $subscription['customer']->email); ?></a></td>
                                        <td><?php echo e($subscription['subscription']->plan->nickname); ?></td>
                                        <td>
                                          <?php if($subscription['subscription']->status == 'trialing'): ?>
                                            <?php echo money(0); ?>
                                          <?php else: ?>
                                            <?php echo money($subscription['subscription']->plan->amount); ?>
                                          <?php endif; ?>
                                        </td>
                                        <td><?php echo e(ucfirst($subscription['subscription']->status)); ?></td>
                                        <td><?php echo e(date('M d, Y',$subscription['subscription']->current_period_start)); ?></td>
                                        <td><?php echo e(date('M d, Y',$subscription['subscription']->current_period_end)); ?></td>
                                    </tr>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/paymentgateway/subscribedUsers.blade.php ENDPATH**/ ?>