<?php
Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

Route::group(['prefix' => 'fiscal-year',             'as' => 'fiscal_year.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\FiscalYearController::class, 'index'])->name('index');
    Route::get('fiscal-year/data',                     [App\Http\Controllers\Admin\FiscalYearController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\FiscalYearController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\FiscalYearController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\FiscalYearController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\FiscalYearController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\FiscalYearController::class, 'destroy'])->name('destroy');
});
// Branch Route
Route::group(['prefix' => 'branch',             'as' => 'branch.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\BranchController::class, 'index'])->name('index');
    Route::get('branch/data',                          [App\Http\Controllers\Admin\BranchController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\BranchController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\BranchController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\BranchController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\BranchController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\BranchController::class, 'destroy'])->name('destroy');
});

// Ward Route
Route::group(['prefix' => 'ward',             'as' => 'ward.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\WardController::class, 'index'])->name('index');
    Route::get('ward/data',                            [App\Http\Controllers\Admin\WardController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\WardController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\WardController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\WardController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\WardController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\WardController::class, 'destroy'])->name('destroy');
});

// Office Route
Route::group(['prefix' => 'office',             'as' => 'office.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\OfficeController::class, 'index'])->name('index');
    Route::get('office/data',                            [App\Http\Controllers\Admin\OfficeController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\OfficeController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\OfficeController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\OfficeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\OfficeController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\OfficeController::class, 'destroy'])->name('destroy');
});


// Document Type Route
Route::group(['prefix' => 'document-type',             'as' => 'document-type.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\DocumentTypeController::class, 'index'])->name('index');
    Route::get('document-type/data',                   [App\Http\Controllers\Admin\DocumentTypeController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\DocumentTypeController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\DocumentTypeController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\DocumentTypeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\DocumentTypeController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\DocumentTypeController::class, 'destroy'])->name('destroy');
});

// Status Type Route
Route::group(['prefix' => 'status',             'as' => 'status.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\StatusController::class, 'index'])->name('index');
    Route::get('document-type/data',                   [App\Http\Controllers\Admin\StatusController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\StatusController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\StatusController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\StatusController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\StatusController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\StatusController::class, 'destroy'])->name('destroy');
});

// Position Type Route
Route::group(['prefix' => 'position',             'as' => 'position.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\PositionController::class, 'index'])->name('index');
    Route::get('document-type/data',                   [App\Http\Controllers\Admin\PositionController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\PositionController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\PositionController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\PositionController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\PositionController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\PositionController::class, 'destroy'])->name('destroy');
});

// Role Type Route
Route::group(['prefix' => 'role',             'as' => 'role.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('index');
    Route::get('document-type/data',                   [App\Http\Controllers\Admin\RoleController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'chalani',             'as' => 'chalani.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\ChalaniController::class, 'index'])->name('index');
    Route::get('/data',                         [App\Http\Controllers\Admin\ChalaniController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\ChalaniController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\ChalaniController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\ChalaniController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\ChalaniController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\ChalaniController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\ChalaniController::class, 'show'])->name('show');
    Route::get('status/{id}',                          [App\Http\Controllers\Admin\ChalaniController::class, 'status'])->name('status');
});

Route::group(['prefix' => 'darta',             'as' => 'darta.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\DartaController::class, 'index'])->name('index');
    Route::get('/data',                         [App\Http\Controllers\Admin\DartaController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\DartaController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\DartaController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\DartaController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\DartaController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\DartaController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                         [App\Http\Controllers\Admin\DartaController::class, 'show'])->name('show');
    Route::get('status/{id}',                          [App\Http\Controllers\Admin\DartaController::class, 'status'])->name('status');

});

//Old Documentation Route
Route::group(['prefix' => 'old-document',             'as' => 'old-document.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\OldDocumentController::class, 'index'])->name('index');
    Route::get('/data',                                [App\Http\Controllers\Admin\OldDocumentController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\OldDocumentController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\OldDocumentController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\OldDocumentController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\OldDocumentController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\OldDocumentController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\OldDocumentController::class, 'show'])->name('show');
    Route::get('status/{id}',                          [App\Http\Controllers\Admin\OldDocumentController::class, 'status'])->name('status');

});

Route::group(['prefix' => 'user',             'as' => 'user.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
    Route::get('chalani/data',                         [App\Http\Controllers\Admin\UserController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
    Route::get('status/{id}',                          [App\Http\Controllers\Admin\UserController::class, 'status'])->name('status');

});
