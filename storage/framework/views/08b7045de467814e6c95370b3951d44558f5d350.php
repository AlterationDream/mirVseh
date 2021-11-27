<?php $__env->startSection('title','Профиль'); ?>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.profile')); ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- Profile Image -->
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="row">
                                    <div id="avatar-holder" class="col-md-12">
                                        <img id="avatar-img" width="40px" height="100px"
                                             class="img profile-user-img img-responsive img-circle"
                                             src="<?php echo e($user->avatar? $user->avatar :asset('uploads/avatar/avatar.png')); ?>"
                                             alt="User profile picture">
                                        <h5 class="mt-3 mb-0"><b><?php echo e($user->fullname); ?></b></h5>
                                        <p><?php echo e($user->email); ?></p>
                                        <span class="mt-5 mb-0 d-block">
                                        <p>
                                          <b>Роль:</b>
                                          <?php echo e(($role)? $role->name:'Нет роли'); ?>

                                        </p>
                                      </span>
                                                            <span class="mt-0 d-block"><p><b>Дата регистрации:</b>
                                            <?php echo e($user->created_at); ?>

                                      </p></span>

                                        <label class="btn btn-secondary btn-lg d-block mx-auto mt-5 col-sm-12 mb-0"
                                               for="avatarCrop">
                                            <?php echo e(__('app.update_avatar')); ?>

                                            <input type="file" class="d-none" id="avatarCrop">
                                        </label>
                                    </div>
                                    <div id="avatar-updater" class="col-xs-12 d-none">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="image-preview"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" name="avatar-url" class="d-none"
                                                       value="<?php echo e(route('update-avatar',Auth::user()->id)); ?>">
                                                <button type="button" id="rotate-image"
                                                        class="btn btn-info col-sm-12 mb-1"><?php echo e(__('app.rotate_image')); ?></button>
                                                <button type="button" id="crop_image"
                                                        class="btn btn-primary col-sm-12"><?php echo e(__('app.crop_image')); ?></button>
                                                <button type="button" id="avatar-cancel-btn" name="button"
                                                        class="btn btn-secondary col-sm-12 mt-1"><?php echo e(__('app.cancel')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item shadow mb-3 mr-2">
                                        <a class="nav-link active" id="account-details-tab" data-toggle="tab"
                                           href="#account-details" role="tab" aria-controls="account-details"
                                           aria-selected="false"><?php echo e(__('app.account_details')); ?></a>
                                    </li>
                                    <li class="nav-item shadow mb-3 mr-2">
                                        <a class="nav-link" id="login-details-tab" data-toggle="tab"
                                           href="#login-details" role="tab" aria-controls="login-details"
                                           aria-selected="false"><?php echo e(__('app.login_details')); ?></a>
                                    </li>
                                    <?php if(setting('2fa')): ?>
                                        <li class="nav-item shadow mb-3 mr-2">
                                            <a class="nav-link" id="tfa-settings-tab" data-toggle="tab"
                                               href="#tfa-settings" role="tab" aria-controls="tfa-settings"
                                               aria-selected="false"><?php echo e(__('app.two_factor_auth')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content mt-3 mx-0">
                                    <div class="tab-pane active" id="account-details" role="tabpanel"
                                         aria-labelledby="account-details-tab">
                                        <form class="form-horizontal" method="POST"
                                              action="<?php echo e(route('profile.update',$user->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('put'); ?>
                                            <div class="row form-group">
                                                <div class="col-md-6 mt-1">
                                                    <div><label class="label-block"><?php echo e(__('app.role')); ?></label></div>
                                                    <input type="text" name="role"
                                                           value="<?php echo e(($role)? $role->name:'Нет роли'); ?>"
                                                           class="form-control" disabled>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <div><label class="label-block"><?php echo e(__('app.status')); ?></label></div>
                                                    <select class="form-control" name="status" disabled>
                                                        <option
                                                            value="active" <?php echo e(($user->status == 'active')? 'SELECTED':''); ?>>
                                                            Активен
                                                        </option>
                                                        <option
                                                            value="active" <?php echo e(($user->status == 'banned')? 'SELECTED':''); ?>>
                                                            Заблокирован
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-1 mt-2">
                                                    <div><label class="label-block"><?php echo e(__('app.fullname')); ?></label></div>
                                                    <input type="text" name="fullname" value="<?php echo e($user->fullname); ?>"
                                                           class="form-control">
                                                    <?php if($errors->has('fullname')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('fullname')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <div><label class="label-block"><?php echo e(__('app.phone')); ?></label></div>
                                                    <input type="text" name="phone" value="<?php echo e($user->phone); ?>"
                                                           class="form-control" placeholder="Телефон">
                                                    <?php if($errors->has('phone')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo e($errors->first('phone')); ?></strong>
                                              </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label for="mobile"><?php echo e(__('app.country')); ?></label>
                                                    <select name="country"
                                                            class="form-control form-control-inline-block">
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($country); ?>" <?php echo e(($user->country == $country)? 'selected':''); ?>><?php echo e($country); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($errors->has('country')): ?>
                                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('country')); ?></strong>
                                            </span>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 mt-1">
                                                    <label for="address"
                                                           class="control-label"><?php echo e(__('app.address')); ?></label>
                                                    <input type="text" name="address" class="form-control"
                                                           value="<?php echo e($user->address); ?>" id="address" placeholder="Адрес">
                                                    <?php if($errors->has('address')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                              <strong><?php echo e($errors->first('address')); ?></strong>
                                          </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-8 mx-auto">
                                                <button type="submit"
                                                        class="btn btn-primary col-sm-12"><?php echo e(__('app.update_account')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="login-details" role="tabpanel"
                                         aria-labelledby="login-details-tab">
                                        <form class="form-horizontal" method="POST"
                                              action="<?php echo e(route('update-login',$user->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <div><label class="label-block"><?php echo e(__('app.email')); ?></label></div>
                                                    <input type="text" name="email" value="<?php echo e($user->email); ?>"
                                                           class="form-control">
                                                    <?php if($errors->has('email')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div><label class="label-block"><?php echo e(__('app.username')); ?></label></div>
                                                    <input type="text" name="username" value="<?php echo e($user->username); ?>"
                                                           class="form-control" autocomplete="off">
                                                    <?php if($errors->has('username')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('username')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 my-1">
                                                    <div><label class="label-block"><?php echo e(__('app.password')); ?></label></div>
                                                    <input type="password" name="password" value=""
                                                           placeholder="<?php echo e(__('app.leave_blank')); ?>" class="form-control"
                                                           autocomplete="off">
                                                    <?php if($errors->has('password')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 my-1">
                                                    <div><label
                                                            class="label-block"><?php echo e(__('app.confirm_password')); ?></label>
                                                    </div>
                                                    <input type="password" name="password_confirmation" value=""
                                                           placeholder="<?php echo e(__('app.leave_blank')); ?>" class="form-control"
                                                           autocomplete="off">
                                                    <?php if($errors->has('password_confirmation')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-8 mx-auto">
                                                <button type="submit"
                                                        class="btn btn-primary col-sm-12"><?php echo e(__('app.update_login')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php if(setting('2fa')): ?>
                                        <div class="tab-pane" id="tfa-settings" role="tabpanel"
                                             aria-labelledby="tfa-settings-tab">
                                            <!--Google Two Factor Authentication card-->
                                            <div class="col-md-12">
                                            <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php if(empty(auth()->user()->google2fa)): ?>
                                                <!--=============Generate QRCode for Google 2FA Authentication=============-->
                                                    <div class="row p-0">
                                                        <div class="col-md-12">
                                                            <p><?php echo e(__('app.to_activate_2fa')); ?></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <form class="" action="<?php echo e(route('activate-2fa')); ?>"
                                                                  method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <button
                                                                    class="btn btn-primary col-md-6"><?php echo e(__('app.activate_2fa')); ?></button>
                                                                <a class="btn btn-secondary col-md-5"
                                                                   data-toggle="collapse" href="#collapseExample"
                                                                   role="button" aria-expanded="false"
                                                                   aria-controls="collapseExample"><?php echo e(__('app.setup_instruction')); ?></a>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-12 mt-3 collapse" id="collapseExample">
                                                            <hr>
                                                            <h3 class=""><?php echo e(__('app.2fa_instruction_1')); ?></h3>
                                                            <hr>
                                                            <div class="mt-4">
                                                                <h4><?php echo e(__('app.2fa_instruction_2')); ?></h4>
                                                                <p><label><?php echo e(__('app.step_1')); ?>

                                                                        :</label> <?php echo e(__('app.download')); ?>

                                                                    <strong><?php echo e(__('app.google_auth')); ?></strong> <?php echo e(__('app.app_for_andriod_or_ios')); ?>

                                                                </p>
                                                                <p class="text-center">
                                                                    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                                                                       target="_blank"
                                                                       class="btn btn-success"><?php echo e(__('app.download_for_android')); ?>

                                                                        <i class="fa fa-android fa-2x ml-2"></i></a>
                                                                    <a href="https://apps.apple.com/us/app/google-authenticator/id388497605"
                                                                       target="_blank"
                                                                       class="btn btn-dark ml-2"><?php echo e(__('app.download_for_iPhones')); ?>

                                                                        <i class="fa fa-apple fa-2x ml-2"></i></a></p>
                                                                <p><label><?php echo e(__('app.step_2')); ?>

                                                                        :</label> <?php echo e(__('app.click_on_generate_secret')); ?>

                                                                </p>
                                                                <p><label><?php echo e(__('app.step_3')); ?>

                                                                        :</label> <?php echo e(__('app.open_the')); ?>

                                                                    <strong><?php echo e(__('app.google_auth')); ?></strong> <?php echo e(__('app.and_click_on')); ?>

                                                                    <strong><?php echo e(__('app.begin')); ?></strong> <?php echo e(__('app.on_the_mobile_app')); ?>

                                                                </p>
                                                                <p><label><?php echo e(__('app.step_4')); ?>

                                                                        :</label> <?php echo e(__('app.after_which_click_on')); ?>

                                                                    <strong><?php echo e(__('app.scan_a_QRcode')); ?></strong></p>
                                                                <p><label><?php echo e(__('app.step_5')); ?>

                                                                        :</label> <?php echo e(__('app.then_scan_the_barcode_on')); ?>

                                                                </p>
                                                                <p><label><?php echo e(__('app.step_6')); ?>

                                                                        :</label> <?php echo e(__('app.enter_the_verification_code')); ?>

                                                                </p>
                                                                <hr>
                                                                <p><label><?php echo e(__('app.note')); ?>

                                                                        :</label> <?php echo e(__('app.to_diasable_2fa_enter')); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--=============Generate QRCode for Google 2FA Authentication=============-->
                                            <?php elseif(!auth()->user()->google2fa->google2fa_enable): ?>
                                                <!--=============Enable Google 2FA Authentication=============-->
                                                    <form class="form-horizontal" method="POST"
                                                          action="<?php echo e(route('enable-2fa')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="col-md-12"><p>
                                                                    <strong><?php echo e(__('app.scan_the_qrcode_with')); ?>

                                                                        <dfn><?php echo e(__('app.google_auth')); ?></dfn> <?php echo e(__('app.and_enter_the_generated_code_below')); ?>

                                                                    </strong></p></div>
                                                            <div class="col-md-12"><img src="<?php echo e($generated); ?>"/></div>
                                                            <div class="col-md-12">
                                                                <p><?php echo e(__('app.to_enable_2fa_auth_verify_qrcode')); ?></p>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="address"
                                                                       class="control-label"><?php echo e(__('app.verification_code')); ?></label>
                                                                <input type="text" name="code" class="form-control"
                                                                       id="code"
                                                                       placeholder="<?php echo e(__('app.enter_verification_code')); ?>">
                                                                <?php if($errors->has('code')): ?>
                                                                    <span class="invalid-feedback" role="alert">
                                              <strong><?php echo e($errors->first('code')); ?></strong>
                                            </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 mx-auto m-2">
                                                            <button type="submit"
                                                                    class="btn btn-primary col-sm-12"><?php echo e(__('app.enable_2fa')); ?></button>
                                                        </div>
                                                    </form>
                                                    <!--=============Enable Google 2FA Authentication=============-->
                                            <?php elseif(auth()->user()->google2fa->google2fa_enable): ?>
                                                <!--=============Disable Google 2FA Authentication=============-->
                                                    <form class="form-horizontal" method="POST"
                                                          action="<?php echo e(route('disable-2fa')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="col-md-12"><img src="<?php echo e($generated); ?>"/></div>
                                                            <div class="col-md-12">
                                                                <p><?php echo e(__('app.to_disable_2fa_auth_verify_qrcode')); ?></p>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="address"
                                                                       class="control-label"><?php echo e(__('app.verification_code')); ?></label>
                                                                <input type="text" name="code" class="form-control"
                                                                       id="code"
                                                                       placeholder="<?php echo e(__('app.enter_verification_code')); ?>">
                                                                <?php if($errors->has('code')): ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo e($errors->first('code')); ?></strong>
                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="address"
                                                                       class="control-label"><?php echo e(__('app.current_password')); ?></label>
                                                                <input id="password" type="password"
                                                                       placeholder="<?php echo e(__('Current Password')); ?>"
                                                                       class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                                       name="password" required>
                                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($error('password')); ?></strong>
                                                  </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 mx-auto m-2">
                                                            <button type="submit"
                                                                    class="btn btn-danger col-sm-12"><?php echo e(__('app.disable_2fa')); ?></button>
                                                        </div>
                                                    </form>
                                                    <!--=============Disable Google 2FA Authentication=============-->
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/users/profile/index.blade.php ENDPATH**/ ?>