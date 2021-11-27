<?php $__env->startSection('title','Редактирование профиля'); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3><?php echo e(($user->fullname)? $user->fullname:$user->username); ?></h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/user"><?php echo e(__('app.users')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('app.edit')); ?></li>
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
                                    <div class="col-md-12">
                                        <img class="img profile-user-img img-responsive img-circle" width="40px"
                                             height="100px"
                                             src="<?php echo e(($user->avatar)? $user->avatar: asset('uploads/avatar/avatar.png')); ?>"
                                             alt="User profile picture">
                                        <h5 class="mt-3 mb-0"><b><?php echo e($user->fullname); ?></b></h5>
                                        <p><?php echo e($user->email); ?></p>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="mt-2 mb-0 d-block">
                                            <p><b>Роль:</b>
                                                <?php echo e(($user_role)? ucfirst($user_role->name): 'Нет роли'); ?>

                                            </p>
                                        </span>
                                        <span class="mt-0 d-block">
                                            <p><b>Дата последнего входа:</b>
                                                <?php echo e(empty($user->last_login_at)? 'Не входил': ($user->last_login_at)->diffForHumans()); ?>

                                            </p>
                                        </span>
                                        <span class="mt-0 d-block">
                                            <p><b><?php echo e(__('app.joined')); ?>:</b>
                                                <?php echo e($user->created_at); ?>

                                            </p>
                                        </span>
                                        <span class="mt-0 d-block">
                                            <p><b>Статус:</b>
                                                <?php if($user->status == 'active'): ?>
                                                    <span class="badge badge-success badge-md">Активный</span>
                                                <?php elseif($user->status == 'banned'): ?>
                                                    <span class="badge badge-danger badge-md">Заблокирован</span>
                                                <?php endif; ?>
                                            </p>
                                        </span>
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
                                    <li class="nav-item shadow mb-3 mr-2">
                                        <a class="nav-link" id="activiylog-details-tab" data-toggle="tab"
                                           href="#activiylog-details" role="tab" aria-controls="activiylog-details"
                                           aria-selected="false"><?php echo e(__('app.activity_logs')); ?></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content mt-3">
                                    <div class="tab-pane active" id="account-details" role="tabpanel"
                                         aria-labelledby="account-details-tab">
                                        <form class="form-horizontal" method="POST"
                                              action="<?php echo e(route('user.update',$user->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('put'); ?>
                                            <div class="row form-group">
                                                <div class="col-md-6 mt-1">
                                                    <label for="mobile"><?php echo e(__('app.role')); ?></label>
                                                    <select name="role" class="form-control form-control-inline-block">
                                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($role->name); ?>" <?php echo e(((($user_role)? $user_role->name:'') == $role->name)? 'selected':''); ?>><?php echo e(str_replace('-', ' ', $role->name)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($errors->has('role')): ?>
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('role')); ?></strong>
                                                </span>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label for="mobile"><?php echo e(__('app.status')); ?></label>
                                                    <select name="status"
                                                            class="form-control form-control-inline-block">
                                                        <option
                                                            value="active" <?php echo e(($user->status == 'active')? 'selected':''); ?>>
                                                            Активен
                                                        </option>
                                                        <option
                                                            value="banned" <?php echo e(($user->status == 'banned')? 'selected':''); ?>>
                                                            Заблокирован
                                                        </option>
                                                        <?php if($errors->has('status')): ?>
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('status')); ?></strong>
                                                </span>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-1 mt-1">
                                                    <div><label class="label-block"><?php echo e(__('app.fullname')); ?></label></div>
                                                    <input type="text" name="fullname" value="<?php echo e($user->fullname); ?>"
                                                           class="form-control" placeholder="<?php echo e(__('app.fullname')); ?>">
                                                    <?php if($errors->has('fullname')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('fullname')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div id="birthday" class="col-sm-6 mb-1 mt-1">
                                                    <label for="name"><?php echo e(__('app.birthday')); ?></label>
                                                    <input type="text" name="birthday" value="<?php echo e($user->birthday); ?>"
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
                                                <div class="col-md-6 mt-1">
                                                    <div><label class="label-block"><?php echo e(__('app.phone')); ?></label></div>
                                                    <input type="text" name="phone" value="<?php echo e($user->phone); ?>"
                                                           class="form-control" placeholder="<?php echo e(__('app.phone')); ?>">
                                                    <?php if($errors->has('phone')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo e($errors->first('phone')); ?></strong>
                                              </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label for="mobile"><?php echo e(__('app.country')); ?></label>
                                                    <input type="text" name="country" value="<?php echo e($user->country); ?>"
                                                           class="form-control" placeholder="<?php echo e(__('app.country')); ?>">
                                                    <?php if($errors->has('country')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('country')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="col-sm-12 mt-1">
                                                    <label for="address"
                                                           class="control-label"><?php echo e(__('app.address')); ?></label>
                                                    <input type="text" name="address" class="form-control"
                                                           value="<?php echo e($user->address); ?>" id="address"
                                                           placeholder="<?php echo e(__('app.address')); ?>">
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
                                              action="<?php echo e(route('user-login',$user->id)); ?>">
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
                                    <div class="tab-pane" id="activiylog-details" role="tabpanel"
                                         aria-labelledby="activiylog-details-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="/user/<?php echo e($user->id); ?>/activity-log/"
                                                   class="btn btn-outline-secondary pull-right"><?php echo e(__('app.view_all')); ?></a>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="table-responsive no-padding">
                                                    <table class="table table-hover table-striped table-borderless">
                                                        <thead>
                                                        <tr>
                                                            <th class=""><?php echo e(__('app.activity_log_description')); ?></th>
                                                            <th class=""><?php echo e(__('app.created_at')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if(count($activities) > 0): ?>
                                                            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e($activity->description); ?></td>
                                                                    <td><?php echo e(date('Y-m-d h:i',strtotime($activity->created_at))); ?></td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="2"><i><h5
                                                                            class="text-muted text-center"><?php echo e(__('app.no_record')); ?></h5>
                                                                    </i></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/users/admin/edit.blade.php ENDPATH**/ ?>