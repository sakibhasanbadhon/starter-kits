<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::prefix('admin')->name('admin.')->middleware('guest','admin.auth')->group(function () {
    Route::get('/',function(){
        return redirect()->route('admin.login');
    }); 
    Route::get('login',[LoginController::class,"showLoginForm"])->name('login');
    Route::post('login/submit',[LoginController::class,"login"])->name('login.submit');
});