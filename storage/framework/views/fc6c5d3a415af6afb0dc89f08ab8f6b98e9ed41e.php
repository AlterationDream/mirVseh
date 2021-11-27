

<?php $__env->startSection('title','Create Stripe Plan'); ?>
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
              <li class="breadcrumb-item"><a href="/subscription/plan"><?php echo e(__('app.subscription_plans')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.create')); ?></li>
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
        <div class="col-md-12">
            <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-7 mx-auto">
                  <!-- Role Creation -->
                      <div class="card">
                        <form class="form-horizontal" method="POST" action="/subscription/plan/create">
                          <?php echo csrf_field(); ?>
                        <!-- form start -->
                        <div class="card-body">
                              <div class="row">
                                <div class="col-md-12 mb-3">
                                  <h3 class="pull-right"><?php echo e(__('app.create_plan')); ?></h3>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <div  class="col-sm-12">
                                          <label for="plan_name" class="control-label"><?php echo e(__('app.plan_name')); ?></label>
                                          <input type="text" name="plan_name" class="form-control" id="password" placeholder="<?php echo e(__('app.plan_name')); ?>">
                                          <?php if($errors->has('plan_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('plan_name')); ?></strong>
                                            </span>
                                          <?php endif; ?>
                                        </div>
                                  </div>
                                  <div class="form-group ">
                                      <div  class="col-sm-12">
                                          <label for="plan_description" class="control-label"><?php echo e(__('app.plan_description')); ?></label>
                                          <textarea id="plan-description" name="plan_description" class="form-control textarea-resize-none" placeholder="<?php echo e(__('app.plan_description')); ?>"></textarea>
                                          <?php if($errors->has('plan_description')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('plan_description')); ?></strong>
                                            </span>
                                          <?php endif; ?>
                                        </div>
                                  </div>
                                  <div class="form-group ">
                                        <div  class="col-sm-12">
                                            <label for="plan_amount" class="control-label"><?php echo e(__('app.amount')); ?></label>
                                            <input type="text" name="plan_amount" class="form-control" id="plan_amount" placeholder="<?php echo e(__('app.amount')); ?>">
                                            <?php if($errors->has('plan_amount')): ?>
                                              <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo e($errors->first('plan_amount')); ?></strong>
                                              </span>
                                            <?php endif; ?>
                                          </div>
                                    </div>
                                  <div class="form-group ">
                                        <div  class="col-sm-12">
                                            <label for="plan_interval" class="control-label"><?php echo e(__('app.plan_interval')); ?></label>
                                            <select class="form-control" name="plan_interval">
                                              <option value="<?php echo e(__('app.year')); ?>"><?php echo e(__('app.yearly')); ?></option>
                                              <option value="<?php echo e(__('app.month')); ?>" selected><?php echo e(__('app.monthly')); ?></option>
                                              <option value="<?php echo e(__('app.week')); ?>"><?php echo e(__('app.weekly')); ?></option>
                                              <option value="<?php echo e(__('app.day')); ?>"><?php echo e(__('app.daily')); ?></option>
                                            </select>
                                            <?php if($errors->has('plan_interval')): ?>
                                              <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo e($errors->first('plan_interval')); ?></strong>
                                              </span>
                                            <?php endif; ?>
                                        </div>
                                  </div>
                                  <div class="form-group ">
                                      <div  class="col-sm-12">
                                          <label for="plan_intervalCount" class="control-label"><?php echo e(__('app.plan_interval_count')); ?></label>
                                          <input type="number" name="plan_intervalCount" class="form-control" id="plan_intervalCount" placeholder="<?php echo e(__('app.plan_interval_count')); ?>">
                                          <?php if($errors->has('plan_intervalCount')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('plan_interval')); ?></strong>
                                            </span>
                                              <?php endif; ?>
                                          </div>
                                  </div>
                                  <div class="form-group ">
                                      <div  class="col-sm-12">
                                          <label for="plan_intervalCount" class="control-label mr-2"><?php echo e(__('app.add_trial_period')); ?></label>
                                          <input type="checkbox" name="trial_check" id="trial_check">
                                          <input type="text" name="plan_trial_period" class="form-control" id="plan_trial_period" placeholder="<?php echo e(__('app.trial_period')); ?>">
                                          <?php if($errors->has('plan_trial_period')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('plan_trial_period')); ?></strong>
                                            </span>
                                              <?php endif; ?>
                                          </div>
                                  </div>
                                </div>
                              </div>
                         </div>
                          <!-- /.card-body -->
                          <script>
                            (function(){
                              "use strict";

                              window.onload = function(){
                                var trial_check = document.getElementById('trial_check');
                                var trial_check_input = document.getElementById('plan_trial_period');
                                trial_check_input.style.display = 'none';
                                trial_check.addEventListener('change',function(){
                                  if(this.checked){
                                    trial_check_input.style.display = '';
                                  }else{
                                    trial_check_input.style.display = 'none';
                                  }
                                })
                              }
                            })()
                          </script>
                        <div class="card-footer">
                            <div class="col-md-8 mx-auto">
                               <button type="submit" class="btn btn-info col-sm-12"><?php echo e(__('app.create_plan')); ?></button>
                            </div>
                          </div>
                          <!-- Role Creation -->
                      </form>
                <!-- form end -->
                </div>
                <!-- /.card-body -->
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/paymentgateway/stripe/planCreate.blade.php ENDPATH**/ ?>