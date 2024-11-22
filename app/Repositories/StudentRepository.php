<?php

            namespace App\Repositories;

            use App\Models\Student;
            use App\Models\User;
            use App\Http\Requests\StudentRequest;
            use DB;
            use Illuminate\Support\Facades\Log; 

            class StudentRepository extends DM_BaseRepository implements StudentRepositoryInterface
            {
                private $courseRepository;
                public function __construct(CourseRepositoryInterface $courseRepository){
                    $this->courseRepository = $courseRepository;
                }
                public function getAll()
                {
                    return Student::whereHas('user')->with('user')->get();
                }


                public function courses($id)
                {
                    // Retrieve the student by ID
                    $student = $this->getById(2);
                    
                    if (!$student) {
                        return response()->json(['message' => 'Student not found'], 404);
                    }
                
                    // Eager load related data for courses
                    $courses = $student->schoolSectionGradeStudent()
                        ->with(['schoolGradeSection.schoolSectionGradeCourses.course:id,title,unique_id,thumbnail'])
                        ->first();
                
                    return response()->json($courses, 200);
                }
                
                public function coursesChapterCount($courseId){
                    
                    return response()->json($this->courseRepository->getChapterCount($courseId));
                }

                public function courseDetails($unique_id){
                    return response()->json($this->courseRepository->getByUniqueId($unique_id));
                }

                public function getStudentBySchool($school_id){
                    return Student::whereHas('user')
                                    ->with('user')
                                    ->where('school_id', $school_id)
                                    ->get();
                }

                public function getById($id)
                {
                    return Student::findOrFail($id);
                }

                public function create(StudentRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $user = User::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'unique_id'=>parent::generateUniqueRandomNumber('users', 'unique_id'),
                            'password'=>bcrypt($request->password), // Default password for new users
                        ]);
                        $student = Student::create([
                            'user_id'=>$user->id,
                            'student_id'=>$request->student_id,
                            'school_id'=>$request->school_id,
                            'grade_id'=>$request->grade_id,
                            'section_id'=>$request->section_id,
                            'address'=>$request->address,
                            'dob'=>$request->dob,
                            'parent_phone'=>$request->parent_phone,
                            'parent_email'=>$request->parent_email,
                        ]);
                        DB::commit();
                        return true;
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return $th;
                        Log::info($th);
                        return false;
                        //throw $th;
                    }
                }

                public function update($id, StudentRequest $request)
                {
                    $model = $this->getById($id);
                    $model->update($data);
                    return $model;
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }

                public function getSchool(){
                    $model = new SchoolRepositoryInterface();
                    return $model->getAll();
                }
                public function getGrade(){
                    $model = new GradeRepositoryInterface();
                    return $model->getAll();
                }
                public function getSection(){
                    $model = new SectionRepositoryInterface();
                    return $model->getAll();
                }
            }
            