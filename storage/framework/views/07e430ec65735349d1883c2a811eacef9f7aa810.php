<?php if( session('successful')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('successful')); ?>

    </div>
<?php endif; ?>

<?php if( session('failed')): ?>
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('failed')); ?>

    </div>
<?php endif; ?>


<?php if( session()->has('warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role-"alert">
        <?php echo e(session()->get('warning')); ?>

    </div>
<?php endif; ?>
	<div id="stripe-alert" class="alert alert-danger display-none">
		<meta>
  </div>

  <div id="success-alert" class="alert alert-success display-none">

  </div>

  <div id="failed-alert" class="alert alert-danger display-none">

  </div>
<?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/layouts/includes/alerts.blade.php ENDPATH**/ ?>