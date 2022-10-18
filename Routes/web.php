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

use Illuminate\Support\Facades\Route;
use Modules\Core\Entities\Admin;

Route::group([
    'prefix'     => config('core.admin_prefix', 'admin'),
    'middleware' => 'auth',
    'as'         => 'admin.',
    'namespace'  => 'Admin'
], function($router) {
    $router->get('/', 'DashboardController@dashboard')->name('dashboard');
    $router->get('/account/logout', 'DashboardController@logout')->name('logout');
    $router->get('/account/profile', 'ProfileController@index')->name('profile');
    $router->put('/account/profile', 'ProfileController@update')->name('profile.update');

    $router->prefix('settings')->as('settings.')->group(function($router) {
        $router->get('general', 'SettingController@general')->name('general')->can('setting.general');
        $router->get('email', 'SettingController@email')->name('email')->can('setting.email');

        $router->post('backend', 'SettingController@updateBackend')->name('backend.post')->can('setting.general');
        $router->post('analytics', 'SettingController@updateAnalytics')->name('analytics.post')->can('setting.general');
        $router->post('maintenance', 'SettingController@updateMaintenance')->name('maintenance.post')->can('setting.general');
        $router->post('email', 'SettingController@updateEmail')->name('email.post')->can('setting.email');
        $router->post('ajax/email-template', 'SettingController@getEmailTemplate')->name('email.template')->can('setting.email');
    });
    
    $router->prefix('system')->as('system.')->group(function($router) {
        $router->resource('administrators', 'AdminController');
        $router->resource('roles', 'RoleController', ['only' => ['index', 'create', 'edit', 'store', 'update']]);

        $router->get('information', 'SystemController@information')->name('information')->can('system.information.view');
        $router->get('activities', 'SystemController@activities')->name('activities')->can('system.activity.view');
        $router->get('logs', 'SystemController@logs')->name('logs')->can('system.error_log.view');

        $router->post('administrators/deletes', 'AdminController@deletes')->name('administrators.deletes');
        $router->post('activities/delete', 'SystemController@deleteActivity')->name('activities.delete');
    });
});

Route::group([
    'prefix' => 'ajax',
    'middleware' => 'auth',
    'as' => 'admin.ajax.',
    'namespace' => 'Admin'
], function($router) {
    $router->post('clear-cache', 'AjaxController@clearCache')->name('clear-cache');

    $router->prefix('email-template')->as('email-template.')->group(function($router) {
        $router->post('preview', 'AjaxController@previewEmailTemplate')->name('preview');
        $router->post('update', 'AjaxController@updateEmailTemplate')->name('update');
    });
});

Route::group([
    'prefix'     => config('core.admin_prefix', 'admin'),
    'middleware' => 'guest',
    'as'         => 'admin.',
    'namespace'  => 'Admin'
], function($router) {
    $router->prefix('auth')->as('auth.')->group(function($router) {
        $router->get('login', 'AuthController@login')->name('login');
        $router->get('forgot-password', 'AuthController@forgot')->name('forgot');
        $router->get('reset-password/{token}', 'AuthController@reset')->name('reset');

        $router->post('login', 'AuthController@postLogin')->name('login.post');
        $router->post('forgot', 'AuthController@postForgot')->name('forgot.post');
        $router->post('reset-password/{token}', 'AuthController@postReset')->name('reset.post');
    });
});

// Route::get('email-template', function() {
//     return view('core::email_templates.reset_password', [
//         'subject' => 'Demo'
//     ]);
// });
