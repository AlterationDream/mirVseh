
<?php $__env->startSection('title','Incomes'); ?>
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
              <li class="breadcrumb-item active"><?php echo e(__('app.income_record')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="container-fluid">
          <div class="row">
             <div class="col-md-8">
  		           <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <h3 class="pull-right pr-2"><?php echo e(__('app.income_history')); ?></h3>
                          </div>
                          <div class="col-md-12">
                            <div class="table-responsive no-padding">
                              <table id="dataTable" class="table table-hover table-borderless table-striped">
                                <thead>
                                  <tr>
                                    <th><?php echo e(__('app.date_of_payment')); ?></th>
                                    <th><?php echo e(__('app.payer')); ?></th>
                                    <th><?php echo e(__('app.amount')); ?></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($income): ?>
                                        <tr>
                                          <td><?php echo e(date('M d, y h:i:s',strtotime($income['date']))); ?></td>
                                            <td><?php echo e($income['payer']); ?></td>
                                            <td><?php echo money($income['amount']); ?></td>
                                        </tr>
                                      <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><h5>Sub-total</h5></td>
                                    <td></td>
                                    <td><h5><?php if($total): ?> <?php echo money($total); ?> <?php else: ?> <?php echo e('N/A'); ?> <?php endif; ?></h5></td>
                                  </tr>
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
             <div class="col-md-4">
               <div class="card">
                 <div class="card-body">
                    <h4><?php echo e(__('app.overral_income')); ?></h4> <h3><?php if($overrall_income): ?> <?php echo money($overrall_income); ?> <?php else: ?> <?php echo e('N/A'); ?> <?php endif; ?></h3>
                 </div>
               </div>
             </div>
          </div>
       </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/paymentgateway/incomeRecord.blade.php ENDPATH**/ ?>