<?php

            namespace App\Repositories;
            use App\Http\Requests\CourseRequest;
            use App\Http\Requests\TopicRequest;
            interface CourseRepositoryInterface
            {
                public function getAll();
                public function getActiveCourse();
                public function getChapterCount($id);
                public function getByUniqueId($unique_id);
                public function getById($id);
                public function getChapterCategory();
                public function getYoutubeIdFromUrl($url);
                public function getAllCourseResource();
                public function getAllTeacher();
                public function getAllSchool();
                public function getAllGrade();
                public function create(CourseRequest $request);
                public function update($id, CourseRequest $request);
                public function topics($course_id, $chapter_id);
                public function topicsStore(TopicRequest $request);
                public function delete($id);
            }
            