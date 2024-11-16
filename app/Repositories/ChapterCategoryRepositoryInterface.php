<?php

            namespace App\Repositories;
            use App\Http\Requests\ChapterCategoryRequest;
            interface ChapterCategoryRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function getActiveData();  // Assuming 'active' status is defined in the ChapterCategory model. 
                public function create(ChapterCategoryRequest $request);
                public function update($id, ChapterCategoryRequest $request);
                public function delete($id);
            }
            