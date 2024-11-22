<?php

            namespace App\Repositories;
            use Illuminate\Http\Request;
            use App\Models\School;
            use App\Repositories\CourseRepositoryInterface;
            use App\Http\Requests\SchoolRequest;

            class SchoolRepository extends DM_BaseRepository implements SchoolRepositoryInterface
            {
                protected $course;
                public function __construct()
                {
                }

                public function getAll()
                {
                    return School::all();
                }
                public function getActiveSchool(){
                    return School::where('status', 1)->get();
                }

                public function getById($id)
                {
                    return School::findOrFail($id);
                }

                public function create(SchoolRequest $request)
                {
                    return School::create([
                        'name'=>$request->name,
                        'unique_key'=>parent::generateUniqueRandomNumber('schools', 'unique_key')
                    ]);
                }

                public function update($id, SchoolRequest $request)
                {
                    $model = $this->getById($id);
                    $model->update([
                        'name'=>$request->name,
                    ]);
                    return $model;
                }

                public function getAllCourse()
                {
                    // Resolve the CourseRepositoryInterface instance
                    $courseRepository = app(CourseRepositoryInterface::class);
                    
                    // Call the getActiveCourse method
                    return $courseRepository->getActiveCourse();
                }

                public function getAllGrade()
                {
                    // Resolve the CourseRepositoryInterface instance
                   return app(GradeRepositoryInterface::class)->getActiveGrade();
                }

                public function addGrade(Request $request){
                    // Resolve the CourseRepositoryInterface instance
                    $gradeRepository = app(GradeRepositoryInterface::class);
                    
                    // Call the getActiveCourse method
                    $grade = $gradeRepository->getById($request->grade_id);

                    // Add the grade to the school
                    $school = $this->getById($request->school_id);
                    if ($school->grades()->where('grade_id', $grade->id)->exists()) {
                        return 'This grade is already associated with the school.';
                    }else{
                        $school->grades()->attach($grade->id);
                        return "Grade added successfully !!";
                    }
                    
                }

                public function schoolGradeSection($school_id, $grade_id){
                    $school = $this->getById($school_id);
                    $sectionRepository = app(SectionRepositoryInterface::class);
                    $section =  $school->schoolGradeSections()
                                    ->where('grade_id', $grade_id)
                                    ->with('section')
                                    ->get();
                    $allSection = $sectionRepository->getActiveSection();
                    return ['sections' => $section, 'allSection' => $allSection];

                }

                public function addGradeSection(Request $request){
                    $school_id = $request->school_id;

                    $grade_id = $request->grade_id;
                    $section_id = $request->section_id;
                    $school = $this->getById($school_id);
                    $existing = $school->schoolGradeSections()
                        ->where('grade_id', $grade_id)
                        ->where('section_id', $section_id)
                        ->exists();

                    if (!$existing) {
                        // Add new record if it doesn't exist
                        $school->schoolGradeSections()->create([
                            'grade_id' => $grade_id,
                            'section_id' => $section_id,
                        ]);
                        return response()->json(['message' => 'Record added successfully']);
                    } else {
                        return response()->json(['message' => 'Record already exists']);
                    }
                }
                public function removeGradeSection(Request $request){
                    $school_id = $request->school_id;
                    $grade_id = $request->grade_id;
                    $section_id = $request->section_id;
                    $school = $this->getById($school_id);
                    $school->schoolGradeSections()
                        ->where('grade_id', $grade_id)
                        ->where('section_id', $section_id)
                        ->delete();
                    return response()->json(['message' => 'Record deleted successfully']);

                }


                public function removeGrade(Request $request){
                    // Resolve the CourseRepositoryInterface instance
                    $gradeRepository = app(GradeRepositoryInterface::class);
                    
                    // Call the getActiveCourse method
                    $grade = $gradeRepository->getById($request->grade_id);

                    // Remove the grade from the school
                    $school = $this->getById($request->school_id);
                    $school->grades()->detach($grade->id);
                    return $school;
                }

                public function gradeSectionStudent($school_id, $grade_id, $section_id){
                    $school = $this->getById($school_id);
                    // $students = $school->schoolGradeSections()
                    //                     ->where('grade_id', $grade_id)
                    //                     ->where('section_id', $section_id)
                    //                     ->with('schoolGradeSectionGradeStudent.student.user')
                    //                     ->get();
                        $students = $school->schoolGradeSections()
                                            ->where('grade_id', $grade_id)
                                            ->where('section_id', $section_id)
                                            // ->with('schoolGradeSectionGradeStudent.student.user: id, name, email') // Load related data
                                            ->with([
                                                'schoolGradeSectionGradeStudent.student.user:id,name,email'
                                            ]) 
                                            ->first();
                                
                    $studentRepository = app(StudentRepositoryInterface::class);
                    $allStudent = $studentRepository->getStudentBySchool($school_id);
                    
                    return response()->json(['students' => $students, 'allStudent' => $allStudent]);
                   
                }

                public function addGradeSectionStudent(Request $request){
                    $school = $this->getById($request->school_id);
                    $gradeSection = $school->schoolGradeSections()
                                            ->where('grade_id', $request->grade_id)
                                            ->where('section_id', $request->section_id)
                                            ->first();

                    if (!$gradeSection) {
                        return response()->json(['message' => 'Grade or Section not found in this school'], 404);
                    }

                    if($gradeSection->schoolGradeSectionGradeStudent()->where('student_id', $request->student_id)->exists()) {
                        return response()->json(['message' => 'Student already exists in this grade and section'], 409);
                    }
                    // Add the student to the grade and section
                    $gradeSection->schoolGradeSectionGradeStudent()->create([
                        'student_id' => $request->student_id,
                    ]);
                    return response()->json(['message' => 'Student added successfully to this grade and section'], 201);
                }

                public function removeGradeSectionStudent(Request $request)
                {
                    $school = $this->getById($request->school_id);

                    if (!$school) {
                        return response()->json(['message' => 'School not found'], 404);
                    }

                    $gradeSection = $school->schoolGradeSections()
                        ->where('grade_id', $request->grade_id)
                        ->where('section_id', $request->section_id)
                        ->first();

                    if (!$gradeSection) {
                        return response()->json(['message' => 'Grade or Section not found in this school'], 404);
                    }

                    $studentRemoved = $gradeSection->schoolGradeSectionGradeStudent()
                        ->where('student_id', $request->student_id)
                        ->delete();

                    if (!$studentRemoved) {
                        return response()->json(['message' => 'Student not found in this grade and section'], 404);
                    }

                    return response()->json(['message' => 'Student removed successfully from this grade and section'], 200);
                }

                

                public function gradeSectionCourse($student_id, $grade_id, $section_id){
                    $school = $this->getById($student_id);
                    // $courses = $school->schoolGradeSections->where('grade_id', $grade_id)
                    //                                     ->where('section_id', $section_id)
                    //                                     ->with('schoolSectionGradeCourses.course')
                    //                                     ->first();

                    $courses = $school->schoolGradeSections()
                                    ->where('grade_id', $grade_id)
                                    ->where('section_id', $section_id)
                                    // ->with(['schoolSectionGradeCourses.course'])
                                    // ->with(['schoolSectionGradeCourses.schoolGradeSectionCourseTeacher'])
                                    ->with([
                                        'schoolSectionGradeCourses.course:id,title',
                                        'schoolSectionGradeCourses.latestSchoolGradeSectionCourseTeacher.teacher.user:id,name'
                                    ])
                                    ->first();
                    $courseRepository = app(CourseRepositoryInterface::class);
                    $allCourse = $courseRepository->getActiveCourse();

                    return ['courses'=>$courses, 'allCourses'=>$allCourse];

                }
                // public function addGradeSectionCourse(Request $request){
                //     $school = $this->getById($request->school_id);
                //     $courses = $school->schoolGradeSections()
                //                     ->where('grade_id', $request->grade_id)
                //                     ->where('section_id', $request->section_id)
                //                     ->where('course_id', $request->course_id)
                //                     ->exists();
                //     if($courses){
                //         return "Course is already associated with this grade and section.";
                //     } else{
                //         $school->schoolGradeSections()->create([
                //             'school_grade_section_id' => $courses->id,
                //            'course_id' => $request->course_id,
                //         ]);
                //         return "Course added successfully to this grade and section.";
                //     }
                    
                // }
                public function addGradeSectionCourse(Request $request)
                {
                    $school = $this->getById($request->school_id);

                    // Find the specific grade-section combination
                    $schoolGradeSection = $school->schoolGradeSections()
                        ->where('grade_id', $request->grade_id)
                        ->where('section_id', $request->section_id)
                        ->first();

                    if (!$schoolGradeSection) {
                        return response()->json(['error' => 'Grade and section combination not found.'], 404);
                    }

                    // Check if the course is already associated
                    $courseExists = $schoolGradeSection->schoolSectionGradeCourses()
                        ->where('course_id', $request->course_id)
                        ->exists();

                    if ($courseExists) {
                        return response()->json(['message' => 'Course is already associated with this grade and section.'], 400);
                    }

                    // Add the course through the relationship
                    $schoolGradeSection->schoolSectionGradeCourses()->create([
                        'course_id' => $request->course_id,
                    ]);

                    return response()->json(['message' => 'Course added successfully to this grade and section.']);
                }

                public function removeGradeSectionCourse(Request $request){
                    $school = $this->getById($request->school_id);

                    // Find the specific grade-section combination
                    $schoolGradeSection = $school->schoolGradeSections()
                        ->where('grade_id', $request->grade_id)
                        ->where('section_id', $request->section_id)
                        ->first();

                    if (!$schoolGradeSection) {
                        return response()->json(['error' => 'Grade and section combination not found.'], 404);
                    }

                    // Remove the course through the relationship
                    $schoolGradeSection->schoolSectionGradeCourses()
                        ->where('course_id', $request->course_id)
                        ->delete();

                    return response()->json(['message' => 'Course removed successfully from this grade and section.']);
                }

                public function gradeSectionCourseTeacher($student_id, $grade_id, $section_id){
                    $school = $this->getById($student_id);
                    $courses = $school->schoolGradeSections()
                                    ->where('grade_id', $grade_id)
                                    ->where('section_id', $section_id)
                                    ->with(['schoolSectionGradeCourses.teacher'])
                                    ->first();
                    $courseRepository = app(TeacherRepositoryInterface::class);
                    $allCourse = $courseRepository->getActiveCourse();

                    return ['courses'=>$courses, 'allCourses'=>$allCourse];
                }

                public function getAllTeacher(){
                    $teacherRepository = app(TeacherRepositoryInterface::class);
                    return response($teacherRepository->getAll());
                }

                // public function gradeSectionCourseAssignTeacher(Request $request){
                //     $school = $this->getById($request->school_id);
                //     $schoolGradeSection = $school->schoolGradeSections()
                //                                 ->where('section_id', $request->section_id)
                //                                 ->where('grade_id', $request->grade_id)
                //                                 ->with('schoolSectionGradeCourses')
                //                                 ->first();
                // }

                public function gradeSectionCourseAssignTeacher(Request $request)
                {
                    // Retrieve the school by ID
                    $school = $this->getById($request->school_id);

                    // Find the specific SchoolGradeSection with the related schoolSectionGradeCourses
                    $schoolGradeSection = $school->schoolGradeSections()
                        ->where('section_id', $request->section_id)
                        ->where('grade_id', $request->grade_id)
                        ->with('schoolSectionGradeCourses')
                        ->first();

                    if (!$schoolGradeSection) {
                        return response()->json(['message' => 'Grade Section not found'], 404);
                    }

                    // Find the related schoolSectionGradeCourses matching course_id
                    $schoolSectionGradeCourse = $schoolGradeSection->schoolSectionGradeCourses
                        ->where('course_id', $request->course_id)
                        ->first();

                    if (!$schoolSectionGradeCourse) {
                        return response()->json(['message' => 'Course not found'], 404);
                    }
                    $teacherExist = $schoolSectionGradeCourse->schoolGradeSectionCourseTeacher()
                                                            ->where('teacher_id', $request->teacher_id)
                                                            ->exists();
                    if($teacherExist){
                        return response()->json(['message'=>"This Teacher already assigned to this course section !"]);
                    }
                    $schoolSectionGradeCourse->schoolGradeSectionCourseTeacher()->create([
                        'teacher_id' => $request->teacher_id
                    ]);

                    return response()->json(['message' => 'Teacher assigned successfully']);
                }

                public function delete($id)
                {
                    $model = School::findOrFail($id);
                    return $model->delete();
                }
            }
            