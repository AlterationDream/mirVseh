
<?php $__env->startSection('title','Checkout Samples'); ?>
<?php $__env->startSection('style'); ?>
<script src="https://js.stripe.com/v3/"></script>
<?php $__env->stopSection(); ?>
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
              <li class="breadcrumb-item active"><?php echo e(__('app.checkout')); ?></li>
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
                            <h3 class="pull-right pr-2"><?php echo e(__('app.checkout_documentation')); ?></h3>
                          </div>
                          <div class="col-md-12">
                              <div class="row">
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
                                              <h3 class="mb-0 mt-4 px-4"><?php echo e(__('app.amount')); ?>: <?php echo money(100); ?></h3>
                                            </div>
                                            <div class="col-md-12 p-3 mb-4 elevate  bg-gradient-light">
                                              <div class="row">
                                                <div class="col-md-8 mx-auto">
                                                  <label for="card-element " class=""><?php echo e(__('app.checkout')); ?></label>
                                                </div>
                                                  <div class="col-md-8 mx-auto mt-3" id="card-element"></div>
                                                  <div id="card-errors" role="alert"></div>
                                                  <button class="btn btn-success col-md-6 mt-5 mx-auto" id="payNow"><?php echo e(__('app.pay_to_download')); ?> (<?php echo money(100); ?>)</button>
                                              </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                            </div>
                                            <script>
                                                "use strict";
                                                  var pay_btn = document.querySelector('#payNow');
                                                  var cardholderName = "<?php echo e(auth()->user()->fullname?? auth()->user()->email); ?>";
                                                  var stripe = Stripe('<?php echo e(setting("stripe_key")); ?>');
                                                  var clientSecret = "<?php echo e($secret_id); ?>"
                                                  var elements = stripe.elements();
                                                  var style = {
                                                  base: {
                                                    color: "#32325d",
                                                    }
                                                  };
                                                  var card = elements.create("card", { style: style });
                                                  card.mount("#card-element");
                                                  pay_btn.addEventListener('click',function(e){
                                                    pay_btn.disabled = true
                                                    stripe.confirmCardPayment(clientSecret, {
                                                      payment_method: {
                                                        card: card,
                                                        billing_details:{name:cardholderName}
                                                      }
                                                    }).then(function(result) {
                                                      if (result.error) {
                                                        swal({
                                                          icon:'error',
                                                          title:"Error",
                                                          text:result.error.message,
                                                          button: "Retry"
                                                        }).then(()=>{
                                                          pay_btn.disabled = false
                                                        })
                                                      } else {
                                                        if (result.paymentIntent.status === 'succeeded') {
                                                          window.location.replace("<?php echo e(URL::to('/')); ?>"+'/checkout-sample/response/'+result.paymentIntent.id)
                                                        }
                                                      }
                                                    });
                                                  });
                                            </script>
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
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/paymentgateway/sample/checkoutSample.blade.php ENDPATH**/ ?>