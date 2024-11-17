<?php

            namespace App\Repositories;
            use App\Http\Requests\CourseRequest;
            interface CourseRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function getChapterCategory();
                public function getCourseResource();
                public function getAllTeacher();
                public function getAllSchool();
                public function create(CourseRequest $request);
                public function update($id, CourseRequest $request);
                public function delete($id);
            }
            