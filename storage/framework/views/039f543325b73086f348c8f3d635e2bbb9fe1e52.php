<?php $__env->startSection('title', 'Мир для Всех'); ?>

<?php $__env->startSection('content'); ?>

<article id="post-1">

    <div class="post-thumb">

    </div>

    <header class="entry-header">
        <h2 class="entry-title"><a href="%s" rel="bookmark">Ссылка</a></h2>
    </header>
    <!-- .entry-header -->

    <div class="entry-meta">
			<span class="author vcard"><i
                    class="fa fa-user"></i> Автор </span>
        <span class="categories-links"><i
                class="fa fa-folder"></i> Категории </span>
        <span class="comments-counts"><i
                class="fa fa-comment"></i>3 комментария</span>
    </div><!-- .entry-meta -->


    <div class="entry-content">
        Контент
    </div>
    <!-- .entry-content -->
    <div class="entry-footer">
        <div class="row middle">
            <div class="col-sm-12">
                <a class="read-more"
                   href=""><span>Далее</span></a>
            </div>
        </div>
    </div>

</article>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/frontend/home.blade.php ENDPATH**/ ?>