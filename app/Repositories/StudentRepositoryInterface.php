<?php

            namespace App\Repositories;
            use App\Http\Requests\StudentRequest;

            interface StudentRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(StudentRequest $request);
                public function update($id, StudentRequest $request);
                public function delete($id);
                public function getSchool();
                public function getGrade();
                public function getSection();
            }
            