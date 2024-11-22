<?php
Route::get('/dashboard', [App\Http\Controllers\Admin\StudentController::class, 'dashboard'])->name('dashboard');
Route::group(['prefix' => 'fiscal-year',             'as' => 'fiscal_year.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\FiscalYearController::class, 'index'])->name('index');
    Route::get('fiscal-year/data',                     [App\Http\Controllers\Admin\FiscalYearController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\FiscalYearController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\FiscalYearController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\FiscalYearController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\FiscalYearController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\FiscalYearController::class, 'destroy'])->name('destroy');
});