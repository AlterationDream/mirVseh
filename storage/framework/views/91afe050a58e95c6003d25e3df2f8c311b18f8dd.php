
<?php $__env->startSection('title','Checkout Samples'); ?>
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
              <li class="breadcrumb-item"><a href="/checkout-sample"><?php echo e(__('app.sample')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.paid')); ?></li>
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
                  <div class="card <?php echo e(($response=='failed')? 'd-none':''); ?>">
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <h3 class="pull-right pr-2"><?php echo e(__('app.download_article')); ?></h3>
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-8 mx-auto">
                              <div class="card elevate shadow h-100">
                                  <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 my-3 text-center">
                                          <img src="<?php echo e(asset('uploads/download.jpg')); ?>" alt="" class="img rounded img-fluid">
                                        </div>
                                        <div class="col-md-6 my-3 border-left py-2">
                                          <ul class="mb-5 list-style-square">
                                            <li><?php echo e(__('app.document_sample')); ?></li>
                                            <li><?php echo e(__('app.sample_pages')); ?></li>
                                            <li><?php echo e(__('app.sample_author')); ?></li>
                                            <li><?php echo e(__('app.sample_publish_date')); ?></li>
                                          </ul>
                                        </div>
                                        <div class="col-md-12 text-center">
                                          <a href="/checkout-sample/article"><button class="btn btn-success col-md-6"><?php echo e(__('app.download_article')); ?></button></a>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
             </div>
       </div>
    </section>
    <!-- /.content -->
  </div>
  <script>
    "use strict";
   var response = '<?php echo e($response); ?>';
   var message = '<?php echo e($message); ?>'
   var status = '<?php echo e($response); ?>'
   if(status=='success'){
     swal({
       icon:'success',
       text:message
     })
   }else{
     swal({
       icon:'error',
       text:message
     }).then(function(){
       window.location.replace("<?php echo e(URL::to('/checkout-sample')); ?>")
     })
   }
  </script>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/paymentgateway/sample/checkoutResponse.blade.php ENDPATH**/ ?>