<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});


Route::controller(WebController::class)->group(function() {
    //pages
    Route::get('/','index')->name('index');
    Route::get('about','about')->name('about');
    Route::get('services','services')->name('services');
    Route::get('blog','blog')->name('blog');
    Route::get('blog-details/{slug}','blogDetails')->name('blog.details');
    Route::get('contact','contact')->name('contact');
    Route::get('contact','contact')->name('contact');

    Route::post("subscribe","subscribe")->name("subscribe");
    Route::post("contact/message/send","contactMessageSend")->name("contact.message.send");
    Route::get('link/{slug}','usefulLink')->name('useful.links');
    // Route::get('language/switch/{locale}','languageSwitch')->name('language.switch')->middleware('language');


    // Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch')->where('locale', 'en|fr|es|de');


});

Route::post('language/switch', [LanguageController::class, 'languageSwitch'])
    ->name('language.switch');

Route::get('/debug-session', function() {
    $data = [
        'session_locale' => session('locale'),
        'session_dir' => session('locale_dir'),
        'app_locale' => app()->getLocale(),
        'all_session' => session()->all(),
    ];
    dd($data);
});
