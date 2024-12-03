<?php

            namespace App\Repositories;
            use App\Http\Requests\TeacherRequest;
            use App\Http\Requests\TeacherFeedbackRequest;
            interface TeacherRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(TeacherRequest $request);
                public function update($id, TeacherRequest $request);
                public function delete($id);
                public function courseList($id);
                public function assignmentList($teacher_id);
                public function courseAssignment($course_id);
                public function feedback(TeacherFeedbackRequest $request);
                public function courseAssignmentSubmit($school_id, $course_id, $assignment_id);
            }
            