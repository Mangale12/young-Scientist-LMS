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
                public function __construct(CourseRepositoryInterface $courseRepository){
                    $this->courseRepository = $courseRepository;
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

                public function courseDetails($unique_id)
                {
                    $course = $this->courseRepository->getByUniqueId($unique_id);

                    if (!$course) {
                        return response()->json(['message' => 'Course not found'], 404);
                    }

                    $course->load([
                        'chapter' => function ($query) {
                            $query->select('id', 'course_id', 'title', 'chapter_category_id', 'unique_id')
                                ->with([
                                    'topics:id,chapter_id,title,unique_id', // Include the foreign key `chapter_id`
                                    'chapterCategory:id,name'
                                ]);
                        }
                    ]);

                    return response()->json(['course' => $course]);
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
            