<?php

            namespace App\Repositories;
            use App\Http\Requests\ChapterCategoryRequest;
            use App\Models\ChapterCategory;

            class ChapterCategoryRepository extends DM_BaseRepository implements ChapterCategoryRepositoryInterface
            {
                public function getAll()
                {
                    return ChapterCategory::all();
                }

                public function getById($id)
                {
                    return ChapterCategory::findOrFail($id);
                }

                public function create(ChapterCategoryRequest $request)
                {
                    return ChapterCategory::create([
                        'name' => $request->name,
                        'status' => $request->status,
                        'unique_id' => parent::generateUniqueRandomNumber('chapter_categories', 'unique_id'),
                        
                    ]);
                }

                public function update($id, ChapterCategoryRequest $request)
                {
                    $model = $this->getById($id);
                    $model->update([
                        'name' => $request->name,
                       'status' => $request->status,
                    ]);
                    return true;
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            