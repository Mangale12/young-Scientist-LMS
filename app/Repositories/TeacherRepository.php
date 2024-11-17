<?php

            namespace App\Repositories;
            use App\Http\Requests\TeacherRequest;
            use DB;
            use Illuminate\Support\Facades\Log; 
            use App\Models\Teacher;
            use App\Models\User;

            class TeacherRepository extends DM_BaseRepository implements TeacherRepositoryInterface
            {
                public function getAll()
                {
                    return Teacher::whereHas('user')->with('user')->get();
                }

                public function getById($id)
                {
                    return Teacher::findOrFail($id);
                }

                public function create(TeacherRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $user = User::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'unique_id'=>parent::generateUniqueRandomNumber('users', 'unique_id'),
                            'password'=>bcrypt($request->password),
                            'status'=>'inactive',
                            'phone'=>$request->phone,
                            'role'=>'teacher',
                        ]);
                        Teacher::create([
                            'teacher_id'=>$request->teacher_id,
                            'subject_expert'=>$request->subject_expert,
                            'user_id'=>$user->id,
                        ]);
                        DB::commit();
                        return true;
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return $th;
                        Log::info($th);
                        return false;
                    }
                    

                    return Teacher::create($request);
                }

                public function update($id, TeacherRequest $request)
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
            }
            