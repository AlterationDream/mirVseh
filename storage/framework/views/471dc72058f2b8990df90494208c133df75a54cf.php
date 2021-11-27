

<?php $__env->startSection('title','Article'); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo e(__('app.article')); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="/article"><?php echo e(__('app.article')); ?></a></li>
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
        <div class="col-md-12">
          <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <a href="article/create" class="pull-right btn btn-primary"><?php echo e(__('app.create_article')); ?></a>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive no-padding ">
                <table id="dataTable" class="table table-borderless table-striped table-hover">
                <thead>
                  <tr>
                    <th class=""><?php echo e(__('app.title')); ?></th>
                    <th class=""><?php echo e(__('app.created_at')); ?></th>
                    <th class=""><?php echo e(__('app.updated_at')); ?></th>
                    <th class=""><?php echo e(__('app.action')); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(Str::limit($article->title,80,'(...)')); ?></td>
                    <td><?php echo e(date('M d, Y',strtotime($article->created_at))); ?></td>
                    <td><?php echo e(date('M d, Y',strtotime($article->updated_at))); ?></td>
                    <td>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="mx-1">
                            <a href="/article/<?php echo e($article->slug); ?>"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.view_article')); ?>"/><i class="fa fa-eye text-white"></i></button></a>
                          </div>
                          <div class="mx-1">
                            <a href="/article/<?php echo e($article->slug); ?>/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.edit_article')); ?>"/><i class="fa fa-edit text-white"></i></button></a>
                          </div>
                          <div class="mx-1">
                            <form action="/article/<?php echo e($article->slug); ?>" method="POST">
                              <?php echo method_field('DELETE'); ?>
                              <?php echo csrf_field(); ?>
                              <button class="btn btn-danger" data-toggle="tooltip"  data-placement="bottom" title="<?php echo e(__('app.delete_article')); ?>"/><i class='fa fa-trash text-white'></i></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                </table>
              </div>
                </div>
              </div>
            </div>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/premiumcontent/article/index.blade.php ENDPATH**/ ?>