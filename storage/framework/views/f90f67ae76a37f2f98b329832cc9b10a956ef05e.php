<?php $__env->startSection('title', 'Метод не может быть запущен'); ?>
<?php $__env->startSection('code'); ?>
  <?php echo e($code); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('message'); ?>
  <?php echo e($message); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors::illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/errors/custom.blade.php ENDPATH**/ ?>