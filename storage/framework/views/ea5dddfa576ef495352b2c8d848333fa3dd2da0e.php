<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(__('app.login')); ?> - <?php echo setting('app_name'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <?php if(setting('recaptcha')): ?>
      <?php echo htmlScriptTagJsApi([
              'action' => 'login',]); ?>

  <?php endif; ?>
  <?php echo NoCaptcha::renderJs(); ?>


  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- FAVICON -->

  <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome/css/font-awesome.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck/skin/all.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatable/css/datatables.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/dist/summernote-bs4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datepicker/css/bootstrap-datepicker.standalone.css')); ?>">
  <script src="<?php echo e(asset('plugins/sweetalert/js/sweetalert.min.js')); ?>"></script>
  <style>
    .has-feedback{
        color: red;
    }

    body{
      background: #486d8e!important;
    }

    .twitter-blue{
      color: #00acee;
    }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo e(('plugins/googlefont/css.css')); ?>">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <div class=" d-block text-center mt-5">
      <a href="/">
        <img src="<?php echo e(setting('app_dark_logo')? setting('app_dark_logo'):asset('uploads/appLogo/logo-dark.png')); ?>" class="img img-responsive" height="60px" width="220px" alt="App Logo">
      </a>
    </div>
  </div>
  <!-- /.login-logo -->
  <div class="card mb-0 shadow px-3">
    <div class="card-body">
      <p class="login-box-msg"><?php echo e(__('app.sign_in_to_start_your_session')); ?></p>
      <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- social-auth-links -->
      <div class="row mb-1">
               <div class="col-sm-12 my-3 text-center">
                 <a href="login/facebook" class="mx-4">
                   <i class="fa fa-facebook fa-2x text-primary"></i></a>

                 <a href="login/twitter" class="mx-4">
                   <i class="fa fa-twitter fa-2x twitter-blue"></i></a>

                 <a href="login/google" class="mx-4">
                   <i class="fa fa-google fa-2x text-danger"></i></a>
               </div>
      </div>
     <!-- /.social-auth-links -->
    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
      <div class="form-group has-feedback">
        <input id="login" type="text" placeholder="<?php echo e(__('app.username_or_email')); ?>" class="form-control<?php echo e($errors->has('username') || $errors->has('email') ? ' is-invalid' : ''); ?>" name="login" value="<?php echo e(old('username') ?: old('email')); ?>" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php if($errors->has('username') || $errors->has('email')): ?>
            <span class="invalid-feedback">
                <strong><?php echo e($errors->first('username') ?: $errors->first('email')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" placeholder="<?php echo e(__('app.password')); ?>" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php $__errorArgs = ['password'];
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
      <?php if(setting('captcha')): ?>
        <div class="form-group has-feedback">
          <?php echo NoCaptcha::display(); ?>

          <?php if($errors->has('g-recaptcha-response')): ?>
              <span class="help-block" role="alert">
                  <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
              </span>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-12">
          <div class="checkbox">
          <input type="checkbox" name="remember" value="<?php echo e(old('remember')); ?>" id="remember">
            <label for="remember">
              <?php echo e(__('app.remember_me')); ?>

            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 mt-2">
          <button type="submit" class="btn btn-primary btn-block  col-12"><?php echo e(__('app.sign_in')); ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <p class="mb-1 mt-2">
      <a href="/password/reset"><?php echo e(__('app.i_forgot_my_password')); ?></a>
    </p>
    <p class="mb-0">
      <a href="<?php echo e(route('register')); ?>" class="text-center"><?php echo e(__('app.create_new_account')); ?></a>
    </p>
  </div>

  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->

<!-- Script -->
<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/theme.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatable/js/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/summernote/dist/summernote-bs4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/croppie/js/croppie.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>


</body>
</html>
<?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/auth/login.blade.php ENDPATH**/ ?>