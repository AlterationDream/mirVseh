<?php $__env->startSection('title', __('Method Not Allowed')); ?>
<?php $__env->startSection('code'); ?>
  <?php echo e($code); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('message'); ?>
  <?php echo e($message); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors::illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/errors/custom.blade.php ENDPATH**/ ?>