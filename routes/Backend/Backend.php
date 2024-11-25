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
    Route::get('/data',                                [App\Http\Controllers\Admin\ChalaniController::class, 'getData'])->name('data');
    Route::get('/all',                                 [App\Http\Controllers\Admin\ChalaniController::class, 'all'])->name('all');
    Route::get('/data-all',                            [App\Http\Controllers\Admin\ChalaniController::class, 'getAllData'])->name('data-all');
    Route::get('/verified-chalani',                    [App\Http\Controllers\Admin\ChalaniController::class, 'getAllData'])->name('verified-chalani');
    Route::get('/unverified-chalani',                  [App\Http\Controllers\Admin\ChalaniController::class, 'getAllData'])->name('unverified-chalani');
    Route::get('/ward-data',                           [App\Http\Controllers\Admin\ChalaniController::class, 'wardForm'])->name('ward-data');
    Route::post('/get-ward-data',                       [App\Http\Controllers\Admin\ChalaniController::class, 'getWardData'])->name('get-ward-data');
    Route::get('/create',                              [App\Http\Controllers\Admin\ChalaniController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\ChalaniController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\ChalaniController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\ChalaniController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\ChalaniController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\ChalaniController::class, 'show'])->name('show');
    Route::post('status/{id}',                         [App\Http\Controllers\Admin\ChalaniController::class, 'status'])->name('status');
    Route::delete('delete-image/{id}',                 [App\Http\Controllers\Admin\ChalaniController::class, 'deleteImage'])->name('delete-image');
    Route::get('download-image/{key}',                 [App\Http\Controllers\Admin\ChalaniController::class, 'downloadImage'])->name('download-image');
});

Route::group(['prefix' => 'darta',             'as' => 'darta.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\DartaController::class, 'index'])->name('index');
    Route::get('/data',                                [App\Http\Controllers\Admin\DartaController::class, 'getData'])->name('data');
    Route::get('/ward-data',                           [App\Http\Controllers\Admin\DartaController::class, 'wardForm'])->name('ward-data');
    Route::post('/get-ward-data',                       [App\Http\Controllers\Admin\DartaController::class, 'getWardData'])->name('get-ward-data');
    Route::get('/all',                                 [App\Http\Controllers\Admin\DartaController::class, 'all'])->name('all');
    Route::get('/data-all',                            [App\Http\Controllers\Admin\DartaController::class, 'getAllData'])->name('data-all');
    Route::get('/verified-darta',                      [App\Http\Controllers\Admin\DartaController::class, 'getAllData'])->name('verified-darta');
    Route::get('/unverified-darta',                    [App\Http\Controllers\Admin\DartaController::class, 'getAllData'])->name('unverified-darta');
    Route::get('/create',                              [App\Http\Controllers\Admin\DartaController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\DartaController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\DartaController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\DartaController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\DartaController::class, 'destroy'])->name('destroy');
    Route::delete('delete-image/{id}',                 [App\Http\Controllers\Admin\DartaController::class, 'deleteImage'])->name('delete-image');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\DartaController::class, 'show'])->name('show');
    Route::post('status/{id}',                          [App\Http\Controllers\Admin\DartaController::class, 'status'])->name('status');
    Route::get('download-image/{key}',                 [App\Http\Controllers\Admin\ChalaniController::class, 'downloadImage'])->name('download-image');

});

// Route for all darta chalani
Route::group(['prefix' => 'darta-chalani',             'as' => 'darta-chalani.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\DartaChalaniController::class, 'index'])->name('index');
    Route::get('/data',                                [App\Http\Controllers\Admin\DartaChalaniController::class, 'getData'])->name('data');
    Route::get('/verified-data',                      [App\Http\Controllers\Admin\DartaChalaniController::class, 'getData'])->name('verified-data');
    Route::get('/unverified-data',                    [App\Http\Controllers\Admin\DartaChalaniController::class, 'getData'])->name('unverified-data');

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
    Route::post('status/{id}',                          [App\Http\Controllers\Admin\OldDocumentController::class, 'status'])->name('status');

});

Route::group(['prefix' => 'user',             'as' => 'user.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
    Route::get('chalani/data',                         [App\Http\Controllers\Admin\UserController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
    Route::get('/change-passwords/{id}',               [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('change-passwords');
    Route::get('/change_password',                     [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('change-password');
    Route::put('/update-passwords/{id}',               [App\Http\Controllers\Admin\UserController::class, 'updatePasswords'])->name('update-passwords');
    Route::put('/update-password/{id}',               [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('update-password');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
    Route::post('status/{id}',                         [App\Http\Controllers\Admin\UserController::class, 'status'])->name('status');

});

// setting routes
Route::group(['prefix' => 'setting',             'as' => 'setting.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
    Route::get('chalani/data',                         [App\Http\Controllers\Admin\SettingController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\SettingController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\SettingController::class, 'destroy'])->name('destroy');
    Route::get('show/{id}',                            [App\Http\Controllers\Admin\SettingController::class, 'show'])->name('show');
    Route::post('status/{id}',                          [App\Http\Controllers\Admin\SettingController::class, 'status'])->name('status');

});


// Grade Type Route
Route::group(['prefix' => 'grade',             'as' => 'grade.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\GradeController::class, 'index'])->name('index');
    Route::get('/data/all',                         [App\Http\Controllers\Admin\GradeController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\GradeController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\GradeController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\GradeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\GradeController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\GradeController::class, 'destroy'])->name('destroy');
});

// School Type Route
Route::group(['prefix' => 'shool',             'as' => 'school.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\SchoolController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\SchoolController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\SchoolController::class, 'create'])->name('create');
    Route::get('/courses/{id}',                        [App\Http\Controllers\Admin\SchoolController::class, 'courses'])->name('courses');
    Route::get('/grades/{id}',                         [App\Http\Controllers\Admin\SchoolController::class, 'grades'])->name('grades');
    Route::post('/add-grade',                           [App\Http\Controllers\Admin\SchoolController::class, 'addGrade'])->name('add-grade');
    Route::post('/grade/add-section',                           [App\Http\Controllers\Admin\SchoolController::class, 'addGradeSection'])->name('grade.add-section');
    Route::get('/grades/{school_id}/{grade_id}',       [App\Http\Controllers\Admin\SchoolController::class, 'gradeSection'])->name('grade.sections');
    Route::get('/grades/{school_id}/{grade_id}/{setion_id}',       [App\Http\Controllers\Admin\SchoolController::class, 'gradeSectionStudent'])->name('grade.section.student-list');
    Route::post('/grade/section/add-student',       [App\Http\Controllers\Admin\SchoolController::class, 'addGradeSectionStudent'])->name('grade.section.add-student');
    Route::get('/grades-course/{school_id}/{grade_id}/{setion_id}',       [App\Http\Controllers\Admin\SchoolController::class, 'gradeSectionCourse'])->name('grade.section.course-list');
    Route::post('/grades/section/add-course',       [App\Http\Controllers\Admin\SchoolController::class, 'addGradeSectionCourse'])->name('grade.section.add-course');
    Route::get('/grade-teacher/{school_id}/{grade_id}/{setion_id}',       [App\Http\Controllers\Admin\SchoolController::class, 'gradeSectionTeacher'])->name('grade.section.teacher-list');
    Route::get('/grade-section-teacher',                [App\Http\Controllers\Admin\SchoolController::class, 'getAllTeacher'])->name('grade.section.course.teachers');
    Route::post('/grade-section-course-asign-teacher',                [App\Http\Controllers\Admin\SchoolController::class, 'gradeSectionCourseAssignTeacher'])->name('grade.section.course.assign-teacher');
    
    
    Route::post('',                                    [App\Http\Controllers\Admin\SchoolController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\SchoolController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\SchoolController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\SchoolController::class, 'destroy'])->name('destroy');
    Route::post('/remove-course',                      [App\Http\Controllers\Admin\SchoolController::class, 'removeCourse'])->name('remove-course');
    Route::post('/remove-grade',                       [App\Http\Controllers\Admin\SchoolController::class, 'removeGrade'])->name('remove-grade');
    Route::post('grade/remove-section',                [App\Http\Controllers\Admin\SchoolController::class, 'removeGradeSection'])->name('grade.remove-section');
    Route::post('grade/section/remove-student',        [App\Http\Controllers\Admin\SchoolController::class, 'removeGradeSectionStudent'])->name('grade.section.remove-student');
    Route::post('grade/section/remove-course',        [App\Http\Controllers\Admin\SchoolController::class, 'removeGradeSectionCourse'])->name('grade.section.remove-course');
});

// Section Route
Route::group(['prefix' => 'section',             'as' => 'section.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\SectionController::class, 'index'])->name('index');
    Route::get('/data/all',                         [App\Http\Controllers\Admin\SectionController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\SectionController::class, 'create'])->name('create');
    Route::post('',                                    [App\Http\Controllers\Admin\SectionController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\SectionController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\SectionController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\SectionController::class, 'destroy'])->name('destroy');
});

// settings Route
Route::group(['prefix' => 'setting',             'as' => 'setting.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
    Route::get('/data/all',                         [App\Http\Controllers\Admin\SettingController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\SettingController::class, 'create'])->name('create');
    Route::post('/',                                    [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('update');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\SettingController::class, 'destroy'])->name('destroy');
});

// Course Route
Route::group(['prefix' => 'course',             'as' => 'course.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\CourseController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('create');
    Route::post('/',                                   [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('edit');
    Route::get('/view/{id}',                           [App\Http\Controllers\Admin\CourseController::class, 'view'])->name('view');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('update');
    Route::get('/chapters/{id}',                       [App\Http\Controllers\Admin\CourseController::class, 'chapters'])->name('chapters');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('destroy');
});

// Course Resource Route
Route::group(['prefix' => 'course-resource',             'as' => 'course-resource.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\CourseResourceController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\CourseResourceController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\CourseResourceController::class, 'create'])->name('create');
    Route::post('/',                                   [App\Http\Controllers\Admin\CourseResourceController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\CourseResourceController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\CourseResourceController::class, 'update'])->name('update');
    Route::get('/chapters/{id}',                       [App\Http\Controllers\Admin\CourseResourceController::class, 'chapters'])->name('chapters');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\CourseResourceController::class, 'destroy'])->name('destroy');
});

// Chapter Route
Route::group(['prefix' => 'chapters',             'as' => 'chapters.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\ChapterController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\ChapterController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\ChapterController::class, 'create'])->name('create');
    Route::post('/',                                   [App\Http\Controllers\Admin\ChapterController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\ChapterController::class, 'edit'])->name('edit');
    Route::post('/update/{id}',                         [App\Http\Controllers\Admin\ChapterController::class, 'update'])->name('update');
    Route::put('/chapters/{id}',                         [App\Http\Controllers\Admin\ChapterController::class, 'chapters'])->name('chapters');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\ChapterController::class, 'destroy'])->name('destroy');
});

// Teacher Route
Route::group(['prefix' => 'teachers',             'as' => 'teachers.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\TeacherController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\TeacherController::class, 'getData'])->name('data');
    Route::get('/courses/{id}',                        [App\Http\Controllers\Admin\TeacherController::class, 'courses'])->name('courses');
    Route::get('/create',                              [App\Http\Controllers\Admin\TeacherController::class, 'create'])->name('create');
    Route::post('/',                                   [App\Http\Controllers\Admin\TeacherController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\TeacherController::class, 'edit'])->name('edit');
    Route::post('/update/{id}',                        [App\Http\Controllers\Admin\TeacherController::class, 'update'])->name('update');
    Route::put('/chapters/{id}',                       [App\Http\Controllers\Admin\TeacherController::class, 'chapters'])->name('chapters');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\TeacherController::class, 'destroy'])->name('destroy');
});

// Student Route
Route::group(['prefix' => 'students',             'as' => 'students.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\StudentController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('create');
    Route::post('/',                                   [App\Http\Controllers\Admin\StudentController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('edit');
    Route::post('/update/{id}',                         [App\Http\Controllers\Admin\StudentController::class, 'update'])->name('update');
    Route::put('/chapters/{id}',                         [App\Http\Controllers\Admin\StudentController::class, 'chapters'])->name('chapters');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('destroy');
});

// Chapter Category Route
Route::group(['prefix' => 'chapter-category',             'as' => 'chapter-category.'], function () {
    Route::get('/',                                    [App\Http\Controllers\Admin\ChapterCategoryController::class, 'index'])->name('index');
    Route::get('/data/all',                            [App\Http\Controllers\Admin\ChapterCategoryController::class, 'getData'])->name('data');
    Route::get('/create',                              [App\Http\Controllers\Admin\ChapterCategoryController::class, 'create'])->name('create');
    Route::post('/',                                   [App\Http\Controllers\Admin\ChapterCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}',                           [App\Http\Controllers\Admin\ChapterCategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{id}',                         [App\Http\Controllers\Admin\ChapterCategoryController::class, 'update'])->name('update');
    Route::put('/chapters/{id}',                       [App\Http\Controllers\Admin\ChapterCategoryController::class, 'chapters'])->name('chapters');
    Route::delete('/{id}',                             [App\Http\Controllers\Admin\ChapterCategoryController::class, 'destroy'])->name('destroy');
});

