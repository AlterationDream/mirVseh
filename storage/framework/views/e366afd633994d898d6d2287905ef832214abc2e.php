<?php $__env->startSection('title','Новое дело'); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .dropstyle {
            padding: 4px 0;
        }

        .dropstyle li a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .dropstyle li a:hover {
            color: #262626;
            text-decoration: none;
            background-color: #f5f5f5;
        }
    </style>
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
                            <li class="breadcrumb-item active"><?php echo e(__('app.new_business_case')); ?></li>
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
                                <h3 class="card-title"><?php echo e(__('app.new_business_case')); ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <article class="">
                                    <form action="/cases" method="POST" class="form-horizontal" id="business-case-create">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group col-md-auto croppie-form">
                                                <div id="upload-demo" style="width:300px; height: unset"></div>
                                                <input type="file" id="upload" name="image-upload">
                                                <input type="hidden" id="hidden-upload" name="image">
                                            </div>

                                            <div class="form-group col-md">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('app.business_case_title')); ?>" value="<?php echo e(old('title')); ?>">
                                                <label for="users" class="mt-2 ml-1"><?php echo e(__('app.business_case_participants')); ?>:</label><br>
                                                <div id="user-select"></div>
                                                <div class="dropdown mt-3 mb-1">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Добавить группу пользователей
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu dropstyle">
                                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $IDs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><a href="#" onclick="setUsers('<?php
                                                                $arrayKeys = array_keys($IDs);
                                                                $lastKey = end($arrayKeys);
                                                                foreach ($IDs as $key => $ID) {
                                                                    if ($key == $lastKey) {
                                                                        echo $ID;
                                                                    } else {
                                                                        echo $ID . ', ';
                                                                    }
                                                                }
                                                                ?>')"><?php echo e($name); ?></a></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                                <label for="folder" class="mt-2 ml-1"><?php echo e(__('app.select_folder')); ?>:</label>
                                                <select name="folder" id="folder-select" class="form-control">
                                                    <?php if(count($folders) > 0): ?>
                                                        <option selected hidden value="0">Выберите папку</option>
                                                        <option value="0">Не привязывать папку</option>
                                                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($folder->id); ?>"><?php echo e($folder->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option selected disabled hidden value="0">Нет свободных папок</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="<?php echo e(__('app.publish_business_case')); ?>">
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
        function setUsers(ids) {
            let setIDs = ids.split(', ');
            let curIDs = document.getElementById('user-select').value;

            for(let i = 0; i < setIDs.length; i++) {
                if (curIDs.indexOf(setIDs[i]) === -1) curIDs.push(setIDs[i]);
            }
            document.getElementById('user-select').setValue(curIDs);
        }
    </script>

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
            placeholder: 'Выберите пользователей',
            disableSelectAll: true,
            noOptionsText: 'Пользователей не найдено',
            noSearchResultsTex: 'Результатов не найдено',
            searchPlaceholderText: 'Поиск...',
            selectedValue: <?php
                echo ( !old('users') ) ?
                    '\'' . Auth::user()->id . '\''
                :
                    '[' . old('users') . ']'; ?>,
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

    </script>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/business-case/create.blade.php ENDPATH**/ ?>