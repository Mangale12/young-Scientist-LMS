<?php

            namespace App\Repositories;

            use App\Models\Student;
            use App\Models\User;
            use App\Http\Requests\StudentRequest;
            use DB;
            use Illuminate\Support\Facades\Log; 

            class StudentRepository extends DM_BaseRepository implements StudentRepositoryInterface
            {
                public function getAll()
                {
                    return Student::whereHas('user')->with('user')->get();
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
            