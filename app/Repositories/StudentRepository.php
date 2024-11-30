<?php

            namespace App\Repositories;

            use App\Models\Student;
            use App\Models\User;
            use App\Http\Requests\StudentRequest;
            use DB;
            use Illuminate\Support\Facades\Log; 

            class StudentRepository extends DM_BaseRepository implements StudentRepositoryInterface
            {
                private $courseRepository;
                protected $folder_path_image;
                protected $folder_path_file;
                protected $folder = 'student/assignments';
                protected $file   = 'file';
                protected $prefix_path_image = '/upload_file/student/assignments/';
                protected $prefix_path_file = '/upload_file/student/assignments/file/';
                protected $chapterCategory;
                protected $courseResourceRepository;
                private $courseCourseResource;
                protected $schoolRepository;
                protected $teacherRepository;
                protected $gradeRepository;
                
                public function __construct(CourseRepositoryInterface $courseRepository){
                    $this->courseRepository = $courseRepository;
                    $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                    $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                }
                public function getAll()
                {
                    return Student::whereHas('user')->with('user')->get();
                }


                // public function courses($id)
                // {
                //     // Retrieve the student by ID
                //     $student = $this->getById(2);
                    
                //     if (!$student) {
                //         return response()->json(['message' => 'Student not found'], 404);
                //     }
                
                //     // Eager load related data for courses
                //     $courses = $student->schoolSectionGradeStudent()
                //         ->with(['schoolGradeSection.schoolSectionGradeCourses.course:id,title,unique_id,thumbnail'])
                //         ->first();
                
                //     return response()->json($courses, 200);
                // }

                public function courses($id)
                {
                    // Retrieve the student by ID
                    $student = $this->getById(2);

                    if (!$student) {
                        return response()->json(['message' => 'Student not found'], 404);
                    }

                    // Eager load related courses along with course details
                    $studentCourses = $student->schoolSectionGradeStudent()
                        ->with(['schoolGradeSection.schoolSectionGradeCourses.course:id,title,unique_id,thumbnail'])
                        ->first();

                    if (!$studentCourses) {
                        return response()->json(['message' => 'No courses found for this student'], 404);
                    }

                    // Format the response
                    $formattedCourses = $studentCourses->schoolGradeSection->schoolSectionGradeCourses->map(function ($item) {
                        return [
                            'course_id' => $item->course->id ?? null,
                            'title' => $item->course->title ?? 'No Title Available',
                            'unique_id' => $item->course->unique_id ?? 'N/A',
                            'thumbnail' => $item->course->thumbnail ?? null,
                        ];
                    });

                    return response()->json([
                        'student' => [
                            'id' => $student->id,
                            'name' => $student->name,
                            'student_id' => $student->student_id, // Replace with actual field for student ID
                        ],
                        'courses' => $formattedCourses,
                    ], 200);
                }

                
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
                //     $course = $this->courseRepository->getByUniqueId($unique_id);

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
                    // Retrieve the student by ID
                    $student = $this->getById(2);

                    if (!$student) {
                        return response()->json(['message' => 'Student not found'], 404);
                    }

                    // Find the course associated with the student using the unique ID
                    $studentCourse = $student->schoolSectionGradeStudent()
                        ->with([
                            'schoolGradeSection.schoolSectionGradeCourses.course' => function ($query) use ($course_unique_id) {
                                $query->where('unique_id', $course_unique_id);
                            },
                            'schoolGradeSection.schoolSectionGradeCourses.course.chapter' => function ($query) {
                                $query->select('id', 'course_id', 'title', 'chapter_category_id', 'unique_id')
                                    ->with([
                                        'topics:id,chapter_id,title,unique_id',
                                        'chapterCategory:id,name'
                                    ]);
                            },
                        ])
                        ->first();

                    if (!$studentCourse || !$studentCourse->schoolGradeSection->schoolSectionGradeCourses->first()) {
                        return response()->json(['message' => 'Course not found for the given student'], 404);
                    }

                    // Extract course details
                    $course = $studentCourse->schoolGradeSection->schoolSectionGradeCourses
                        ->firstWhere('course.unique_id', $course_unique_id)
                        ->course;

                    return response()->json([
                        'student' => [
                            'id' => $student->id,
                            'name' => $student->name,
                            'student_id' => $student->student_id, // Replace with actual field for student ID
                        ],
                        'course' => $course,
                    ], 200);
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

                // public function topicDetails($course_id, $chapter_id, $topic_id)
                // {
                //     // Fetch the course with its chapters and topics
                //     $course = $this->courseRepository->getByUniqueId($course_id);

                //     if (!$course) {
                //         return response()->json(['message' => 'Course not found'], 404);
                //     }

                //     // Check if the chapter belongs to the course
                //     $chapter = $course->chapter()->where('unique_id', $chapter_id)->first();
                //     if (!$chapter) {
                //         return response()->json(['message' => 'Chapter not found in this course'], 404);
                //     }

                //     // Fetch the topic from the chapter
                //     $topic = $chapter->topics()
                //                     ->where('unique_id', $topic_id)
                //                     ->with('assignment')
                //                     ->first();
                //     if (!$topic) {
                //         return response()->json(['message' => 'Topic not found in this chapter'], 404);
                //     }

                //     // Return the topic details
                //     return response()->json([
                //         'topic' => $topic,
                //     ]);
                // }
                public function topicDetails($course_id, $chapter_id, $topic_id)
                {
                    // Fetch the student
                    $student = $this->getById(2);

                    if (!$student) {
                        return response()->json(['message' => 'Student not found'], 404);
                    }

                    // Find the course associated with the student
                    $studentCourse = $student->schoolSectionGradeStudent()
                        ->with([
                            'schoolGradeSection.schoolSectionGradeCourses.course' => function ($query) use ($course_id) {
                                $query->where('unique_id', $course_id);
                            },
                            'schoolGradeSection.schoolSectionGradeCourses.course.chapter' => function ($query) use ($chapter_id) {
                                $query->where('unique_id', $chapter_id);
                            },
                            'schoolGradeSection.schoolSectionGradeCourses.course.chapter.topics' => function ($query) use ($topic_id) {
                                $query->where('unique_id', $topic_id)->with('assignment');
                            },
                        ])
                        ->first();

                    // Ensure the course exists
                    if (!$studentCourse || !$studentCourse->schoolGradeSection->schoolSectionGradeCourses->first()) {
                        return response()->json(['message' => 'Course not found for this student'], 404);
                    }

                    // Extract the course
                    $course = $studentCourse->schoolGradeSection->schoolSectionGradeCourses
                        ->firstWhere('course.unique_id', $course_id)
                        ->course;

                    // Ensure the chapter exists
                    $chapter = $course->chapter->firstWhere('unique_id', $chapter_id);
                    if (!$chapter) {
                        return response()->json(['message' => 'Chapter not found in this course'], 404);
                    }

                    // Ensure the topic exists
                    $topic = $chapter->topics->firstWhere('unique_id', $topic_id);
                    if (!$topic) {
                        return response()->json(['message' => 'Topic not found in this chapter'], 404);
                    }

                    // Return the topic details
                    return response()->json([
                        'topic' => $topic,
                    ]);
                }


                public function assignMentSubmission($student_id, $request)
                {
                    // Check and upload the thumbnail if provided
                    $file_path = null;
                    if ($request->has('assignment_file')) {
                        $file_path = parent::uploadImage($request->assignment_file, $this->folder_path_image, $this->prefix_path_image);
                    }

                    // Fetch the student
                    $student = $this->getById(2);

                    if (!$student) {
                        return response()->json(['message' => 'Student not found'], 404);
                    }

                    // Extract course, chapter, and topic unique IDs from the request
                    $course_id = $request->course_id;
                    $chapter_id = $request->chapter_id;
                    $topic_id = $request->topic_id;

                    // Find the course associated with the student
                    $studentCourse = $student->schoolSectionGradeStudent()
                        ->with([
                            'schoolGradeSection.schoolSectionGradeCourses.course' => function ($query) use ($course_id) {
                                $query->where('unique_id', $course_id);
                            },
                           'schoolGradeSection.schoolSectionGradeCourses.schoolGradeSectionCourseTeacher' => function ($query) {
                                $query->latest('created_at')->with('teacher'); // Fetch the latest assigned teacher and include teacher details
                            },
                            'schoolGradeSection.schoolSectionGradeCourses.course.chapter' => function ($query) use ($chapter_id) {
                                $query->where('unique_id', $chapter_id);
                            },
                            'schoolGradeSection.schoolSectionGradeCourses.course.chapter.topics' => function ($query) use ($topic_id) {
                                $query->where('unique_id', $topic_id)->with('assignment');
                            },
                        ])
                        ->first();

                    // Ensure the course exists
                    if (!$studentCourse || !$studentCourse->schoolGradeSection->schoolSectionGradeCourses->first()) {
                        return response()->json(['message' => 'Course not found for this student'], 404);
                    }

                    // Extract the course
                    $course = $studentCourse->schoolGradeSection->schoolSectionGradeCourses
                        ->firstWhere('course.unique_id', $course_id)
                        ->course;

                    // Ensure the chapter exists
                    $chapter = $course->chapter->firstWhere('unique_id', $chapter_id);
                    if (!$chapter) {
                        return response()->json(['message' => 'Chapter not found in this course'], 404);
                    }

                    // Ensure the topic exists
                    $topic = $chapter->topics->firstWhere('unique_id', $topic_id);
                    if (!$topic) {
                        return response()->json(['message' => 'Topic not found in this chapter'], 404);
                    }

                    // Check if an assignment exists for the topic
                    $assignment = $topic->assignment;
                    if (!$assignment) {
                        return response()->json(['message' => 'Assignment not found for this topic'], 404);
                    }
                    $latestTeacher = $studentCourse
                        ->schoolGradeSection
                        ->schoolSectionGradeCourses
                        ->first()
                        ->schoolGradeSectionCourseTeacher
                        ->first(); // Fetch the latest teacher relation
                    // Create the assignment submission
                    $assignment->assignmentSubmission()->create([
                        'file_path' => $file_path,
                        'description' => $request->assignment_notes,
                        'is_viewed' => false,
                        'is_replied' => false,
                        'student_id' => 2,
                        'teacher_id' => $latestTeacher->teacher_id, // Assuming the latest teacher is assigned to the student
                    ]);

                    
                    return response()->json(['message' => 'Assignment submitted successfully', 'teacher' =>  $latestTeacher], 200);
                }

                public function getStudentBySchool($school_id){
                    return Student::whereHas('user')
                                    ->with('user')
                                    ->where('school_id', $school_id)
                                    ->get();
                }

                public function getById($id)
                {
                    return Student::findOrFail($id);
                }

                public function create(StudentRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $user = User::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'unique_id'=>parent::generateUniqueRandomNumber('users', 'unique_id'),
                            'password'=>bcrypt($request->password), // Default password for new users
                        ]);
                        $student = Student::create([
                            'user_id'=>$user->id,
                            'student_id'=>$request->student_id,
                            'school_id'=>$request->school_id,
                            'grade_id'=>$request->grade_id,
                            'section_id'=>$request->section_id,
                            'address'=>$request->address,
                            'dob'=>$request->dob,
                            'parent_phone'=>$request->parent_phone,
                            'parent_email'=>$request->parent_email,
                        ]);
                        DB::commit();
                        return true;
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return $th;
                        Log::info($th);
                        return false;
                        //throw $th;
                    }
                }

                public function update($id, StudentRequest $request)
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

                public function getSchool(){
                    $model = new SchoolRepositoryInterface();
                    return $model->getAll();
                }
                public function getGrade(){
                    $model = new GradeRepositoryInterface();
                    return $model->getAll();
                }
                public function getSection(){
                    $model = new SectionRepositoryInterface();
                    return $model->getAll();
                }
            }
            