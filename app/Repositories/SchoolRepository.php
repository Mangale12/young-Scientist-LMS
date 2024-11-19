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
                                    ->get();
                    $allSection = $sectionRepository->getActiveSection();
                    return ['sections' => $section, 'allSection' => $allSection];

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

                public function delete($id)
                {
                    $model = School::findOrFail($id);
                    return $model->delete();
                }
            }
            