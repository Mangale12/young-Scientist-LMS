<?php

            namespace App\Repositories;
            use App\Http\Requests\ChapterRequest;
            use App\Models\Chapter;

            class ChapterRepository extends DM_BaseRepository implements ChapterRepositoryInterface
            {
                public function getAll()
                {
                    return Chapter::all();
                }

                public function getById($id)
                {
                    return Chapter::findOrFail($id);
                }

                public function create(ChapterRequest $request)
                {
                    return Chapter::create($request);
                }

                public function update($id, ChapterRequest $request)
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
            