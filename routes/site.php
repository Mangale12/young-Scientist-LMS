<?php

Route::get('/', [App\Http\Controllers\Site\SiteController::class, 'index'])->name('index');

Route::post('/', [App\Http\Controllers\Admin\StudentController::class, 'store'])->name('student.store');

Route::group(['prefix'=>'student', 'as'=>'student.', 'middleware'=>'role:admin'], function(){
    Route::get('/about', [App\Http\Controllers\Site\StudentController::class, 'about'])->name('about');
    Route::get('/contact', [App\Http\Controllers\Site\StudentController::class, 'contact'])->name('contact');
    Route::get('/dashboard', [App\Http\Controllers\Admin\StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/course-list', [App\Http\Controllers\Admin\StudentController::class, 'courses'])->name('courses');
    Route::get('/course/chapter-count/|{course_id}', [App\Http\Controllers\Admin\StudentController::class, 'coursesChapterCount'])->name('course-chapter-count');
    Route::get('/course-details/{unique_id}', [App\Http\Controllers\Admin\StudentController::class, 'courseDetails'])->name('course-details');
    Route::get('/course-details/{course_id}/chapter/{chapter_id}/topic/{topic_id}', [App\Http\Controllers\Admin\StudentController::class, 'topicDetails'])->name('topic-details');
    Route::post('assignment-submission', [App\Http\Controllers\Admin\StudentController::class, 'assignMentSubmission'])->name('assignment-submision');
    // Route::get('/course-details/{course_id}//topic/{topic_id}', [App\Http\Controllers\Admin\StudentController::class, 'ajaxTopicDetails'])->name('ajax-topic-details');
    Route::get('/course/assignment/{course_id}', [App\Http\Controllers\Admin\StudentController::class, 'courseAssignment'])->name('course.assignments');
    Route::get('/{school_id}/course/{course_id}/assignment/submit/{assignment_id}', [App\Http\Controllers\Admin\StudentController::class, 'courseAssignmentSubmit'])->name('assignment.submits');
    Route::get('/asssignment-list', [App\Http\Controllers\Admin\StudentController::class, 'assignmentList'])->name('assignment-list');

});
// teacher routes

Route::group(['prefix'=>'teacher', 'as'=>'teacher.'], function(){
    Route::post('/', [App\Http\Controllers\Admin\TeacherController::class, 'store'])->name('store');
    Route::get('/about', [App\Http\Controllers\Site\TeacherController::class, 'about'])->name('about');
    Route::get('/contact', [App\Http\Controllers\Site\TeacherController::class, 'contact'])->name('contact');
    Route::get('/dashboard', [App\Http\Controllers\Admin\TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('/course-list', [App\Http\Controllers\Admin\TeacherController::class, 'courseList'])->name('courses');
    Route::get('/course/assignment/{course_id}', [App\Http\Controllers\Admin\TeacherController::class, 'courseAssignment'])->name('course.assignments');
    Route::get('/{school_id}/course/{course_id}/assignment/submit/{assignment_id}', [App\Http\Controllers\Admin\TeacherController::class, 'courseAssignmentSubmit'])->name('assignment.submits');
    Route::post('assignment/feedback', [App\Http\Controllers\Admin\TeacherController::class, 'feedback'])->name('feedback');
    Route::get('/course/chapter-count/|{course_id}', [App\Http\Controllers\Admin\TeacherController::class, 'coursesChapterCount'])->name('course-chapter-count');
    Route::get('/course-details/{unique_id}', [App\Http\Controllers\Admin\TeacherController::class, 'courseDetails'])->name('course-details');
    Route::get('/course-details/{course_id}/chapter/{chapter_id}/topic/{topic_id}', [App\Http\Controllers\Admin\TeacherController::class, 'topicDetails'])->name('topic-details');
    Route::post('/asssignment-subbmission', [App\Http\Controllers\Admin\TeacherController::class, 'teacherFeedback'])->name('assignment-submision');
    Route::get('/asssignment-list', [App\Http\Controllers\Admin\TeacherController::class, 'assignmentList'])->name('assignment-list');
    Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
});
Route::get('/', [App\Http\Controllers\Site\SiteController::class, 'index'])->name('');