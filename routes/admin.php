<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Backend\Blog\PostController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Backend\Blog\CategoryController;

Route::controller(DashboardController::class)->group(function(){
    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::post('logout', 'logout')->name('logout');
});

// Role Routes
Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store-or-update', 'storeOrUpdate')->name('store-or-update');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('delete', 'delete')->name('delete');
});

// Admin Routes
Route::controller(AdminController::class)->prefix('admins')->name('admins.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store-or-update', 'storeOrUpdate')->name('store-or-update');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('delete', 'delete')->name('delete');
    Route::post('status-change', 'statusChange')->name('status-change');
});

// User Routes
Route::controller(UserController::class)->prefix('users')->name('users.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store-or-update', 'storeOrUpdate')->name('store-or-update');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('delete', 'delete')->name('delete');
    Route::post('status-change', 'statusChange')->name('status-change');
});


Route::controller(AdminManagementController::class)->prefix('manage-admins')->name('manage-admins.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/delete', 'delete')->name('delete');
    Route::post('/search', 'search')->name('search');

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

// Category Routes
Route::prefix('categories')->name('categories.')->group(function(){
    Route::get('/',[CategoryController::class, 'index'])->name('index');
    Route::post('store-or-update',[CategoryController::class, 'storeOrUpdate'])->name('store-or-update');
    Route::get('edit',[CategoryController::class, 'edit'])->name('edit');
    Route::post('status-change',[CategoryController::class, 'statusChange'])->name('status-change');
    Route::post('delete',[CategoryController::class, 'delete'])->name('delete');
});

// Post Routes
Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/',[PostController::class, 'index'])->name('index');
    Route::post('store-or-update',[PostController::class, 'storeOrUpdate'])->name('store-or-update');
    Route::get('edit',[PostController::class, 'edit'])->name('edit');
    Route::post('status-change',[PostController::class, 'statusChange'])->name('status-change');
    Route::post('delete',[PostController::class, 'delete'])->name('delete');
});



