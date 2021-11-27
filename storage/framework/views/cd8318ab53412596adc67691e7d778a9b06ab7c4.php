

<?php $__env->startSection('title','Дерево папок'); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .folder-tree .list-item > * {
            display: inline-flex;
        }
        .folder-tree .list-item .action {
            float: right;
        }
        .folder-tree .list-item .date {
            float: right;
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: 13px;
        }
        .folder-tree .list-item .case {
            float: right;
            font-size: 16px;
            margin-top: 7px;
        }

        .folder-tree .list-item .title {
            font-size: 16px;
            cursor: pointer;
            padding: 6px 0 6px 6px;
        }
        .folder-tree .list-item:nth-of-type(odd) {
            background: rgba(0, 0, 0, .05);
        }
        .folder-tree .list-item:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, .075);
        }
        .folder-tree .list-item .title img {
            padding: 0 6px 0 0;
        }

        .sub {
            height: calc(100% + 12px);
            margin: -6px 13px -6px 0px;
            background-color: #4b5f83;
            width: 1px;
            display: inline-block;
        }
        .sub:first-child {
            margin-right: 13px;
        }
        .sub:last-child::after {
            content: "";
            width: 12px;
            height: 1px;
            background-color: #4b5f83;
            display: block;
            margin-top: 27px;
        }
        .sub:last-child {
            margin-right: 11px;
        }
        .list-item {
            position: relative;
            overflow-y: hidden;
        }
        .tree-branches {
            position: absolute;
            height: 100%;
        }
        .folder-tree .list-item .title span {
            margin-top: 3px;
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
                            <li class="breadcrumb-item active">Дерево папок</li>
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
                                        <h4>Дерево папок</h4>
                                    </div>
                                    <!--div class="col-md-12 mb-3">
                                        <a href="/folders/create" class="btn btn-primary"><?php echo e(__('app.new_folder')); ?></a>
                                    </div-->
                                    <div class="col-md-12">
                                        <div class="folder-tree">
                                            <!--class="table-responsive no-padding"-->
                                            <!--table id="dataTableTree" class="table table-hover table-striped table-borderless">
                                                <thead>
                                                <tr>
                                                    <th style="width: 38px;"></th>
                                                    <th class=""><?php echo e(__('app.title')); ?></th>
                                                    <th class="">Привязанное дело</th>
                                                    <th class="">Дата создания</th>
                                                    <th class="" style="width: 100px;"><?php echo e(__('app.action')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody-->

                                                <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="list-item level-0<?php if ($folder->isArchived == '1'): ?> archived<?php endif;?>" id="<?php echo e($folder->id); ?>" slug="<?php echo e($folder->slug); ?>">
                                                        <div class="title">
                                                            <div class="tree-branches"></div>
                                                            <img src="/uploads/avatar/folder.png" style="max-height: 32px" onclick="openClose(this.parentElement.parentElement, 'folder', <?php echo e($folder->id); ?>, '/')"><span onclick="openClose(this.parentElement.parentElement, <?php echo e($folder->id); ?>, '/')"><?php echo e($folder->title); ?></span>
                                                        </div>

                                                        <?php /*?><div class="action">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/folders/{{$folder->slug}}/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.edit')}}"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div>
                                                                        <a href="/folders/{{$folder->slug}}/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.remove_folder')}}"/><i class="fa fa-remove text-white"></i></button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="case"> @if($folder->business_case) Дело: <a href="cases/{{$folder->business_case->slug}}" class="list-title-link">{{ $folder->business_case->title }}</a> @endif </div> <?php */ ?>
                                                        <div class="date" data-sort="<?php echo e($folder->created_at->format('Y-m-d H:i:s')); ?>"><?php echo e($folder->created_at->format('d.m.Y в H:i')); ?></div>
                                                        <div style="clear: both; display: block"></div>
                                                    </div>


                                                    <?php /*?><tr <?php if ($folder->isArchived == '1'): ?>class="archived"<?php endif;?>>
                                                        <td><a href="folders/{{$folder->slug}}"><img src="/uploads/avatar/folder.png" style="max-height: 38px"></a></td>
                                                        <td><a href="folders/{{$folder->slug}}" class="list-title-link">{{ $folder->title }}</a></td>
                                                        <td @if(!$folder->business_case) data-sort="ι" @endif > @if($folder->business_case) <a href="cases/{{$folder->business_case->slug}}" class="list-title-link">{{ $folder->business_case->title }}</a> @endif </td>
                                                        <td data-sort="{{ $folder->created_at->format('Y-m-d H:i:s') }}">{{ $folder->created_at->format('d.m.Y в H:i') }}</td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="mx-1">
                                                                        <a href="/folders/{{$folder->slug}}/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.edit')}}"/><i class="fa fa-edit text-white"></i></button></a>
                                                                    </div>
                                                                    <div class="mx-1">
                                                                        <a href="/folders/{{$folder->slug}}/remove"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="{{__('app.remove_folder')}}"/><i class="fa fa-remove text-white"></i></button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
 <?php */ ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <!--/tbody>
                                            </table-->
                                        </div>
                                    </div>
                                </div>
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
    <!-- /.content-wrapper -->

    <?php echo csrf_field(); ?>

    <script>
        var order = 'title';
        var csrf = document.querySelectorAll('input[name="_token"]')[0].value;

        function openClose(elem, id, dir) {
            if (elem.classList.contains('open')) {
                removeChildren(elem);
                elem.classList.remove('open');
            }
            else {
                getSub(elem, id, dir);
            }
        }

        function getSub(elem, id, dir) {
            $.ajax({
                type: "POST",
                url: "/folder-tree",
                dataType: 'html',
                data: {
                    '_token' : csrf,
                    'id' : id,
                    'dir' : dir,
                    'order' : order
                },
                cache: false,
                success: function (response)
                {
                    var resp = JSON.parse(response);
                    if ('status' in resp) {
                        console.log(resp);
                        if (resp['status'] == 'success') insertChildren(elem, resp['files'], resp['count']);
                        else console.log(resp);
                    } else {
                        console.log(response);
                    }
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

        function insertChildren(clicked, children, empt) {
            let level = parseInt(clicked.classList[1].slice(6));
            let offset = (level * 14) + 27;

            if (empt) {
                console.log(children);
                let keys = Object.keys(children);
                for (let i = keys.length - 1; i >= 0; i--) {
                    let item = document.createElement('div');
                    item.className = 'list-item level-' + (level + 1);
                    item.id = children[keys[i]]['id'];
                    item.style.paddingLeft = offset + 'px';

                    let branches = document.createElement('div');
                    branches.className = 'tree-branches';
                    branches.style.marginLeft = '-' + (offset - 21) + 'px';
                    for (let j = 0; j <= level; j++) {
                        let branch = document.createElement('div');
                        branch.className = 'sub';
                        branches.appendChild(branch);
                    }

                    let title = document.createElement('div');
                    title.className = 'title';

                    let img = document.createElement('img');
                    let span = document.createElement('span');
                    if (children[keys[i]]['type'] == 'folder') {
                        let dir = '/';
                        if (children[keys[i]]['dir'] == '/') dir +=  children[keys[i]]['id'];
                        else dir = children[keys[i]]['dir'] + '/' + children[keys[i]]['id'];

                        img.src = '/uploads/avatar/folder.png';
                        img.setAttribute('onclick', 'openClose(this.parentElement.parentElement, ' +
                            children[keys[i]]['folder_id'] + ', \'' +
                            dir + '\')');
                        span.setAttribute('onclick', img.getAttribute('onclick'));
                        span.innerText = children[keys[i]]['title'];
                    } else {
                        img.src = '/uploads/avatar/file.png';
                        let link = '/folders/' + document.getElementById(children[keys[i]]['folder_id']).getAttribute('slug');

                        if (children[keys[i]]['dir'] == '/') link += '/' + children[keys[i]]['id'];
                        else link += children[keys[i]]['dir'] + '/' + children[keys[i]]['id'];

                        img.setAttribute('onclick', 'window.open(\'' + link + '\',\'_blank\').focus();');
                        span.setAttribute('onclick', img.getAttribute('onclick'));
                        span.innerText = children[keys[i]]['title'] + children[keys[i]]['extension'];
                    }
                    img.style.maxHeight = '32px';

                    title.appendChild(img);
                    title.appendChild(span);

                    let d = new Date(children[keys[i]]['created_at']);
                    let day = d.getDate();
                    let month = d.getMonth();
                    let year = d.getFullYear();
                    let hour = d.getHours();
                    let minute = d.getMinutes();
                    let second = d.getSeconds();
                    if (day < 10) day = '0' + dt;
                    if (month < 10) month = '0' + month;
                    if (hour < 10) hour = '0' + hour;
                    if (minute < 10) minute = '0' + minute;
                    if (second < 10) second = '0' + second;

                    let date = document.createElement('div');
                    date.className = 'date';
                    date.setAttribute('data-sort', year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second);
                    date.innerText = day + '.' + month + '.' + year + ' в ' + hour + ':' + minute;

                    let clr = document.createElement('div');
                    clr.style.clear = 'both';
                    clr.style.display = 'block';

                    item.appendChild(branches);
                    item.appendChild(title);
                    item.appendChild(date);
                    item.appendChild(clr);
                    insertAfter(item,clicked);
                    clicked.classList.add('open');
                }
            } else {
                let item = document.createElement('div');
                item.className = 'list-item level-' + (level + 1);
                item.style.paddingLeft = offset + 'px';

                let branches = document.createElement('div');
                branches.className = 'tree-branches';
                branches.style.marginLeft = '-' + (offset - 21) + 'px';
                for (let j = 0; j <= level; j++) {
                    let branch = document.createElement('div');
                    branch.className = 'sub';
                    branches.appendChild(branch);
                }

                let title = document.createElement('div');
                title.className = 'title';

                let img = document.createElement('img');
                img.style.height = '32px';

                let span = document.createElement('span');
                span.innerText = 'Папка пуста';
                span.style.cursor = 'default';
                span.style.marginLeft = '5px';

                title.appendChild(span);
                title.appendChild(img);

                let clr = document.createElement('div');
                clr.style.clear = 'both';
                clr.style.display = 'block';

                item.appendChild(branches);
                item.appendChild(title);
                item.appendChild(clr);
                insertAfter(item,clicked);

                clicked.classList.add('open');
            }
        }

        function removeChildren(elem) {
            let level = elem.classList[1].slice(6);
            let cont = elem.parentElement;
            while (elem.nextElementSibling != null) {
                console.log(elem.nextElementSibling.classList[1].slice(6));
                if (elem.nextElementSibling.classList[1].slice(6) != level + 1) break;
                elem.nextElementSibling.remove();
            }
        }

        function insertAfter(newNode, referenceNode) {
            referenceNode.parentElement.insertBefore(newNode, referenceNode.nextElementSibling);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/folder-tree/index.blade.php ENDPATH**/ ?>