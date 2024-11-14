<?php

            namespace App\Repositories;
            use App\Http\Requests\ChapterRequest;
            interface ChapterRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(ChapterRequest $request);
                public function update($id, ChapterRequest $request);
                public function delete($id);
            }
            