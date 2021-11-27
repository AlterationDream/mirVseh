<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title','-Lara-Swift'); ?> - <?php echo setting('app_name'); ?></title>
    <!-- the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/screenLoader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck/skin/all.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datepicker/css/bootstrap-datepicker.standalone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatable/css/datatables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/croppie/css/croppie.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/dist/summernote-bs4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/crud-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/virtual-select/virtual-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/jstree/style.min.css')); ?>" />

    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/croppie/js/croppie.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/chart-js/chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/sweetalert/js/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/virtual-select/virtual-select.min.js')); ?>"></script>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('favicon/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('favicon/site.webmanifest')); ?>">
    <link rel="mask-icon" href="<?php echo e(asset('favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- FAVICON -->

    <?php echo $__env->yieldContent('style'); ?>
    <style>
      :root{
        --theme: <?php echo e(setting("app_navbar")); ?>

      }
      .navbar {
        background-color: var(--theme);
      }
    </style>
</head>
<body class="hold-transition sidebar-mini ">
  <?php echo $__env->make('sweet::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Preloader -->
  <div class="payment-loader">
    <div class="loader-pendulums"></div>
  </div>
  <!-- /Preloader -->
<div class="wrapper">

  <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('content'); ?>

  <footer class="main-footer text-center">
    <strong>Все права защищены. <a href="<?php echo e(env('APP_URL')); ?>"><?php echo e(setting('app_name')); ?></a> &copy; <?php echo e(date('Y')); ?>.</strong>
  </footer>
</div>
<!-- ./wrapper -->
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/theme.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatable/js/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/summernote/dist/summernote-bs4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldContent('chart'); ?>
</body>
</html>
<?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/layouts/template.blade.php ENDPATH**/ ?>