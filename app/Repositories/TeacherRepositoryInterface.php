<?php

            namespace App\Repositories;
            use App\Http\Requests\TeacherRequest;
            interface TeacherRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(TeacherRequest $request);
                public function update($id, TeacherRequest $request);
                public function delete($id);
                public function courseList($id);
            }
            