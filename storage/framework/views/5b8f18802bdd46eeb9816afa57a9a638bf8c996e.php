
<?php $__env->startSection('title','Users'); ?>
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
              <li class="breadcrumb-item active"><?php echo e(__('app.view')); ?></li>
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
                  <div class="card">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <a href="<?php echo e(route('user.create')); ?>" class="pull-right btn btn-primary"><?php echo e(__('app.create_user')); ?></a>
                        </div>
                        <div class="col-md-4 mb-2">
                          <form class="form" action="" method="GET">
                            <div class="input-group">
                               <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>" class="form-control" placeholder="<?php echo e(__('app.search')); ?>">
                               <?php if(request()->input('search') && request()->input('search')!= ''): ?>
                                 <div class="input-group-append">
                                   <a class="btn btn-outline-secondary" href="<?php echo e(route('user.index')); ?>" type="submit"><i class="fa fa-close"></i></a>
                                 </div>
                               <?php endif; ?>
                               <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search text-muted"></i></button>
                               </div>
                            </div>
                          </form>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  				  <table id="" class="table table-hover table-borderless table-striped" >
                              <thead>
                      					<tr>
                                  <th><?php echo e(__('app.id')); ?></th>
                                  <th><?php echo e(__('app.picture')); ?></th>
                      					  <th><?php echo e(__('app.fullname')); ?></th>
                      					  <th><?php echo e(__('app.username')); ?></th>
                      					  <th><?php echo e(__('app.email')); ?></th>
                      					  <th><?php echo e(__('app.status')); ?></th>
                      					  <th><?php echo e(__('app.created_at')); ?></th>
                      					  <th><?php echo e(__('app.action')); ?></th>
                      					</tr>
                              </thead>
                              <tbody>
                                <?php if(count($users)): ?>
                        					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        					<tr>
                                    <td><?php echo e($user->id); ?></td>
                                    <td><img class="img-fluid rounded-circle" width="40px" src="<?php echo e(($user->avatar)? $user->avatar : asset('uploads/avatar/avatar.png')); ?>" alt="icon"></td>
                        						<td><a href="<?php echo e(route('user.edit',$user->id)); ?>"><?php echo e($user->fullname); ?></a></td>
                        						<td><?php echo e($user->username); ?></td>
                        						<td><?php echo e($user->email); ?></td>
                        						<td>
                                        <?php if($user->status=='active'): ?>
                                          <span class="badge badge-success">Активен</span>
                                        <?php elseif($user->status=='banned'): ?>
                                          <span class="badge badge-danger">Заблокирован</span>
                                        <?php endif; ?>
                                    </td>
                        						<td><?php echo e($user->created_at); ?></td>
                        						<td>
                                        <div class="d-inline-block">
                                          <div class="dropdown">
                                            <?php if($user->username != 'admin'): ?>
                                            <?php if (can_be_impersonated($user, )) : ?>
                                            <a href="<?php echo e(route('impersonate',$user->id)); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="<?php echo e(__('app.impersonate_user')); ?>"><i class="fa text-white fa-user-secret"></i></a>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                          </div>
                                        </div>
                                        <div class="d-inline-block">
                                          <a href="<?php echo e(route('user.edit',$user->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit_user')); ?>"></i></a>
                                        </div>
                                        <div class="d-inline-block">
                                          <?php if($user->username != 'admin'): ?>
                                          <form action="<?php echo e(route('user.destroy',$user->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUser<?php echo e($user->id); ?>"><i class='fa fa-trash'></i></button>
                                            <div class="modal fade" id="deleteUser<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-body text-center">
                                                  <h3 class="mb-4"><?php echo e(__('app.please_confirm')); ?></h3>
                                                  <p class="mb-5"><?php echo e(__('app.delete_user_confirm')); ?></p>
                                                  <button type="button" class="btn btn-secondary col-md-5 pull-left" data-dismiss="modal"><?php echo e(__('app.close')); ?></button>
                                                  <button type="submit" class="btn btn-danger col-md-6 pull-right"><?php echo e(__('app.delete')); ?></button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          </form>
                                          <?php endif; ?>
                                        </div>
                                      <!-- </div> -->
                        						 </td>
                        					</tr>
                        					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                  <td colspan="7" class="text-center">
                                    <p><i><?php echo e(__('app.no_record')); ?></i></p>
                                  </td>
                                </tr>
                                <?php endif; ?>
                              </tbody>
                  				  </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mt-2">
                    <?php echo e($users->links()); ?>

                  </div>
                  <!-- /.card -->

             </div>
          </div>
       </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DORO\Documents\My Project\LaraSwift\PACKAGE FOR SALE\LaraSwift v8\Laraswift-Payment-Envato\resources\views/users/admin/index.blade.php ENDPATH**/ ?>
