<?php

            namespace App\Repositories;
            use App\Http\Requests\SchoolRequest;
            use Illuminate\Http\Request;
            interface SchoolRepositoryInterface
            {
                public function getAll();
                public function getActiveSchool();
                public function getAllCourse();
                public function getAllGrade();
                public function addGrade(Request $request);
                public function removeGrade(Request $request);
                public function schoolGradeSection($school_id, $grade_id);
                public function getById($id);
                public function create(SchoolRequest $request);
                public function update($id, SchoolRequest $request);
                public function delete($id);
            }
            