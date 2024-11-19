<?php

            namespace App\Repositories;

            use App\Models\Section;
            use App\Http\Requests\SectionRequest;
            class SectionRepository extends DM_BaseRepository implements SectionRepositoryInterface
            {
                public function getAll()
                {
                    return Section::all();
                }
                public function getActiveSection(){
                    return Section::where('status', 1)->get();
                }

                public function getById($id)
                {
                    return Section::findOrFail($id);
                }

                public function create(SectionRequest $request)
                {
                    return Section::create([
                        'name'=>$request->name,
                        'unique_key'=>parent::generateUniqueRandomNumber('schools', 'unique_key'),
                    ]);
                }

                public function update($id, SectionRequest $request)
                {
                    $model = $this->getByIdl($id);
                    $model->update([
                        'name'=>$request->name,
                    ]);
                    return $model;
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            