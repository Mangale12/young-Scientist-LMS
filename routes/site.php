<?php

Route::get('/', [App\Http\Controllers\Site\SiteController::class, 'index'])->name('index');
Route::group(['prefix'=>'student', 'as'=>'student.'], function(){
    Route::post('/', [App\Http\Controllers\Admin\StudentController::class, 'store'])->name('store');
    Route::get('/about', [App\Http\Controllers\Site\StudentController::class, 'about'])->name('about');
    Route::get('/contact', [App\Http\Controllers\Site\StudentController::class, 'contact'])->name('contact');
    Route::get('/dashboard', [App\Http\Controllers\Admin\StudentController::class, 'dashboard'])->name('dashboard');
    
});
Route::group(['prefix'=>'teacher', 'as'=>'teacher.'], function(){
    Route::post('/', [App\Http\Controllers\Admin\TeacherController::class, 'store'])->name('store');
    Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
});
Route::get('/', [App\Http\Controllers\Site\SiteController::class, 'index'])->name('');