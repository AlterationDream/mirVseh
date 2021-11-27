<?php $__env->startSection('title','Создать пользователя'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?php echo e(__('app.users')); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('user.index')); ?>"><?php echo e(__('app.users')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('app.create')); ?></li>
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
                        <form class="form-horizontal" method="POST" action="/user">
                        <?php echo csrf_field(); ?>
                        <!-- Contact Details -->
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <h5><?php echo e(__('app.contact_details')); ?></h5>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                            <div class="form-row mb-2">
                                                <div class="col-sm-12">
                                                    <label for="name"><?php echo e(__('app.fullname')); ?></label>
                                                    <input type="text" name="fullname" value="<?php echo e(old('fullname')); ?>"
                                                           placeholder="<?php echo e(__('app.fullname')); ?>" class="form-control"
                                                           id="fullname">
                                                    <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" role="alert">
                                              <strong><?php echo e($message); ?></strong>
                                          </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="form-row mb-2">
                                                <div id="birthday" class="col-sm-6">
                                                    <label for="name"><?php echo e(__('app.birthday')); ?></label>
                                                    <input type="text" name="birthday" value="<?php echo e(old('birthday')); ?>"
                                                           placeholder="<?php echo e(__('app.birthday')); ?>" class="form-control">
                                                    <?php $__errorArgs = ['birthday'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" role="alert">
                                              <strong><?php echo e($message); ?></strong>
                                          </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div><label class="label-block"><?php echo e(__('app.phone')); ?></label></div>
                                                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                                                           class="form-control col-md-12"
                                                           placeholder="<?php echo e(__('app.phone')); ?>">
                                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger d-block" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                      </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="form-row mb-2">
                                                <div class="col-sm-6">
                                                    <label for="address"
                                                           class="control-label"><?php echo e(__('app.address')); ?></label>
                                                    <input type="text" name="address" class="form-control"
                                                           value="<?php echo e(old('address')); ?>" id="address"
                                                           placeholder="<?php echo e(__('app.address')); ?>">
                                                    <?php if($errors->has('address')): ?>
                                                        <span class="text-danger" role="alert">
                                      <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="country"><?php echo e(__('app.country')); ?></label>
                                                    <input type="text" name="country" class="form-control"
                                                           value="<?php echo e(old('country')); ?>" id="country"
                                                           placeholder="<?php echo e(__('app.country')); ?>">
                                                    <?php if($errors->has('country')): ?>
                                                        <span class="text-danger" role="alert">
                                      <strong><?php echo e($errors->first('country')); ?></strong>
                                    </span>
                                                <?php endif; ?>
                                                    <!--select name="country" value="<?php echo e(old('country')); ?>"
                                                            class="form-control col-md-12">
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($country); ?>"><?php echo e($country); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($errors->has('country')): ?>
                                                            <span class="text-danger" role="alert">
                                              <strong><?php echo e($errors->first('country')); ?></strong>
                                          </span>
                                                        <?php endif; ?>
                                                    </select-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- Contact Details -->
                            <!-- Account Details -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <h5><?php echo e(__('app.login_details')); ?></h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-row mb-2">
                                                <div class="col-sm-6">
                                                    <label><?php echo e(__('app.role')); ?></label>
                                                    <select name="role" class="form-control">
                                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($role->name); ?>"><?php echo e(ucfirst($role->name)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row mb-2">
                                                <div class="col-sm-6">
                                                    <label for="email" class="control-label"><?php echo e(__('app.email')); ?></label>
                                                    <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                                                           class="form-control" id="email"
                                                           placeholder="<?php echo e(__('app.email')); ?>">
                                                    <?php if($errors->has('email')): ?>
                                                        <span class="text-danger" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="username"
                                                           class="control-label"><?php echo e(__('app.username')); ?></label>
                                                    <input type="text" name="username" value="<?php echo e(old('username')); ?>"
                                                           class="form-control" id="username"
                                                           placeholder="<?php echo e(__('app.username')); ?>">
                                                    <?php if($errors->has('username')): ?>
                                                        <span class="text-danger" role="alert">
                                                    <strong><?php echo e($errors->first('username')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-row mb-2">
                                                <div class="col-sm-6">
                                                    <label for="password"
                                                           class="control-label"><?php echo e(__('app.password')); ?></label>
                                                    <input type="password" name="password" class="form-control"
                                                           id="password" placeholder="<?php echo e(__('app.password')); ?>">
                                                    <?php if($errors->has('password')): ?>
                                                        <span class="text-danger" role="alert">
                                                  <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="password_confirmation"
                                                           class="control-label"><?php echo e(__('app.confirm_password')); ?></label>
                                                    <input type="password" name="password_confirmation"
                                                           class="form-control" id="password_confirmation"
                                                           placeholder="<?php echo e(__('app.confirm_password')); ?>">
                                                    <?php if($errors->has('password_confirmation')): ?>
                                                        <span class="text-danger" role="alert">
                                                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                              </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mx-auto mt-4">
                                        <button type="submit"
                                                class="btn btn-primary col-md-12"><?php echo e(__('app.create_user')); ?></button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- Account Details -->
                        </form>
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/users/admin/create.blade.php ENDPATH**/ ?>