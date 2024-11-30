<?php

            namespace App\Repositories;
            use App\Http\Requests\TeacherRequest;
            use DB;
            use Illuminate\Support\Facades\Log; 
            use App\Models\Teacher;
            use App\Models\User;

            class TeacherRepository extends DM_BaseRepository implements TeacherRepositoryInterface
            {
                
                public function getAll()
                {
                    return Teacher::whereHas('user')->with('user')->get();
                }

                public function getById($id)
                {
                    return Teacher::findOrFail($id);
                }

                public function create(TeacherRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $user = User::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'unique_id'=>parent::generateUniqueRandomNumber('users', 'unique_id'),
                            'password'=>bcrypt($request->password),
                            'status'=>'inactive',
                            'phone'=>$request->phone,
                            'role'=>'teacher',
                        ]);
                        Teacher::create([
                            'teacher_id'=>$request->teacher_id,
                            'subject_expert'=>$request->subject_expert,
                            'user_id'=>$user->id,
                        ]);
                        DB::commit();
                        return true;
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return $th;
                        Log::info($th);
                        return false;
                    }
                    

                    return Teacher::create($request);
                }

                public function update($id, TeacherRequest $request)
                {
                    $model = $this->getById($id);
                    $model->update($data);
                    return $model;
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }

                // teacher fiunction staart

                public function courseList($id)
                {
                    // Retrieve the teacher by ID
                    $teacher = $this->getById($id);
                
                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }
                
                    // Eager load the related courses and their details
                    $teacher->load([
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.course'
                    ]);
                
                    // Format the response to include nested course details
                    $courses = $teacher->schoolGradeSectionCourseTeacher->map(function ($item) {
                        $schoolGradeCourse = $item->schoolGradeSectionCourse;
                
                        // Check if course data exists
                        $courseDetails = $schoolGradeCourse->course ?? null;
                
                        return [
                            'school_grade_course_id' => $schoolGradeCourse->id ?? null,
                            'school_grade_section_id' => $schoolGradeCourse->school_grade_section_id ?? null,
                            'course_id' => $courseDetails->id ?? null,
                            'course_title' => $courseDetails->title ?? 'No Title Available',
                            'course_description' => $courseDetails->description ?? 'No Description Available',
                            'unique_id' => $courseDetails->unique_id ?? 'N/A',
                            // Include any additional fields if necessary
                        ];
                    });
                
                    // Return the formatted response
                    return response()->json([
                        'teacher' => [
                            'id' => $teacher->id,
                            'name' => $teacher->name,
                            'unique_id' => $teacher->unique_id,
                            // Add other relevant teacher details if necessary
                        ],
                        'courses' => $courses,
                    ], 200);
                }
               
                // public function courseList($id)
                // {
                //     // Retrieve the teacher by ID
                //     $teacher = $this->getById($id);

                //     if (!$teacher) {
                //         return response()->json(['message' => 'Teacher not found'], 404);
                //     }

                //     // Eager load the related courses and their details
                //     $teacher->load([
                //         'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.course'
                //     ]);

                //     // Check if the teacher has any courses
                //     if ($teacher->schoolGradeSectionCourseTeacher->isEmpty()) {
                //         return response()->json([
                //             'teacher' => [
                //                 'id' => $teacher->id,
                //                 'name' => $teacher->name,
                //                 // Add other relevant teacher details if necessary
                //             ],
                //             'courses' => [],
                //             'message' => 'No courses found for this teacher.'
                //         ], 200);
                //     }

                //     // Format the response to include nested course details
                //     $courses = $teacher->schoolGradeSectionCourseTeacher->map(function ($item) {
                //         $schoolGradeCourse = $item->schoolGradeSectionCourse;

                //         // Check if course data exists
                //         $courseDetails = $schoolGradeCourse->course ?? null;

                //         return [
                //             'school_grade_course_id' => $schoolGradeCourse->id ?? null,
                //             'school_grade_section_id' => $schoolGradeCourse->school_grade_section_id ?? null,
                //             'course_id' => $courseDetails ? $courseDetails->id : null,
                //             'course_name' => $courseDetails ? $courseDetails->title : 'No Title Available',
                //             'course_description' => $courseDetails ? $courseDetails->description : 'No Description Available',
                //             'unique_id' => $courseDetails ? $courseDetails->unique_id : 'N/A',
                //             'thumbnail' => $courseDetails ? $courseDetails->thumbnail : null,
                //             // Include any additional fields if necessary
                //         ];
                //     });

                //     // Return the formatted response
                //     return response()->json([
                //         'teacher' => [
                //             'id' => $teacher->id,
                //             'name' => $teacher->name,
                //             // Add other relevant teacher details if necessary
                //         ],
                //         'courses' => $courses,
                //     ], 200);
                // }


                
                
                public function coursesChapterCount($courseId){
                    
                    return response()->json($this->courseRepository->getChapterCount($courseId));
                }

                // public function courseDetails($unique_id)
                // {
                //     $course = $this->courseRepository->getByUniqueId($unique_id);

                //     if (!$course) {
                //         return response()->json(['message' => 'Course not found'], 404);
                //     }

                //     // Eager load the chapter relationship along with its topics and chapterCategory
                //     $course->load([
                //         'chapter' => function ($query) {
                //             $query->select('id', 'course_id', 'title', 'chapter_category_id')
                //                   ->with([
                //                       'topics:id,chapter_id,title', // Include the foreign key `chapter_id`
                //                       'chapterCategory:id,name'
                //                   ]);
                //         }
                //     ]);
                    

                //     return response()->json(['course' => $course], 200);
                // }

                // public function courseDetails($unique_id)
                // {
                //     $courseRepository = app(CourseRepositoryInterface::class);
                //     $course = $courseRepository->getByUniqueId($unique_id);

                //     if (!$course) {
                //         return response()->json(['message' => 'Course not found'], 404);
                //     }

                //     $course->load([
                //         'chapter' => function ($query) {
                //             $query->select('id', 'course_id', 'title', 'chapter_category_id', 'unique_id')
                //                 ->with([
                //                     'topics:id,chapter_id,title,unique_id', // Include the foreign key `chapter_id`
                //                     'chapterCategory:id,name'
                //                 ]);
                //         }
                //     ]);

                //     return response()->json(['course' => $course]);
                // }

                public function courseDetails($course_unique_id)
                {
                    // Retrieve the teacher by ID
                    $teacher = $this->getById(1)->with([
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.course' => function ($query) use ($course_unique_id) {
                            $query->where('unique_id', $course_unique_id)
                                ->with([
                                    'chapter' => function ($query) {
                                        $query->select('id', 'course_id', 'title', 'chapter_category_id', 'unique_id')
                                            ->with([
                                                'topics:id,chapter_id,title,unique_id',
                                                'chapterCategory:id,name'
                                            ]);
                                    }
                                ]);
                        }
                    ])->first();

                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }

                    // Find the specific course
                    $course = optional($teacher->schoolGradeSectionCourseTeacher->first()->schoolGradeSectionCourse)->course;

                    if (!$course) {
                        return response()->json(['message' => 'Course not found for the given teacher'], 404);
                    }

                    return response()->json(['teacher' => $teacher, 'course' => $course]);
                }


                // public function topicDetails($course_id, $topicId){
                //     $course = $this->courseRepository->getByUniqueId($course_id);
                //     $course->load([
                //         'chapter.topics' => function ($query) use ($topic_id) {
                //             $query->where('unique_id', $topic_id);
                //         }
                //     ]);

                //     // Check for the topic under the specified chapter
                //     $chapter = $course->chapter->firstWhere('id', $chapter_id);
                //     $topic = $chapter ? $chapter->topics->first() : null;
                // }

                public function topicDetails($course_id, $chapter_id, $topic_id)
                {
                    // Fetch the course with its chapters and topics
                    $course = $this->courseRepository->getByUniqueId($course_id);

                    if (!$course) {
                        return response()->json(['message' => 'Course not found'], 404);
                    }

                    // Check if the chapter belongs to the course
                    $chapter = $course->chapter()->where('unique_id', $chapter_id)->first();
                    if (!$chapter) {
                        return response()->json(['message' => 'Chapter not found in this course'], 404);
                    }

                    // Fetch the topic from the chapter
                    $topic = $chapter->topics()
                                    ->where('unique_id', $topic_id)
                                    ->with('assignment')
                                    ->first();
                    if (!$topic) {
                        return response()->json(['message' => 'Topic not found in this chapter'], 404);
                    }

                    // Return the topic details
                    return response()->json([
                        'topic' => $topic,
                    ]);
                }


                public function assignmentList($teacher_id)
                {
                    // Fetch the teacher by ID
                    $teacher = $this->getById(1);

                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }

                    // Fetch assignments submitted to the teacher that are not viewed
                    $assignments = $teacher->assignmentSubmissions()
                        ->where('is_viewed', false)
                        ->with(['student', 'topic.chapter.course']) // Include related data
                        ->get();

                    if ($assignments->isEmpty()) {
                        return response()->json(['message' => 'No unviewed assignments found'], 404);
                    }

                    return response()->json(['assignments' => $assignments], 200);
                }


            }
            