<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(_('Email')); ?> - <?php echo setting('app_name'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
  <script src="<?php echo e(asset('plugins/sweetalert/js/sweetalert.min.js')); ?>"></script>
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome/css/font-awesome.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck/skin/all.css')); ?>">

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- FAVICON -->

  <style>
    .has-feedback{
        color: red;
    }
    body {
        background: #486d8e!important;
    }
  </style>

  <!-- Google Font -->
<link rel="stylesheet" href="<?php echo e(('plugins/googlefont/css.css')); ?>">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <div class=" d-block text-center mt-5">
        <img src="<?php echo e(setting('app_dark_logo')? setting('app_dark_logo'):asset('uploads/appLogo/logo-dark.png')); ?>" class="img img-responsive" height="60px" width="220px" alt="App Logo">
      </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <h5 class="text-center"><?php echo e(__('app.forgot_password')); ?></h5>

                    <form method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-center"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('app.send_password_reset_link')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.login-box-body -->
                  </div>
                  <!-- /.login-box -->

                  <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
                  <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
                  <script src="<?php echo e(asset('assets/js/theme.min.js')); ?>"></script>

                  </body>
                  </html>
<?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>