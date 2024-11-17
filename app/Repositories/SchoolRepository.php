<?php

            namespace App\Repositories;

            use App\Models\School;
            use App\Http\Requests\SchoolRequest;

            class SchoolRepository extends DM_BaseRepository implements SchoolRepositoryInterface
            {
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

                public function delete($id)
                {
                    $model = School::findOrFail($id);
                    return $model->delete();
                }
            }
            