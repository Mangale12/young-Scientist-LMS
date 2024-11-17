<?php

            namespace App\Repositories;
            use App\Http\Requests\CourseResourceRequest;
            interface CourseResourceRepositoryInterface
            {
                public function getAll();
                public function getActiveData();
                public function getById($id);
                public function create(CourseResourceRequest $request);
                public function update($id, CourseResourceRequest $request);
                public function delete($id);
            }
            