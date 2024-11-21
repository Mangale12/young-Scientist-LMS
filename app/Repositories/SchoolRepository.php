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
                    $students = $school->schoolGradeSectionGradeStudent()
                                        ->where('grade_id', $grade_id)
                                        ->where('section_id', $section_id)
                                        ->with('student.user') // Eager load the related student and user
                                        ->get();
                    $studentRepository = app(StudentRepositoryInterface::class);
                    $allStudent = $studentRepository->getStudentBySchool($school_id);
                    
                    return ['students' => $students, 'allStudent' => $allStudent];
                   
                }

                public function removeGradeSectionStudent(Request $request){
                    $school = $this->getById($request->school_id);
                    $school->schoolGradeSectionGradeStudent()
                                        ->where('grade_id', $request->grade_id)
                                        ->where('section_id', $request->section_id)
                                        ->where('student_id', $request->student_id)
                                        ->delete();
                    return "Student removed successfully from this grade and section.";
                }

                public function addGradeSectionStudent(Request $request){
                    $school = $this->getById($request->school_id);
                    $students = $school->schoolGradeSectionGradeStudent()
                                        ->where('grade_id', $request->grade_id)
                                        ->where('section_id', $request->section_id)
                                        ->where('student_id', $request->student_id)
                                        ->exists();
                    if($students){
                        return "Student is already associated with this grade and section.";
                    }else{
                        $school->schoolGradeSectionGradeStudent()->create([
                            'grade_id' => $request->grade_id,
                           'section_id' => $request->section_id,
                           'student_id' => $request->student_id,
                        ]);
                        return "Student added successfully to this grade and section.";
                    }
                    
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
                                        'schoolSectionGradeCourses.schoolGradeSectionCourseTeacher:id,teacher_id'
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


                public function delete($id)
                {
                    $model = School::findOrFail($id);
                    return $model->delete();
                }
            }
            