<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\UsefulLinkController;

Route::controller(DashboardController::class)->group(function(){
    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(AdminManagementController::class)->prefix('manage-admins')->name('manage-admins.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/delete', 'delete')->name('delete');
    Route::post('/search', 'search')->name('search');

    Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/delete', 'delete')->name('delete');
        Route::post('/search', 'search')->name('search');
    });


    Route::controller(UserManageController::class)->prefix('user')->name('user.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('details/{id}', 'userDetails')->name('details');
        Route::post('/search', 'search')->name('search');
    });

});


Route::controller(GlobalController::class)->group(function(){
    Route::get('subscriber/', 'subscriber')->name('subscriber');
    Route::get('contact/message', 'contactMessage')->name('contact.message');
    Route::get('web/settings', 'webSetting')->name('web.settings');
    Route::post('web/settings/store', 'webSettingStore')->name('web.settings.store');
});

Route::controller(PagesController::class)->prefix('pages')->name('pages.')->group(function(){
    Route::get('index', 'index')->name('index');
    Route::post('status/update', 'statusUpdate')->name('status.update');

});

Route::controller(UsefulLinkController::class)->prefix('useful-links')->name('useful-links.')->group(function(){
    Route::get('index', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::get('status/update', 'StatusUpdate')->name('status.update');
    Route::post('delete', 'delete')->name('delete');
    Route::post('update', 'update')->name('update');
});


