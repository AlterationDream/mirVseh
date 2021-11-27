

<?php $__env->startSection('title','Article Category Create'); ?>
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
                <li class="breadcrumb-item"><a href="/category-article"><?php echo e(__('app.article_category')); ?></a></li>
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
          <div class="col-md-7 mx-auto">
            <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                  <form class="" action="/category-article" method="post">
                          <?php echo csrf_field(); ?>
                          <div class="form-group">
                            <input type="text" name="name" class="form-control" id="title" placeholder="<?php echo e(__('app.category_name')); ?>">
                          </div>
                          <div class="form-group">
                            <textarea name="description" class="form-control textarea-resize-none" id="description" rows="3" placeholder="<?php echo e(__('app.category_description')); ?>"></textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.create_category')); ?>">
                          </div>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/premiumcontent/articleCategory/create.blade.php.php ENDPATH**/ ?>
