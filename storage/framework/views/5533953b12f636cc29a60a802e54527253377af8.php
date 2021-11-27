<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(_('Registration')); ?> - <?php echo setting('app_name'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <?php if(setting('recaptcha')): ?>
      <?php echo htmlScriptTagJsApi([
              'action' => 'registration',]); ?>

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

  <!-- STYLESHEET -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
  <script src="<?php echo e(asset('plugins/sweetalert/js/sweetalert.min.js')); ?>"></script>
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome/css/font-awesome.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck/skin/all.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datepicker/css/bootstrap-datepicker.standalone.css')); ?>">

  <style>
     body{
      background: #486d8e!important;
    }

    .twitter-blue{
      color: #00acee;
    }
  </style>

</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
      <div class=" d-block text-center mt-5">
        <a href="./">
          <img src="<?php echo e(setting('app_dark_logo')? setting('app_dark_logo'):asset('uploads/appLogo/logo-dark.png')); ?>" class="img img-responsive" height="60px" width="220px" alt="App Logo">
        </a>
      </div>
    </div>

    <div class="card shadow px-3">
      <div class="card-body register-card-body rounded">
        <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(Session::has('message')): ?>
            <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
        <?php endif; ?>
        <p class="login-box-msg"><?php echo e(__('app.create_new_account')); ?></p>

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


      <form method="POST" action="<?php echo e(route('register')); ?>">
          <?php echo csrf_field(); ?>
        <div class="form-group has-feedback">
          <!-- Fullname -->
          <input id="fullname" type="text" placeholder="<?php echo e(__('app.fullname')); ?>" class="form-control <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="fullname" value="<?php echo e(old('fullname')); ?>" required autocomplete="fullname" autofocus>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <?php $__errorArgs = ['fullname'];
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
        <!-- Fullname -->

        <!-- Username -->
        <div class="form-group has-feedback">
              <input id="username" type="text" placeholder="<?php echo e(__('app.username')); ?>" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(old('username')); ?>" required autocomplete="username">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              <?php $__errorArgs = ['username'];
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
        <!-- Username -->

        <!-- Email -->
        <div class="form-group has-feedback">
              <input id="email" type="email" placeholder="<?php echo e(__('app.email')); ?>" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
        <!-- Email -->

        <!-- Password -->
        <div class="form-group has-feedback">
              <input id="password" type="password" placeholder="<?php echo e(__('app.password')); ?>" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">
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
        <!-- Password -->

        <!-- Password-Confirmation -->
        <div class="form-group has-feedback">
          <input id="password-confirm" type="password" placeholder="<?php echo e(__('app.confirm_password')); ?>" class="form-control" name="password_confirmation" required autocomplete="new-password">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <!-- Password-Confirmation -->
        <?php if(setting('captcha')): ?>
          <div class="form-group has-feedback">
            <?php echo NoCaptcha::display(); ?>

            <?php if($errors->has('g-recaptcha-response')): ?>
                <span class="help-block text-danger" role="alert">
                    <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                </span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <!-- Submit Button -->
        <div class="row">
          <div class="col-md-12">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               <?php echo e(__('app.i_agree_to_the')); ?> <a href="#">условиями соглашения</a>.
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Зарегистирроваться</button>
          </div>
          <!-- /.col -->
        </div>
        <!-- Submit Button -->
      </form>

      <a href="<?php echo e(route('login')); ?>" class="text-center">У меня уже есть аккаунт</a>
    </div>
    <!-- /.form-box -->
    </div>
</div>
<!-- /.register-box -->


<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/theme.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/croppie/js/croppie.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/auth/register.blade.php ENDPATH**/ ?>