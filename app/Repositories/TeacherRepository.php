<?php

            namespace App\Repositories;
            use App\Http\Requests\TeacherRequest;
            use DB;
            use Illuminate\Support\Facades\Log; 
            use App\Models\Teacher;
            use App\Http\Requests\TeacherFeedbackRequest;
            use App\Models\User;

            class TeacherRepository extends DM_BaseRepository implements TeacherRepositoryInterface
            {
                protected $folder_path_image;
                protected $folder_path_file;
                protected $folder = 'teacher/feedback';
                protected $file   = 'file';
                protected $prefix_path_image = '/upload_file/teacher/feedback/';
                protected $prefix_path_file = '/upload_file/teacher/feedback/file/';
                public function __construct(){
                    $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                    $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                }
                
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
                            'school' => $schoolGradeCourse->schoolGradeSection->school ?? null,
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

                
                public function courseAssignment($course_id)
                {
                    // Get the teacher by ID (assuming you're using the teacher's unique ID for searching)
                    $teacher = $this->getById(1); // Replace with dynamic teacher ID if needed

                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }

                    // Eager load related courses, chapters, topics, and assignments
                    $teacher->load([
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.course.chapter.topics.assignment'
                    ]);

                    // Assuming the teacher has only one associated schoolGradeSectionCourseTeacher
                    $courseTeacher = $teacher->schoolGradeSectionCourseTeacher->first(); // Fetch the first course teacher

                    if (!$courseTeacher) {
                        return response()->json(['message' => 'Course Teacher not found'], 404);
                    }

                    // Get the course associated with the teacher's course
                    $course = $courseTeacher->schoolGradeSectionCourse->course->where('unique_id', $course_id)->first();

                    if (!$course) {
                        return response()->json(['message' => 'Course not found'], 404);
                    }

                    // Fetching assignments (since each topic has only one assignment)
                    $assignments = $course->chapter->flatMap(function ($chapter) {
                        return $chapter->topics->map(function ($topic) {
                            return $topic->assignment; // Fetch the single assignment for each topic
                        });
                    })->filter(function ($assignment) {
                        return $assignment !== null; // Remove null assignments
                    })->values()->toArray();

                    // Return all assignments as a JSON response
                    return response()->json(['assignments'=>$assignments]);
                }

                public function courseAssignmentSubmit($school_id, $course_id, $assignment_id)
                {
                    // Get the teacher by ID
                    $teacher = $this->getById(1); // Replace with dynamic teacher ID if needed

                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }

                    // Eager load related data with a constraint on the school
                    $teacher->load([
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.course.chapter.topics.assignment.assignmentSubmission',
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.schoolGradeSection.school'
                    ]);

                    // Filter courses by school_id
                    $courseTeacher = $teacher->schoolGradeSectionCourseTeacher
                        ->firstWhere('schoolGradeSectionCourse.schoolGradeSection.school.id', $school_id);

                    if (!$courseTeacher) {
                        return response()->json(['message' => 'No course found for the given school'], 404);
                    }

                    // Get the course associated with the teacher's course
                    $course = $courseTeacher->schoolGradeSectionCourse->course
                        ->where('unique_id', $course_id)
                        ->first();

                    if (!$course) {
                        return response()->json(['message' => 'Course not found'], 404);
                    }

                    // Fetch all submitted assignments securely by traversing the structure
                    $submittedAssignments = $course->chapter->flatMap(function ($chapter) use ($assignment_id, $course) {
                        return $chapter->topics->flatMap(function ($topic) use ($assignment_id, $course, $chapter) {
                            return $topic->assignment
                                ? $topic->assignment->assignmentSubmission->filter(function ($submission) use ($assignment_id) {
                                    return $submission->assignment_id == $assignment_id;
                                })->map(function ($submission) use ($course, $chapter) {
                                    return [
                                        'id' => $submission->id,
                                        'assignment_id' => $submission->assignment_id,
                                        'student_id' => $submission->student->id,
                                        'student_name' => $submission->student->user->name ?? 'unknown student',
                                        'submitted_at' => date('Y-m-d', strtotime($submission->created_at)),
                                        'course_title' => $course->title,
                                        'chapter_title' => $chapter->title,
                                        'school_name' => optional($course->school)->name ?? 'Unknown School',
                                    ];
                                })
                                : collect();
                        });
                    })->filter()->values()->toArray();

                    // Return all submitted assignments as a JSON response
                    return response()->json(['submitted_assignments' => $submittedAssignments]);
                }

                public function feedback(TeacherFeedbackRequest $request)
                {
                    $teacher = $this->getById(1);

                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }

                    // Eager load related data
                    $teacher->load([
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.course.chapter.topics.assignment.assignmentSubmission',
                        'schoolGradeSectionCourseTeacher.schoolGradeSectionCourse.schoolGradeSection.school'
                    ]);

                    // Find the assignment submission
                    $submission = $teacher->schoolGradeSectionCourseTeacher
                        ->flatMap(function ($courseTeacher) {
                            return $courseTeacher->schoolGradeSectionCourse->course->chapter->flatMap(function ($chapter) {
                                return $chapter->topics->flatMap(function ($topic) {
                                    return $topic->assignment->assignmentSubmission ?? collect();
                                });
                            });
                        })
                        ->firstWhere('id', $request->assignment_submission_id);

                    if (!$submission) {
                        return response()->json(['message' => 'Assignment submission not found'], 404);
                    }
                    $filePath = null;
                    if ($request->hasFile('feedback_file')) {
                        $file_path = parent::uploadImage($request->feedback_file, $this->folder_path_image, $this->prefix_path_image);
                    }
                    $submission->feedback()->create([
                        'file_path' => $file_path,
                        'teacher_id' => 1,
                        'feed_back' => $request->description,
                    ]);
                    return response()->json([
                        'message' => 'Feedback submitted successfully',
                    ]);
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
                    $teacher = $this->getById($teacher_id);

                    if (!$teacher) {
                        return response()->json(['message' => 'Teacher not found'], 404);
                    }

                    // Fetch assignments submitted to the teacher that are not viewed
                    $assignments = $teacher->assignmentSubmission()
                        ->where('is_viewed', false)
                        ->with([
                            'student' => function($query) {
                                $query->with('user'); // Fetch student profile details
                            }, // Fetch student details
                            'assignment' => function ($query) {
                                $query->with([
                                    'topic' => function ($query) {
                                        $query->with([
                                            'chapter' => function ($query) {
                                                $query->with('course'); // Fetch course details
                                            }
                                        ]);
                                    }
                                ]);
                            }
                        ])
                        ->get();

                    if ($assignments->isEmpty()) {
                        return response()->json(['message' => 'No unviewed assignments found'], 404);
                    }

                    return response()->json(['assignments' => $assignments], 200);
                }



            }
            