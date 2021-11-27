<nav class="main-header navbar navbar-expand navbar-<?php echo e(setting('app_theme')); ?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link desktop-toggle" id="toggleClose" data-widget="pushmenu" href="#"><i
                    class="fa fa-bars"></i></a>
            <a class="nav-link mobile-toggle" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Просмотр-пользователей')): ?>
    <!-- SEARCH FORM -->
    <div class="d-none d-md-block d-lg-block d-xl-block">
        <form method="GET" action="/user" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" name="search" placeholder="Найти пользователей"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <?php if (is_impersonating()) : ?>
        <li class="nav-item">
            <a class="nav-link text-danger btn btn-none" href="<?php echo e(route('impersonate.leave')); ?>">
                <p><i class="fa fa-ban mr-2" aria-hidden="true"></i>Выйти из режима другого пользователя</p>
            </a>
        </li>
        <?php endif; ?>
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="<?php echo e(Auth::user()->avatar?Auth::user()->avatar:asset('uploads/avatar/avatar.png')); ?>" width="28px"
                     class="img img-circle  img-responsive" alt="User Image">
                <?php echo e(auth()->user()->fullname); ?>

                <i class="fa fa-angle-down right"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>

                <div class="dropdown-divider"></div>
                <a href="/profile" class="dropdown-item">
                    <i class="fa fa-user mr-2"></i> <?php echo e(__('app.profile')); ?>

                </a>

                <a href="/activity-log" class="dropdown-item">
                    <i class="fa fa-list mr-2"></i> <?php echo e(__('app.activity_log')); ?>

                </a>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-настройками-сайта')): ?>
                <a href="/settings" class="dropdown-item">
                    <i class="fa fa-gear mr-2"></i> <?php echo e(__('app.application_settings')); ?>

                </a>
                <?php endif; ?>

                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item dropdown-footer bg-gray"><i
                        class="fa fa-sign-out mr-2"></i> <?php echo e(__('app.logout')); ?></a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-<?php echo e(setting('app_sidebar')); ?>-light elevation-4">
    <!-- Brand Logo -->
    <div class="navbar-brand d-flex justify-content-center">
        <a class="nav-link toggleopen display-none" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        <a href="/" class="app-logo brand-link">
            <?php if(setting('app_dark_logo')||setting('app_light_logo')): ?>
                <img
                    src="<?php echo e((setting('app_sidebar')=='light')? asset('uploads/appLogo/app-logo-dark.png'):asset('uploads/appLogo/app-logo-light.png')); ?>"
                    alt="App Logo" class=" img brand-image img-responsive opacity-8">

            <?php else: ?>
                <img
                    src="<?php echo e((setting('app_sidebar')=='light')? asset('uploads/appLogo/logo-dark.png'):asset('uploads/appLogo/logo-light.png')); ?>"
                    alt="App Logo" class="img brand-image img-responsive opacity-8">

            <?php endif; ?>
        </a>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="/profile"><img
                        src="<?php echo e(Auth::user()->avatar?Auth::user()->avatar:asset('uploads/avatar/avatar.png')); ?>"
                        width="40px" class="img img-circle  img-responsive" alt="User Image"></a>
            </div>
            <div class="info">
                <a href="/profile" class="d-block"><?php echo e(Auth::user()->firstname); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <!--
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Доступ-к-панели-управления')): ?>
                <li class="nav-item">
                    <a href="/" class="nav-link <?php echo e(request()->is('/')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            <?php echo e(__('app.dashboard')); ?>

                        </p>
                    </a>
                </li>
                <?php endif; ?> -->

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Просмотр-пользователей')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('user.index')); ?>"
                           class="nav-link <?php echo e(request()->is('user*')? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                <?php echo e(__('app.users')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-группами-пользователей')): ?>
                    <li class="nav-item">
                        <a href="/groups"
                           class="nav-link <?php echo e(request()->is('groups*')? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                <?php echo e(__('app.groups')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-ролями-и-разрешениями')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('role.index')); ?>"
                           class="nav-link <?php echo e(request()->is('role*')? 'sidebar-active':''); ?>">
                            <i class="fa fa-key nav-icon"></i>
                            <p><?php echo e(__('app.roles_and_permissions')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                <!--li class="nav-item has-treeview">
                    <a href="#"
                       class="nav-link <?php echo e((request()->is('subscription/plan')||request()->is('/subscription-income')||request()->is('/subscribed-users'))? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-cart-plus"></i>
                        <p>
                            <?php echo e(__('app.payment')); ?>

                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/subscription/plan"
                               class="nav-link <?php echo e(request()->is('subscription/plan')? 'sidebar-active':''); ?>">
                                <i class="fa fa-circle ml-3 mr-1"></i>
                                <p><?php echo e(__('app.subscription_plan')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/subscription-income"
                               class="nav-link <?php echo e(request()->is('subscription-income')? 'sidebar-active':''); ?>">
                                <i class="fa fa-circle ml-3 mr-1"></i>
                                <p><?php echo e(__('app.manage_income')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/subscribed-users"
                               class="nav-link <?php echo e(request()->is('subscribed-users')? 'sidebar-active':''); ?>">
                                <i class="fa fa-circle ml-3 mr-1"></i>
                                <p><?php echo e(__('app.subscribed_users')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/checkout-sample"
                               class="nav-link <?php echo e(request()->is('checkout-sample*')? 'sidebar-active':''); ?>">
                                <i class="fa fa-circle ml-3 mr-1"></i>
                                <p><?php echo e(__('app.checkout_sample')); ?></p>
                            </a>
                        </li>
                    </ul>
                </li-->
                <?php endif; ?>

                <?php if(!auth()->check() || ! auth()->user()->hasRole('admin')): ?>
                <?php if(setting('stripe_status')): ?>
                    <!--li class="nav-item">
                        <a href="<?php echo e(route('/subscription')); ?>"
                           class="nav-link <?php echo e(request()->is('subscription*')? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p>
                                <?php echo e(__('app.subscription')); ?>

                            </p>
                        </a>
                    </li-->
                <?php endif; ?>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-настройками-сайта')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('settings.index')); ?>"
                       class="nav-link <?php echo e(request()->is('settings')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            <?php echo e(__('app.application_settings')); ?>

                        </p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                <!--li class="nav-item">
                    <a href="/crud-builder" class="nav-link <?php echo e(request()->is('crud-builder')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            <?php echo e(__('app.crud_builder')); ?>

                        </p>
                    </a>
                </li-->
                <?php endif; ?>

                <!--li class="nav-header"><?php echo e((setting('stripe_status'))? __('app.premium_content_big'):__('app.content_big')); ?></li-->

                <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                <!--li class="nav-item has-treeview">
                    <a href="/article" class="nav-link <?php echo e(request()->is('article*')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-newspaper-o"></i>
                        <p>
                            <?php echo e(__('app.article')); ?>

                        </p>
                    </a>
                </li-->
                <!--li class="nav-item has-treeview">
                    <a href="/category-article"
                       class="nav-link <?php echo e(request()->is('category-article*')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-newspaper-o"></i>
                        <p>
                            <?php echo e(__('app.article_category')); ?>

                        </p>
                    </a>
                </li-->
                <?php endif; ?>
                <?php if(!auth()->check() || ! auth()->user()->hasRole('admin')): ?>
                <!--li class="nav-item">
                    <a href="/premium-content"
                       class="nav-link <?php echo e(request()->is('premium-content*')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-file-o"></i>
                        <p>
                            <?php echo e(__('app.content')); ?>

                        </p>
                    </a>
                </li-->
                <?php endif; ?>
                <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <li class="nav-item has-treeview">
                    <a href="/cases" class="nav-link <?php echo e((request()->is('cases*') && !request()->is('cases/archive*')) ? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-briefcase"></i>
                        <p>
                            <?php echo e(__('app.business_cases')); ?>

                        </p>
                    </a>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-папками')): ?>
                    <li class="nav-item has-treeview">
                        <a href="/folders" class="nav-link <?php echo e(request()->is('folders*') && !request()->is('folders/archive*') ? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-folder"></i>
                            <p>
                                <?php echo e(__('app.folders')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-папками')): ?>
                    <li class="nav-item has-treeview">
                        <a href="/folder-tree" class="nav-link <?php echo e(request()->is('folder-tree*') ? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-folder-open"></i>
                            <p>
                                Дерево папок
                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-архивом')): ?>
                    <li class="nav-item has-treeview">
                        <a href="/cases/archive" class="nav-link <?php echo e(request()->is('cases/archive*')? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                                <?php echo e(__('app.business_cases_archive')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Операции-с-архивом')): ?>
                    <li class="nav-item has-treeview">
                        <a href="/folders/archive" class="nav-link <?php echo e(request()->is('folders/archive*') ? 'sidebar-active':''); ?>">
                            <i class="nav-icon fa fa-trash"></i>
                            <p>
                                <?php echo e(__('app.folders_archive')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Доступ-к-базе-связей')): ?>
                <li class="nav-item has-treeview">
                    <a href="/connections" class="nav-link <?php echo e(request()->is('connections*')? 'sidebar-active':''); ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            <?php echo e(__('app.connections_database')); ?>

                        </p>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /var/www/www-root/data/www/moi.mirvseh.ru/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>