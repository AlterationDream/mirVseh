<?php $__env->startSection('title','Редактирование дела - ' . $businessCase->title); ?>
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
                            <li class="breadcrumb-item"><a href="/cases"><?php echo e(__('app.business_cases')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases/<?php echo e($businessCase->slug); ?>"><?php echo e($businessCase->title); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('app.edit')); ?></li>
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
                                <h3 class="card-title"><?php echo e($businessCase->title); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/cases/<?php echo e($businessCase->slug); ?>/edit" method="POST" class="form-horizontal" id="business-case-create">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md-auto croppie-form">
                                                <div id="avatar-holder" class="col-md-12 row">
                                                    <img id="avatar-img" width="40px" height="100px" class="img profile-user-img img-responsive img-circle" src="/<?php echo e($businessCase->image); ?>" alt="Изображение дела">
                                                    <label class="btn btn-secondary btn-lg d-block mx-auto mt-5 col-sm-12 mb-0" for="upload">
                                                        Обновить изображение
                                                        <input type="file" id="upload" name="image-upload" class="d-none">
                                                        <input type="hidden" name="image_changed" value="0" id="image_changed">
                                                    </label>
                                                </div>

                                                <div id="upload-demo" style="width:300px; height: unset; display: none"></div>
                                                <label class="btn btn-secondary btn-lg mx-auto mt-5 col-sm-12 mb-0" id='cancel-upload' onclick="cancelUpload()" style="display:none">Отменить</label>
                                                <input type="hidden" id="hidden-upload" name="image">
                                            </div>

                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('app.business_case_title')); ?>" value="<?php if ( !old('title') ) echo $businessCase->title; else echo old('title'); ?>">
                                                <label for="users" class="mt-2 ml-1"><?php echo e(__('app.business_case_participants')); ?>:</label><br>
                                                <div id="user-select"></div>
                                                <label for="folder" class="mt-2 ml-1"><?php echo e(__('app.select_folder')); ?>:</label>
                                                <select name="folder" id="folder-select" class="form-control">
                                                    <?php if(count($folders) > 0 || $folder): ?>
                                                        <option <?php if (!$folder):?>selected<?php endif; ?> value="0">Не привязывать папку</option>
                                                        <?php if ($folder): ?>
                                                            <option value="<?php echo e($folder->id); ?>" selected><?php echo e($folder->title); ?></option>
                                                        <?php endif;?>
                                                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($fol->id); ?>"><?php echo e($fol->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option selected hidden value="0">Нет свободных папок</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.update_business_case')); ?>">
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
        userSelectOptions = [
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                { label: '<?php echo e($user->fullname); ?>', value: '<?php echo e($user->id); ?>'},
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        VirtualSelect.init({
            ele: '#user-select',
            options: userSelectOptions,
            multiple: true,
            search: true,
            name: 'users',
            disableSelectAll: true,
            noOptionsText: 'Пользователей не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: [<?php echo ( !old('users') ) ? $userIDs : old('users'); ?>],
            clearButtonText: 'очистить',
            noOfDisplayValues: 0,
        });
    </script>

    <script type="text/javascript">

        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload').on('change', function () {
            console.log( $('#upload').val() );

            if ( $('#upload').val() != '' ) {
                $('#upload-demo').show();
                $('#avatar-holder').hide();
                $("#cancel-upload").show();
                $("#image_changed").val(1);
            } else {
                $('#upload-demo').hide();
                $('#avatar-holder').show();
                $("#cancel-upload").hide();
                $("#image_changed").val(0);
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#business-case-create').submit(function() {
            if ( $('#upload').val() != '' ) {
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    size: 'viewport'
                }).then(function (resp) {
                    $('#hidden-upload').val(resp);
                });
            }
            return true;
        });

        function cancelUpload() {
            $('#upload').val('');
            $('#upload').change();
        }
    </script>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/business-case/edit.blade.php ENDPATH**/ ?>