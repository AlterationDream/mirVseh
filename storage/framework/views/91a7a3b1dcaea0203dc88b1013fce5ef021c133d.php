

<?php $__env->startSection('title','Article Create'); ?>
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
              <div class="col-md-12">
                  <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="card">
                      <div class="card-body">
                          <form class="" action="/article/<?php echo e($article->slug); ?>" method="post">
                                  <?php echo method_field("PUT"); ?>
                                  <?php echo csrf_field(); ?>
                                  <div class="form-group">
                                    <select class="form-control" name="category">
                                      <option><?php echo e('--Select Category--'); ?></option>
                                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(($category->id == $article->article_category_id)? 'selected':''); ?>><?php echo e(Str::title($category->name)); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <input type="text" name="title" value="<?php echo e($article->title); ?>" class="form-control" id="title" placeholder="<?php echo e(__('app.article_title')); ?>">
                                  </div>
                                  <div class="form-group">
                                    <textarea id="summernote" name="content"><?php echo e($article->content); ?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.update_article')); ?>">
                                  </div>
                            </form>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/premiumcontent/article/edit.blade.php ENDPATH**/ ?>