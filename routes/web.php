<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Application Backup-ROUTES
Route::post('/backup-file',[
  'uses' => '\App\Http\Controllers\Settings\SettingsController@backupFiles',
  'as' => 'backup-files'
]);

Route::post('/backup-db',[
  'uses' => '\App\Http\Controllers\Settings\SettingsController@backupDb',
  'as' => 'backup-db'
]);

Route::post('/backup-download/{name}/{ext}',[
  'uses' => '\App\Http\Controllers\Settings\SettingsController@downloadBackup',
  'as' => 'backup-download'
]);

Route::post('/backup-delete/{name}/{ext}',[
  'uses' => '\App\Http\Controllers\Settings\SettingsController@deleteBackup',
  'as' => 'backup-delete'
]);

Route::get('/logout', [
    'uses' => '\App\Http\Controllers\Auth\LoginController@logout'
]);

  Route::post('/verify-2fa',[
    'as' => 'verify-2fa',
    'uses' => '\App\Http\Controllers\Profile\ProfileController@verify'
  ]);

	Route::post('/activate-2fa',[
		'uses' => '\App\Http\Controllers\Profile\ProfileController@activate',
		'as' => 'activate-2fa'
	]);

	Route::post('/enable-2fa',[
		'uses' => '\App\Http\Controllers\Profile\ProfileController@enable',
		'as' => 'enable-2fa'
	]);

	Route::post('/disable-2fa',[
		'uses' => '\App\Http\Controllers\Profile\ProfileController@disable',
		'as' => 'disable-2fa'
	]);

	Route::get('/2fa/instruction',[
		'uses' => '\App\Http\Controllers\Profile\ProfileController@instruction',
	]);


	Route::get('/dashboard',[
		'as'=> '/dashboard',
		'uses'=> '\App\Http\Controllers\Dashboard\DashboardController@index',
	])->middleware('auth', 'permission:Доступ-к-панели-управления');

  /*
  | Stripe Subscription Routes
  */
	Route::get('/subscription',[
		'as'=> '/subscription',
		'uses'=> '\App\Http\Controllers\SubscriptionController@index',
	]);

	Route::get('/subscription/subscribe',[
		'as'=> '/subscription/subscribe',
		'uses'=> '\App\Http\Controllers\SubscriptionController@notSubscribed',
	]);

	Route::get('/subscription/stripe/{plan_id}',[
		'as'=> '/subscription/stripe',
		'uses'=> '\App\Http\Controllers\SubscriptionController@stripeCheckout',
	]);

	Route::post('/subscription/stripe/subscribe',[
		'as'=> '/subscription/stripe/subscribe',
		'uses'=> '\App\Http\Controllers\SubscriptionController@stripeSubscribe',
	]);

  Route::get('/subscription-invoice/{invoiceId}',[
    'uses' => '\App\Http\Controllers\SubscriptionController@stripeInvoice',
  ]);

  Route::get('/subscription-cancel/{subscriptionId}',[
    'uses' => '\App\Http\Controllers\SubscriptionController@cancelSubscription',
  ]);
	/*
	| Stripe Subscription Routes
	*/

  /*
  | Premium Content Routes
  */
  Route::resource('/premium-content', '\App\Http\Controllers\PremiumContent\PremiumContentController')
  ->middleware('premium');
  /*
  | Premium Content Routes
  */

	/*
	|  Activitylog Route
	*/
	Route::resource('activity-log', '\App\Http\Controllers\Activitylog\ActivitylogController');
  /*
  |  Activitylog Route
  */


	/*
	| Profile Routes
	*/

  Route::resource('profile', '\App\Http\Controllers\Profile\ProfileController');

	Route::get('update-avatar/{id}',[
		'as' => 'update-avatar',
		'uses'=> '\App\Http\Controllers\Profile\ProfileController@showAvatar'
	]);

	Route::post('update-avatar/{id}', '\App\Http\Controllers\Profile\ProfileController@updateAvatar');

	Route::post('update-profile-login/{id}',[
		'uses'=> '\App\Http\Controllers\Profile\ProfileController@updateLogin',
		'as' => 'update-login',
	]);

/*
| Profile Routes
*/

// Socialite Authentication Route
Route::get('login/{provider}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', '\App\Http\Controllers\Auth\LoginController@handleProviderCallback');

#####################################ADMIN MANAGED SECTION##########################################
// Users Route
	Route::resource('user', '\App\Http\Controllers\UserController')->middleware('auth', 'permission:Просмотр-пользователей');
	Route::post('update-user-login/{id}',[
    'as' => 'user-login',
	'uses'=> '\App\Http\Controllers\UserController@userLogin']);
	Route::get('user/{id}/activity-log/',[
    'as' => 'user-activitlog',
	'uses'=> '\App\Http\Controllers\UserController@userActivityLog']);
  // Users Route


// Roles Route
	Route::resource('role', '\App\Http\Controllers\Role\RoleController');
	Route::post('/role-permission/{id}',[
		'as' => 'roles_permit',
		'uses' => '\App\Http\Controllers\Role\RoleController@assignPermission',
	]);
// Roles Route


// Permission Route
	Route::resource('permission', '\App\Http\Controllers\Permission\PermissionController');
  // Permission Route


// Payment Gateway Route
          Route::get('/subscription/plan',[
              'as' => '/subscription/plan',
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@viewStripePlans',
          ]);

          Route::get('/subscription/plan/create',[
              'as' => '/subscription/plan/create',
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@createStripePlan',
          ]);

          Route::post('/subscription/plan/create',[
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@storeStripePlan',
          ]);

          Route::get('/stripe/plan/edit/{plan_id}',[
              'as' => '/stripe/plan/edit',
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@editStripePlan',
          ]);

          Route::post('/stripe/plan/edit/{id}/{plan_id}',[
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@updateStripePlan',
          ]);

          Route::post('/stripe/plan/delete/{id}',[
            'as' => '/stripe/plan/delete',
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@deleteStripePlan',
          ]);

          Route::get('/subscribed-users',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@manageSubscribedUser',
          ]);

          Route::get('/user-subscription-invoice/{invoiceId}',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@subscriptionInvoice',
          ]);

          Route::get('/user-subscription-cancel/{subscription_id}',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@cancelSub',
          ]);

          Route::get('/subscription-income',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@manageIncome',
          ]);

          Route::get('/checkout-sample',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@checkoutSamples',
          ]);

          Route::get('/checkout-sample/article',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@download',
          ]);

          Route::get('/checkout-sample/response/{session_id}',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@responseCheckout',
            'as' => '/checkout-sample/response'
          ]);

// Payment Gateway Route

      	Route::resource('settings','\App\Http\Controllers\Settings\SettingsController');

      	Route::post('settings/app-name/update',[
      		'as' => 'settings/app-name/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@appNameUpdate',
      	]);
      	Route::post('settings/app-logo/update',[
      		'as' => 'settings/app-logo/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@appLogoUpdate',
      	]);

      	Route::post('settings/app-theme/update',[
      		'as' => 'settings/app-theme/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@appThemeUpdate',
      	]);

      	Route::post('settings/stripe-payment/update',[
      		'as' => 'settings/stripe-payment/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@stripePaymentUpdate',
      	]);

        Route::post('settings/auth-settings/update',[
      		'as' => 'settings/auth-settings/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@authSettingsUpdate',
      	]);

        // Premium Content
        Route::resource('/article', '\App\Http\Controllers\Article\ArticleController');
        Route::post('/article-image', '\App\Http\Controllers\Article\ArticleController@articleImageUpload');
        Route::resource('/category-article', '\App\Http\Controllers\Article\ArticleCategoryController');


        // Business Cases
        Route::get('/cases/archive', '\App\Http\Controllers\BusinessCaseController@archiveList')->middleware('auth', 'permission:Операции-с-архивом');
        Route::resource('/cases', '\App\Http\Controllers\BusinessCaseController')->middleware('auth');
        Route::post('/imageCrop', '\App\Http\Controllers\ImageCropController@imageCropPost')->middleware('auth');

        Route::get('/cases/{businessCaseSlug}/edit', '\App\Http\Controllers\BusinessCaseController@edit')->middleware('auth', 'permission:Операции-с-делами');
        Route::post('/cases/{businessCaseSlug}/edit', '\App\Http\Controllers\BusinessCaseController@update')->middleware('auth', 'permission:Операции-с-делами');
        Route::get('/cases/{businessCaseSlug}/delete', '\App\Http\Controllers\BusinessCaseController@archive')->middleware('auth', 'permission:Операции-с-делами');
        Route::get('/cases/{businessCaseSlug}/restore', '\App\Http\Controllers\BusinessCaseController@restore')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/cases/{businessCaseSlug}/archive', '\App\Http\Controllers\DialogController@archiveList')->middleware('auth', 'permission:Операции-с-архивом');


        // Case folder
        Route::get('/cases/{businessCaseSlug}/folder', function ($slug) {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);
            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FolderController;
            return $controller->show($folder->slug);
        })->middleware('auth');
        Route::get('/cases/{businessCaseSlug}/folder/{path?}create', function ($slug, $path = '') {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);
            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->create($folder->slug, $path);
        })->where('path', '.*')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/folder/{path?}create', function (\Illuminate\Http\Request $request, $slug, $path = '') {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);

            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->store($request, $folder->slug, $path);
        })->where('path', '.*')->middleware('auth');
        Route::get('/cases/{businessCaseSlug}/folder/{path}/remove', function ($slug, $path) {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);
            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->remove($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/cases/{businessCaseSlug}/folder/{path?}archive', function ($slug, $path = '') {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);
            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FolderController;
            return $controller->archive($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/cases/{businessCaseSlug}/folder/{path}/restore', function ($slug, $path) {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);
            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->restore($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/cases/{businessCaseSlug}/folder/{path}/delete', function ($slug, $path) {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);
            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->delete($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/cases/{businessCaseSlug}/folder/{path}', function ($slug, $path) {
            $businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();

            if (!$businessCase)
                abort(404);

            $folder = \App\Models\Folder::where('business_case_id', $businessCase->id)->first();
            if (!$folder)
                abort(404);

            $pathFull = \App\Http\Traits\DirValidationTrait::validate($folder, $path);
            if (!$pathFull)
                abort(404);

            $pathArray = explode('/', $path);
            if (\App\Models\File::where('id', end($pathArray))->first()->type == 'file') {
                $controller = new \App\Http\Controllers\FileController;
                $path = $pathFull;
            } else {
                $controller = new \App\Http\Controllers\FolderController;
            }
            return $controller->show($folder->slug, $path);
        })->where('path', '.*')->middleware('auth');


        //  Dialogs
        Route::get('/cases/{businessCaseSlug}/new-dialog', '\App\Http\Controllers\DialogController@create')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/new-dialog', '\App\Http\Controllers\DialogController@store')->middleware('auth');
        Route::get('/cases/{businessCaseSlug}/{dialogId}/edit', '\App\Http\Controllers\DialogController@edit')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/{dialogId}/edit', '\App\Http\Controllers\DialogController@update')->middleware('auth');
        Route::get('/cases/{businessCaseSlug}/{dialogId}/delete', '\App\Http\Controllers\DialogController@archive')->middleware('auth', 'permission:Операции-с-диалогами');
        Route::get('/cases/{businessCaseSlug}/{dialogId}/restore', '\App\Http\Controllers\DialogController@restore')->middleware('auth', 'permission:Операции-с-архивом');


        //  Messages
        Route::get('/cases/{businessCaseSlug}/{dialogId}', '\App\Http\Controllers\DialogController@show')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/{dialogId}/send-message', '\App\Http\Controllers\MessageController@message')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/{dialogID}/refresh', '\App\Http\Controllers\DialogController@refresh')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/{dialogId}/delete-and-restore-message', '\App\Http\Controllers\MessageController@deleteAndRestore')->middleware('auth');
        Route::post('/cases/{businessCaseSlug}/{dialogId}/loadup', '\App\Http\Controllers\DialogController@loadup')->middleware('auth');


        //  Folders and files
        Route::get('/folder-tree', '\App\Http\Controllers\FolderController@folderTree')->middleware('auth', 'permission:Операции-с-папками');
        Route::post('/folder-tree', '\App\Http\Controllers\FolderController@getSub')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/folders', '\App\Http\Controllers\FolderController@index')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/folders/create', '\App\Http\Controllers\FolderController@create')->middleware('auth', 'permission:Операции-с-папками');
        Route::post('/folders/create', '\App\Http\Controllers\FolderController@store')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/folders/archive', '\App\Http\Controllers\FolderController@archiveIndex')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/folders/{slug}/edit', '\App\Http\Controllers\FolderController@edit')->middleware('auth', 'permission:Операции-с-папками');
        Route::post('/folders/{slug}/edit', '\App\Http\Controllers\FolderController@update')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/folders/{slug}/remove', '\App\Http\Controllers\FolderController@remove')->middleware('auth', 'permission:Операции-с-папками');
        Route::get('/folders/{slug}/restore', '\App\Http\Controllers\FolderController@restore')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/folders/{slug}/delete', '\App\Http\Controllers\FolderController@delete')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/folders/{slug}/{path?}archive', function ($slug, $path = '') {
            /*$businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);*/
            $folder = \App\Models\Folder::where('slug', $slug)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FolderController;
            return $controller->archive($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/folders/{slug}/{path}/restore', function ($slug, $path) {
            /*$businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);*/
            $folder = \App\Models\Folder::where('slug', $slug)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->restore($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/folders/{slug}/{path}/delete', function ($slug, $path) {
            /*$businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);*/
            $folder = \App\Models\Folder::where('slug', $slug)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->delete($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');
        Route::get('/folders/{slug}/{path}/remove', function ($slug, $path = '') {
            /*$businessCase = \App\Models\BusinessCase::where('slug', $slug)->first();
            if (!$businessCase)
                abort(404);*/
            $folder = \App\Models\Folder::where('slug', $slug)->first();
            if (!$folder)
                abort(404);

            $controller = new \App\Http\Controllers\FileController;
            return $controller->remove($folder->slug, $path);
        })->where('path', '.*')->middleware('auth', 'permission:Операции-с-архивом');


        Route::get('/folders/{slug}', '\App\Http\Controllers\FolderController@show')->middleware('auth');
        Route::get('/folders/{slug}/{path?}create', '\App\Http\Controllers\FileController@create')->where('path', '.*')->middleware('auth');
        Route::post('/folders/{slug}/{path?}create', '\App\Http\Controllers\FileController@store')->where('path', '.*')->middleware('auth');

        Route::get('/folders/{slug}/{path}', function ($slug, $path) {
            $folder = \App\Models\Folder::where('slug', $slug)->first();
            if (!$folder)
                abort(404);

            $pathFull = \App\Http\Traits\DirValidationTrait::validate($folder, $path);
            if (!$pathFull)
                abort(404);

            $pathArray = explode('/', $path);
            if (\App\Models\File::where('id', end($pathArray))->first()->type == 'file') {
                $controller = new \App\Http\Controllers\FileController;
                $path = $pathFull;
            } else {
                $controller = new \App\Http\Controllers\FolderController;
            }
            return $controller->show($slug, $path);
        })->where('path', '.*')->middleware('auth');



        //  Connections
        Route::get('/connections', '\App\Http\Controllers\ConnectionController@hub')->middleware('auth', 'permission:Доступ-к-базе-связей');
        Route::get('/connections/{type}', '\App\Http\Controllers\ConnectionController@index')->middleware('auth', 'permission:Доступ-к-базе-связей');
        Route::get('/connections/{type}/create', '\App\Http\Controllers\ConnectionController@create')->middleware('auth');
        Route::post('/connections/{type}/create', '\App\Http\Controllers\ConnectionController@store')->middleware('auth');
        Route::get('/connections/{type}/{id}/edit', '\App\Http\Controllers\ConnectionController@edit')->middleware('auth', 'permission:Доступ-к-базе-связей');
        Route::post('/connections/{type}/{id}/edit', '\App\Http\Controllers\ConnectionController@update')->middleware('auth', 'permission:Доступ-к-базе-связей');
        Route::get('/connections/{type}/{id}/remove', '\App\Http\Controllers\ConnectionController@remove')->middleware('auth', 'permission:Доступ-к-базе-связей');
        Route::get('/docs/{filePath}', function ($filePath) {
            return response()->file(\Illuminate\Support\Facades\Storage::disk('userUploads')->path('docs/' . $filePath));
        })->middleware('auth', 'permission:Доступ-к-базе-связей');

        // Groups
        Route::get('/groups', '\App\Http\Controllers\GroupController@index')->middleware('auth', 'permission:Операции-с-группами-пользователей');
        Route::get('/groups/create', '\App\Http\Controllers\GroupController@create')->middleware('auth', 'permission:Операции-с-группами-пользователей');
        Route::post('/groups/create', '\App\Http\Controllers\GroupController@store')->middleware('auth', 'permission:Операции-с-группами-пользователей');
        Route::get('/groups/{id}/edit', '\App\Http\Controllers\GroupController@edit')->middleware('auth', 'permission:Операции-с-группами-пользователей');
        Route::post('/groups/{id}/edit', '\App\Http\Controllers\GroupController@update')->middleware('auth', 'permission:Операции-с-группами-пользователей');
        Route::get('/groups/{id}/remove', '\App\Http\Controllers\GroupController@remove')->middleware('auth', 'permission:Операции-с-группами-пользователей');

        //Route::get('/transfer-db', '\App\Http\Controllers\UserController@transferDB')->middleware('auth', 'role:Администратор');
        //Route::get('/create-root-dirs', '\App\Http\Controllers\FolderController@setRootFolders')->middleware('auth', 'role:Администратор');
        //Route::get('/rename-duplicates', '\App\Http\Controllers\FileController@renameDuplicates')->middleware('auth', 'role:Администратор');
        //Route::get('/set-subdirs', '\App\Http\Controllers\FileController@setSubDirs')->middleware('auth', 'role:Администратор');
        //Route::get('/loltest', '\App\Http\Controllers\FileController@removeSubFolders')->middleware('auth', 'role:Администратор');

        // Frontend
        //Route::view('/', 'frontend.template');
        Route::get('/', function () {
            return redirect('/login');
        });
        Route::get('/test', function () {
            return view('frontend.index');
        });
        Route::get('/test/404', function () {
            return view('frontend.404');
        });
        Route::get('/test/about', function () {
            return view('frontend.about');
        });
        Route::get('/test/blog', function () {
            return view('frontend.blog');
        });
        Route::get('/test/blog-single', function () {
            return view('frontend.blog-single');
        });
        Route::get('/test/contact', function () {
            return view('frontend.contact');
        });
        Route::get('/test/faqs', function () {
            return view('frontend.faqs');
        });
        Route::get('/test/prices', function () {
            return view('frontend.prices');
        });
        Route::get('/test/service-details', function () {
            return view('frontend.service-details');
        });
        Route::get('/test/services', function () {
            return view('frontend.services');
        });
        Route::get('/test/team', function () {
            return view('frontend.team');
        });
        Route::get('/test/team-details', function () {
            return view('frontend.team-details');
        });


#####################################ADMIN MANAGED SECTION##########################################

#####################################CRUD GENERATOR ROUTES##########################################
      Route::get('/crud-builder', [
        'as' => 'crud-builder',
        'uses' => '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder'
      ])->middleware('auth','web','role:admin','2fa');

      Route::get('/field-template',[
        'as' => 'field-template',
        'uses' => '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate'
      ])->middleware('auth','web','role:admin','2fa');

      Route::post('/generator-builder/generate', [
        'as' => 'generator-builder/generate',
        'uses' => '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate'
      ])->middleware('auth','web','role:admin','2fa');

      Route::post('/generator-builder/rollback', [
        'as' => 'generator-builder/rollback',
        'uses' => '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback'
      ])->middleware('auth','web','role:admin','2fa');

      Route::post('/model-check', [
        'as' => 'model-check',
        'uses' => '\App\Http\Controllers\CRUDController@checkModel'
      ]);

#####################################CRUD GENERATOR ROUTES##########################################

#####################################WEBHOOK ROUTE##########################################
Route::stripeWebhooks('stripe-webhook');
#####################################WEBHOOK ROUTE##########################################

Route::impersonate();
Auth::routes(['verify' => true]);
