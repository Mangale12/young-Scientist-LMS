<?php

            namespace App\Repositories;
            use App\Http\Requests\StudentRequest;

            interface StudentRepositoryInterface
            {
                public function getAll();
                public function getStudentBySchool($student_id);
                public function courses($id);
                public function coursesChapterCount($courseId);
                public function courseDetails($unique_id);
                public function getById($id);
                public function create(StudentRequest $request);
                public function update($id, StudentRequest $request);
                public function delete($id);
                public function getSchool();
                public function getGrade();
                public function getSection();
                public function topicDetails($course_id, $chapter_id, $topic_id);
                public function assignMentSubmission($student_id, $request);
                public function assignmentList($id);
            }
            