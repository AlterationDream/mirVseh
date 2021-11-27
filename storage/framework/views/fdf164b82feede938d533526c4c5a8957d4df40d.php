<?php $__env->startSection('title','Настройки сайта'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(__('app.app_settings')); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item active"><?php echo e(__('app.app_settings')); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mx-auto mb-3">
                  <ul class="nav nav-tabs" id="app-setting" role="tablist">

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link active" id="app-name-tab" data-toggle="tab" href="#app-name" role="tab" aria-controls="app-name" aria-selected="true"><i class="fa fa-user mr-2"></i><?php echo e(__('app.app_name')); ?></a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="app-logo-tab" data-toggle="tab" href="#app-logo" role="tab" aria-controls="app-logo" aria-selected="false"><i class="fa fa-image mr-2"></i><?php echo e(__('app.app_logo')); ?></a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="app-theme-tab" data-toggle="tab" href="#app-theme" role="tab" aria-controls="app-theme" aria-selected="false"><i class="fa fa-paint-brush mr-2"></i><?php echo e(__('app.app_theme')); ?></a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="payment-settings-tab" data-toggle="tab" href="#payment-settings" role="tab" aria-controls="payment-settings" aria-selected="false"><i class="fa fa-money mr-2"></i><?php echo e(__('app.app_payment_settings')); ?></a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="auth-settings-tab" data-toggle="tab" href="#auth-settings" role="tab" aria-controls="auth-settings" aria-selected="false"><i class="fa fa-key mr-2"></i><?php echo e(__('app.app_auth_settings')); ?></a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="app-backup-tab" data-toggle="tab" href="#app-backup" role="tab" aria-controls="app-backup" aria-selected="false"><i class="fa fa-database mr-2 text-light"></i><?php echo e(__('app.app_backup')); ?></a>
                    </li>
                  </ul>
              </div>
              <div class="col-md-7 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content my-3" id="app-settingContent">
                    <div class="tab-pane fade show active" id="app-name" role="tabpanel" aria-labelledby="app-name-tab">
                      <form action="<?php echo e(route('settings/app-name/update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-12">
                              <div class="form-group">
                                <input type="text"  name="app_name"  class="form-control" value="<?php echo e(setting('app_name')); ?>" placeholder="<?php echo e(__('app.app_application_name')); ?>">
                              </div>
                              <input type="submit"  class="form-control mt-2 btn btn-success" value="Сохранить название">
                            </div>
                    </form>
                    </div>
                    <div class="tab-pane fade" id="app-logo" role="tabpanel" aria-labelledby="app-logo-tab">
                          <form action="<?php echo e(route('settings/app-logo/update')); ?>" enctype="multipart/form-data" method="POST">
                              <?php echo csrf_field(); ?>
                              <div class="col-md-12">
                                <div class="form-group bg-light text-center">
                                  <img id="app-dark-logo" class="img img-responsive my-5 w-50 justify-content-center text-center" src="<?php echo e(setting('app_dark_logo')? asset('uploads/appLogo/app-logo-dark.png') :asset('uploads/appLogo/logo-dark.png')); ?>" alt="App_logo">
                                </div>
                                <div class="form-group">
                                  <label class="form-group mb-1"><?php echo e(__('app.app_select_dark_logo')); ?></label>
                                  <input type="file"  name="app_dark_logo"  class="form-control" value="Select Dark Logo">
                                </div>
                                <div class="form-group bg-secondary text-center">
                                  <img id="app-light-logo" class="img img-responsive my-5 w-50 justify-content-center text-center" src="<?php echo e(setting('app_light_logo')? asset('uploads/appLogo/app-logo-light.png') :asset('uploads/appLogo/logo-light.png')); ?>" alt="App_logo">
                                </div>
                                <div class="form-group">
                                  <label class="form-group mb-1"><?php echo e(__('app.app_select_ligth_logo')); ?></label>
                                  <input type="file"  name="app_light_logo"  class="form-control" value="Select Light Logo">
                                </div>
                                <input type="submit"  class="form-control mt-2 btn btn-success" value="<?php echo e(__('app.app_update_logo')); ?>">
                              </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="app-theme" role="tabpanel" aria-labelledby="app-theme-tab">
                          <form action="<?php echo e(route('settings/app-theme/update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12">
                                  <div class="form-group">
                                        <label class="form-group"><?php echo e(__('app.app_sidebar_theme')); ?></label>
                                      <select class="form-control" name="app_sidebar">
                                        <option value="dark" <?php echo e((setting('app_sidebar')=="dark")? 'selected' : ''); ?>><?php echo e(__('app.dark')); ?></option>
                                        <option value="light" <?php echo e((setting('app_sidebar')=="light")? 'selected' : ''); ?>><?php echo e(__('app.light')); ?></option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-group"><?php echo e(__('app.app_navbar_text')); ?></label>
                                      <select class="form-control" name="app_theme">
                                        <option value="dark" <?php echo e((setting('app_theme')=="dark")? 'selected' : ''); ?>><?php echo e(__('app.dark')); ?></option>
                                        <option value="light" <?php echo e((setting('app_theme')=="light")? 'selected' : ''); ?>><?php echo e(__('app.light')); ?></option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                        <label class="form-group"><?php echo e(__('app.app_navbar_bg')); ?></label>
                                        <input type="color" class="form-control" name="app_navbar" value="<?php echo e(setting('app_navbar')); ?>" id="color-picker">
                                  </div>
                                  <input type="submit"  class="form-control mt-2 btn btn-success" value="Сохранить тему">
                                </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="payment-settings" role="tabpanel" aria-labelledby="payment-settings-tab">
                        <form action="<?php echo e(route('settings/stripe-payment/update')); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="form-group"><?php echo e(__('app.app_stripe_key')); ?></label>
                                  <input type="text"  name="stripe_key"  class="form-control" value="<?php echo e(setting('stripe_key')); ?>" placeholder="<?php echo e(__('app.app_stripe_pub_key')); ?>">
                                  <label class="form-group mt-2"><?php echo e(__('app.app_stripe_secret')); ?></label>
                                  <input type="text"  name="stripe_secret"  class="form-control" value="<?php echo e(setting('stripe_secret')); ?>" placeholder="<?php echo e(__('app.app_stripe_sec_key')); ?>">
              									  </div>
                                  <div class="col-md-12">
                                    <label for="name"><?php echo e(__('app.status')); ?><span class="text-muted small"></span></label>
                                    <input id="status_toggle" type="checkbox"   name="stripe_status" data-toggle="toggle" data-width="100" data-on="Вкл" data-size="sm" data-off="Выкл" data-onstyle="success" data-offstyle="danger"  <?php echo e(setting('stripe_status')? 'checked':'unchecked'); ?>>
                                  </div>
                                </div>
                              <input type="submit"  class="form-control mt-2 btn btn-success" value="Update Stripe Details">
                          </form>
                    </div>

                    <div class="tab-pane fade" id="auth-settings" role="tabpanel" aria-labelledby="auth-settings-tab">
                        <form action="<?php echo e(route('settings/auth-settings/update')); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <div class="col-md-12">
                                <div class="form-group row mb-4">
                                  <div class="col-md-8">
                                    <strong class="d-block"><?php echo e(__('app.app_two_factor_auth')); ?></strong>
                                    <?php echo e(!setting('2fa')? 'Активировать': 'Деактивировать'); ?> <?php echo e(__('app.app_two_factor_auth_state')); ?>

                                  </div>
                                  <div class="col-md-4">
                                    <input id="status_toggle" type="checkbox"   name="two_factor_auth" data-toggle="toggle" data-width="100" data-on="Вкл" data-size="sm" data-off="Выкл" data-onstyle="success" data-offstyle="danger"  <?php echo e(setting('2fa')? 'checked':'unchecked'); ?>>
                                  </div>
              									</div>
                                <div class="form-group row mb-4">
                                  <div class="col-md-8">
                                    <strong class="d-block"><?php echo e(__('app.app_captcha')); ?></strong>
                                    <?php echo e(!setting('captcha')? 'Активировать': 'Деактивировать'); ?> <?php echo e(__('app.app_captcha_state')); ?>

                                  </div>
                                  <div class="col-md-4">
                                    <input id="status_toggle" type="checkbox"   name="captcha" data-toggle="toggle" data-width="100" data-on="Вкл" data-size="sm" data-off="Выкл" data-onstyle="success" data-offstyle="danger"  <?php echo e(setting('captcha')? 'checked':'unchecked'); ?>>
                                  </div>
              									</div>
                                <div class="form-group row">
                                  <div class="col-md-8">
                                    <strong class="d-block"><?php echo e(__('app.app_email_verification')); ?></strong>
                                    <?php echo e(!setting('email_verification')? 'Активировать': 'Деактивировать'); ?> <?php echo e(__('app.app_email_verification_state')); ?>

                                  </div>
                                  <div class="col-md-4">
                                    <input id="status_toggle" type="checkbox"   name="email_verification" data-toggle="toggle" data-width="100" data-on="Вкл" data-size="sm" data-off="Выкл" data-onstyle="success" data-offstyle="danger"  <?php echo e(setting('email_verification')? 'checked':'unchecked'); ?>>
                                  </div>
                                </div>
                              </div>
                              <input type="submit"  class="form-control mt-2 btn btn-success" value="<?php echo e(__('app.app_update_auth')); ?>">
                          </form>
                    </div>

                    <div class="tab-pane fade p-0" id="app-backup" role="tabpanel" aria-labelledby="app-backup-tab">
                    <div class="row p-0 m-0">
                      <div class="col-md-12">
                        <h4><?php echo e(__('app.app_backup_history')); ?></h4>
                        <div class="table-responsive">
                        <table class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th><?php echo e(__('app.filename')); ?></th>
                              <th><?php echo e(__('app.size')); ?></th>
                              <th><?php echo e(__('app.time')); ?></th>
                              <th><?php echo e(__('app.action')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(count($backups) > 0): ?>
                                <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><?php echo e($backup['filename']); ?></td>
                                  <td><?php echo e(ByteConverter::bytesToHuman($backup['size'])); ?></td>
                                  <td><?php echo e(date('Y-m-d H:i',$backup['time'])); ?></td>
                                  <td>
                                      <div class="d-inline-block">
                                        <form action="<?php echo e(route('backup-download',['name'=> $backup['filename'],'ext'=>$backup['extension']])); ?>" method="post">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                                        </form>
                                      </div>
                                      <div class="d-inline-block">
                                        <form action="<?php echo e(route('backup-delete',['name'=> $backup['filename'],'ext'=>$backup['extension']])); ?>" method="post">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                      </div>
                                  </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                              <tr>
                                <td></td>
                                <td></td>
                                <td><i><h5><?php echo e(__('app.no_record')); ?></h5></i></td>
                                <td></td>
                                <td></td>
                              </tr>
                            <?php endif; ?>
                          </tbody>
                        </table>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <form action="<?php echo e(route('backup-files')); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <input type="submit"  class="form-control mt-2 btn btn-success" value="<?php echo e(__('app.app_backup_file')); ?>">
                            </form>
                          </div>
                          <div class="col-md-6">
                            <form action="<?php echo e(route('backup-db')); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <input type="submit"  class="form-control mt-2 btn btn-success" value="<?php echo e(__('app.app_backup_database')); ?>">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>

                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    <!-- Main content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/settings/index.blade.php ENDPATH**/ ?>