

<?php $__env->startSection('title','Subscriptions'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(__('app.subscription')); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('/subscription')); ?>"><?php echo e(__('app.subscription')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.plans')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
          		<?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php if(count($plans) < 1): ?>
              <div class=" col-md-12 mx-auto">
                <div class="callout callout-danger text-center">
                  <h4 class=""><dfn><?php echo e(__('app.subscription_not_available')); ?></dfn></h4>
                </div>
              </div>
              <?php endif; ?>
                  <div class="col-md-12">
                  <div class="row">
              			<?php $__currentLoopData = $plans->sortBy('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  			<div class="col-md-4 mx-0 my-1 mb-5">
                  				<div class="card border-top border-bottom-0 border-right-0 border-left-0 border-dark h-100">
                  					<!-- /.card-header -->
                  					<div class="card-body p-3">
                  						<div class="row">
                                  <div class=" col-md-10 mx-auto text-center h-100">
                                    <p class="px-3 py-2 bg-dark rounded-lg p-1 text-primary border-primary mx-auto d-inline-block lead font-weight-normal shadow"><?php echo e($plan->plan_name); ?></p>
                                    <div class="text-left mb-3">
                                      <p class="mb-2"><?php echo $plan->plan_description; ?></p>
                                    </div>

                                    <hr />
                                    <p class="text-center mb-0 pb-0"><span class="font-weight-400 font-size-35"><?php echo money($plan->plan_amount); ?></span><span class="font-weight-400 font-size-25">/</span><span class="font-weight-400 font-size-20"><?php echo e(ucfirst($plan->plan_interval)); ?></span></p>
                                    <p class="text-center mt-0"><span><?php echo e(__('app.plan_interval')); ?></span> : <span><?php echo e($plan->plan_intervalCount); ?></span></p>
                                    <p class="text-center mt-0"><span><?php echo e(__('app.trial_period')); ?></span> : <span><?php echo e(($plan->trial_period_days)? $plan->trial_period_days:"nil"); ?></span></p>
                                    <h2 class="mt-3"></h2>
                                  </div>
                  						</div>
                              <div class="col-md-12 mx-auto">
                                <form action="<?php echo e(route('/subscription/stripe',['plan_id' =>$plan->plan_id])); ?>" method="GET" id="subscription-form">
                                  <?php echo csrf_field(); ?>
                                  <div class="col-sm-12"><button type="submit" class="btn btn-primary col-sm-12"><?php echo e(__('app.subscribe')); ?></button></div>
                                </form>
                              </div>
                  					</div>
                  						<!-- /.card-body -->
                  						<!-- /.card-footer -->
                  				</div>
                  			<!-- /.card -->
                </div>
        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>
          </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/subscription/stripePlans.blade.php ENDPATH**/ ?>