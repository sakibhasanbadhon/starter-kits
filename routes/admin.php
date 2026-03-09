<?php

use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\ContentManagerController;
use App\Http\Controllers\Admin\CurrenciesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SystemMaintenanceController;
use App\Http\Controllers\Admin\UiController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Admin\UserManageController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(AdminManagementController::class)->prefix('manage-admins')->name('manage-admins.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/delete', 'delete')->name('delete');
    Route::post('/search', 'search')->name('search');

    Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/delete', 'delete')->name('delete');
        Route::post('/search', 'search')->name('search');
    });


    Route::controller(UserManageController::class)->prefix('user')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('details/{id}', 'userDetails')->name('details');
        Route::post('/search', 'search')->name('search');
    });
});

Route::controller(CurrenciesController::class)->prefix('currencies')->name('currencies.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
    Route::put('status/update', 'statusUpdate')->name('status.update');
    Route::get('countries', 'getCountries')->name('countries');

    Route::delete('delete', 'delete')->name('delete');
    Route::post('search', 'search')->name("search");
});


Route::controller(GlobalController::class)->group(function () {
    Route::get('subscriber/', 'subscriber')->name('subscriber');
    Route::get('contact/message', 'contactMessage')->name('contact.message');
    Route::get('web/settings', 'webSetting')->name('web.settings');
    Route::post('web/settings/store', 'webSettingStore')->name('web.settings.store');
});

Route::controller(PagesController::class)->prefix('pages')->name('pages.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::post('status/update', 'statusUpdate')->name('status.update');
});

Route::controller(UsefulLinkController::class)->prefix('useful-links')->name('useful-links.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::get('status/update', 'StatusUpdate')->name('status.update');
    Route::post('delete', 'delete')->name('delete');
    Route::post('update', 'update')->name('update');
});


// Site Content Management Routes
Route::controller(UiController::class)->prefix('ui-content')->name('ui-content.')->group(function () {
    Route::get('{page}', 'displayContentPage')->name('page');
    Route::post('save/{page}', 'updateContentData')->name('save');
    Route::post('create-item/{page}', 'addContentItem')->name('item.create');
    Route::post('update-item/{page}', 'updateContentItem')->name('item.update');
    Route::post('edit-item/{page}', 'editContentItem')->name('item.edit');
    Route::post('delete-item/{page}', 'deleteContentItem')->name('item.delete');
    Route::put('toggle-status/{page}', 'changeItemStatus')->name('status.toggle');
});

// Language Section
Route::controller(LanguageController::class)->prefix('languages')->name('languages.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::post('store','store')->name('store');
    Route::put('update','update')->name('update');
    Route::post('status/update', 'statusUpdate')->name('status.update');
    Route::get('info/{code}','info')->name('info');
    Route::post('delete','delete')->name('delete');
    // Route::post('import','import')->name('import');
    // Route::post('switch','switch')->name('switch');
    // Route::get('download','download')->name('download');
});

// System Under Maintenance
Route::controller(SystemMaintenanceController::class)->prefix('system-maintenance')->name('system.maintenance.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::put('update', 'update')->name('update');
});
