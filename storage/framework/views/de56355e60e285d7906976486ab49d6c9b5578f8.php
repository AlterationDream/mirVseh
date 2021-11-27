<?php $baseLink = ($folder->business_case) ?
    '/cases/' . $folder->business_case->slug . '/folder/'
    :
    '/folders/' . $folder->slug . '/'; ?>

<?php $__env->startSection('title','Новый файл/папка'); ?>
<?php $__env->startSection('style'); ?>
    <!--link rel="stylesheet" type="text/css"  href="<?php echo e(asset('assets/css/articleStyle.css')); ?>"></link-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <?php if($folder->business_case): ?>
                                <li class="breadcrumb-item"><a href="/cases"><?php echo e(__('app.business_cases')); ?></a></li>
                                <li class="breadcrumb-item"><a href="/cases/<?php echo e($folder->business_case->slug); ?>"><?php echo e($folder->business_case->title); ?></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e($baseLink); ?>">Папка дела</a></li>
                            <?php else: ?>
                                <li class="breadcrumb-item"><a href="/folders"><?php echo e(__('app.folders')); ?></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e($baseLink); ?>"><?php echo e($folder->title); ?></a></li>
                            <?php endif; ?>

                            <?php
                            $link = substr($baseLink, 0, -1);
                            if ($subfolders) {
                                foreach ($subfolders as $key => $sub) {
                                    $link .= '/' . $sub->id;
                                    echo '<li class="breadcrumb-item"><a href="' . $link . '">' . $sub->title . '</a></li>';
                                }
                            } ?>
                            <li class="breadcrumb-item active">Новый файл/папка</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fliud">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Новый файл/папка</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="<?php echo e($link); ?>/create" method="POST" class="form-horizontal" id="folder-create" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md">
                                                <select name="type" id="type" class="form-control mb-2" style="width: auto">
                                                    <option value="folder">Папка</option>
                                                    <option value="file">Файл</option>
                                                </select>
                                                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('app.folder_title')); ?>" value="<?php echo e(old('title')); ?>">
                                                <div id="file-upload-div" style="display: none">
                                                    <div style="display: block" class="mb-1 file-cont">
                                                        <input type="text" name="filename[]" placeholder="Название файла" class="form-control" style="display: inline-block; width: auto; margin-right:12px;">
                                                        <input type="file" name="file[]">
                                                        <button class="file-input-button" onclick="event.preventDefault(); appendFileInput(this.parentElement.parentElement);" style="margin-left: -4px;">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" id="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.publish_folder')); ?>">
                                        </div>
                                    </form>
                                </article>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <script>
        function updateForm() {
            if ($('#type').val() == 'folder') {
                $('#title').show();
                $('#file-upload-div').hide();
                $('#submit').val('Создать новую папку');
            } else {
                $('#title').hide();
                $('#file-upload-div').show();
                $('#submit').val('Загрузить файл(ы)');
            }
        }
        $('#type').on('change', updateForm);
        $(document).ready(updateForm);

        function appendFileInput(elem) {
            let childDiv = document.createElement("div");
            childDiv.className = 'mb-1 file-cont';
            let childTitle = document.createElement("input");
            childTitle.type = 'text';
            childTitle.name = 'filename[]';
            childTitle.className = 'form-control';
            childTitle.placeholder = 'Название файла';
            childTitle.style = 'display: inline-block; width: auto; margin-right:16px';
            childDiv.appendChild(childTitle);
            let childInput = document.createElement("input");
            childInput.type = 'file';
            childInput.name = 'file[]';
            childDiv.appendChild(childInput);
            let childRemove = document.createElement("button");
            childRemove.className = 'file-input-button';
            childRemove.innerText = '-';
            childRemove.onclick = function() {event.preventDefault(); removeFileInput(this);};
            childDiv.appendChild(childRemove);
            let fileContainer = document.getElementById('file-upload-div');
            fileContainer.appendChild(childDiv, elem);
        }

        function removeFileInput(elem) {
            document.getElementById('file-upload-div').removeChild(elem.parentNode);
        }
    </script>

    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/file/create.blade.php ENDPATH**/ ?>