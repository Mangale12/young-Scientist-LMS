<?php

            namespace App\Repositories;

            use App\Models\Grade;
            use App\Http\Requests\GradeRequest;

            class GradeRepository extends DM_BaseRepository implements GradeRepositoryInterface 
            {
                public function getAll()
                {
                    return Grade::all();
                }

                public function getActiveGrade(){
                    return Grade::where('status', 1)->get();
                }

                public function getById($id)
                {
                    return Grade::findOrFail($id);
                }

                public function create(GradeRequest $data)
                {
                    return Grade::create([
                        'name'=>$data->name,
                        'unique_key'=>parent::generateUniqueRandomNumber('grades', 'unique_key'),
                    ]);
                }

                public function update($id, GradeRequest $data)
                {
                    $model = $this->getById($id);
                    $model->update([
                        'name'=>$data->name
                    ]);
                    return $model;
                }

                public function delete($id)
                {
                    $model = Grade::findOrFail($id);
                    return $model->delete();
                }
            }
            