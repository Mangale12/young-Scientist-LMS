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
                public function addGradeSection(Request $request);
                public function removeGradeSection(Request $request);
                public function gradeSectionStudent($student_id, $grade_id, $section_id);
                public function addGradeSectionStudent(Request $request);
                public function gradeSectionCourse($student_id, $grade_id, $section_id);
                public function addGradeSectionCourse(Request $request);
                public function removeGradeSectionCourse(Request $request); 
                public function gradeSectionCourseTeacher($student_id, $grade_id, $section_id);
                public function getAllTeacher();
                public function gradeSectionCourseAssignTeacher(Request $request);
                public function getById($id);
                public function create(SchoolRequest $request);
                public function update($id, SchoolRequest $request);
                public function delete($id);
            }
            