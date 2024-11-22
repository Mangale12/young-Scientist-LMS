<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['namespace'=>'Site', 'as'=>'site.'], function(){
    include('site.php');
});
Route::group(['namespace'=>'Student', 'as'=>'student.'], function(){
    include('student.php');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::post('/ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.upload');
Route::post('/image-upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('image.upload');


Route::group(['namespace' => 'Backend', 'prefix' => '/admin', 'as' => 'admin.',  'middleware' => ['auth']], function () {
    include('Backend/Backend.php');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

Route::get('/test', function () {
    dd('test');
    return view('welcome');
})->name('test');