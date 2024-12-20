<?php

            namespace App\Repositories;
            use App\Http\Requests\CourseRequest;
            use App\Http\Requests\TopicRequest;
            use App\Models\Course;
            use Illuminate\Support\Facades\Log;
            use DB;
            use App\Models\CourseCourseResource;
            class CourseRepository extends DM_BaseRepository implements CourseRepositoryInterface
            {
                protected $folder_path_image;
                protected $folder_path_file;
                protected $folder = 'course';
                protected $file   = 'file';
                protected $prefix_path_image = '/upload_file/course/';
                protected $prefix_path_file = '/upload_file/course/file/';
                protected $chapterCategory;
                protected $courseResourceRepository;
                private $courseCourseResource;
                protected $schoolRepository;
                protected $teacherRepository;
                protected $gradeRepository;
                public function __construct(ChapterCategoryRepositoryInterface $chapterCategory, CourseResourceRepositoryInterface $courseResourceRepository, TeacherRepositoryInterface $teacherRepository, SchoolRepositoryInterface $schoolRepository, GradeRepositoryInterface $gradeRepository)
                { 
                    $this->chapterCategory = $chapterCategory;
                    $this->courseResourceRepository = $courseResourceRepository;
                    $this->teacherRepository = $teacherRepository;
                    $this->schoolRepository = $schoolRepository;
                    $this->gradeRepository = $gradeRepository;
                    $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                    $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                }

                // public function __construct(ChapterCategoryRepositoryInterface $chapterCategory, CourseResourceRepositoryInterface $courseCourseResource, TeacherRepositoryInterface $teacherResourceRepository, SchoolRepositoryInterface $schoolRepository, GradeRepositoryInterface $gradeRepository)
                // {
                //     $this->chapterCategory = $chapterCategory;
                //     $this->teacherRepository = $teacherResourceRepository;
                //     $this->schoolRepository = $schoolRepository;
                //     $this->gradeRepository = $gradeRepository;
                //     $this->courseResourceRepository = $courseResourceRepository;
                //     $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                //     $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                // }
            

                public function getAll()
                {
                    return Course::with('courseResources')
                                    ->with('schools')
                                    ->with('teachers')
                                    ->with('grades')
                                    ->get();
                }
                public  function getActiveCourse(){
                    return Course::where('status', 1)->get();
                }
               
                public function getCourseResource(){
                    return $this->courseResourceRepository->getActiveData();
                }
                // public function getById($id)
                // {
                //     return Course::findOrFail($id);
                // }

                public function getById($course_id, $columns = ['*'])
                {
                    return Course::select($columns)->findOrFail($course_id);
                }

                public function getChapterCount($id){
                    return $this->getById($id)->chapter->count();
                }
                public function getByUniqueId($unique_id){
                    return Course::where('unique_id', $unique_id)->first();
                }
                function getYoutubeIdFromUrl($video_url)
                {
                    preg_match("#([\/|\?|&]vi?[\/|=]|youtu\.be\/|embed\/)([a-zA-Z0-9_-]+)#", $video_url, $matches);
                    if ($matches) {
                        return $matches[2];
                    }
                }

                public function create(CourseRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $video_id = null;
                        $thumbnail = null;
                        if($request->video_link) {
                            $video_id = $this->getYoutubeIdFromUrl($request->video_link);
                        }
                        if($request->has('thumbnail')){
                            $thumbnail = parent::uploadImage($request->thumbnail, $this->folder_path_image, $this->prefix_path_image);
                        }

                        $course = Course::create([
                            'title'=>$request->title,
                            'user_id'=>auth()->user()->id,
                            'description'=>$request->description,
                            'course_material'=>$request->course_material,
                            'status' => $request->status,
                            'video_link' => $request->video_link,
                            'video_id' => $video_id,
                            'thumbnail' => $thumbnail,
                            'unique_id' => parent::generateUniqueRandomNumber('courses', 'unique_id'),
                        ]);
                        foreach($request->course_resource_id as $id){
                            $this->courseCourseResource::create([
                                'course_id' => $course->id,
                                'course_resource_id' => $id,
                            ]);
                        }
                        $course->schools()->sync($request->input('school_ids')); // Sync schools
                        $course->teachers()->sync($request->input('teacher_ids')); // Sync teachers
                        $course->grades()->sync($request->input('grade_ids')); // Sync grades
                        DB::commit();

                        return true;
                    } catch (\Throwable $th) {
                        //throw $th;
                        DB::rollBack();
                        Log::info($th);
                        return false; 
                    }
                    
                }

                public function update($id, CourseRequest $request)
                {
                    $model = $this->getById($id);

                    try {
                        DB::beginTransaction();

                        $video_id = $model->video_id;
                        $thumbnail = $model->thumbnail;

                        if ($request->video_link) {
                            $video_id = $this->getYoutubeIdFromUrl($request->video_link);
                        }

                        if ($request->has('thumbnail')) {
                            // Delete the old thumbnail if it exists
                            if ($thumbnail) {
                                parent::deleteImage($thumbnail);
                            }
                            $thumbnail = parent::uploadImage($request->thumbnail, $this->folder_path_image, $this->prefix_path_image);
                        }

                        // Update model fields
                        $model->update([
                            'title' => $request->title,
                            'description' => $request->description,
                            'course_material' => $request->course_material,
                            'status' => $request->status,
                            'video_link' => $request->video_link,
                            'video_id' => $video_id,
                            'thumbnail' => $thumbnail,
                        ]);

                        // Update course resources
                        if ($request->has('course_resource_id')) {
                            $model->courseResources()->sync($request->course_resource_id);
                        }
                        $model->schools()->sync($request->input('school_ids')); // Sync schools
                        $model->teachers()->sync($request->input('teacher_ids')); // Sync teachers
                        $model->grades()->sync($request->input('grade_ids')); // Sync grades
                        DB::commit();
                        return true;
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        Log::info($th);
                        return false;
                    }
                }


                public function getChapterCategory(){
                    return $this->chapterCategory->getActiveData();
                }

                public function getAllCourseResource(){
                    return $this->courseResourceRepository->getActiveData();
                }

                public function getAllTeacher(){
                    return $this->teacherRepository->getAll();
                }

                public function getAllSchool(){
                    return $this->schoolRepository->getActiveSchool();
                }
                public function getAllGrade(){
                    return $this->gradeRepository->getActiveGrade();
                }

                public function topics($course_id, $chapter_id) {
                    try {
                        // Fetch the course with limited details
                        $course = $this->getById($course_id, ['id', 'title', 'unique_id']);

                        $chapter = $course->chapter()
                                        ->with(['topics:id,chapter_id,title,description', 'chapterCategory:id,name']) 
                                        ->where('id', $chapter_id)
                                        ->select('id', 'course_id', 'title', 'chapter_category_id') 
                                        ->first();

                
                        // Check if the chapter exists
                        if (!$chapter) {
                            return response()->json(['error' => 'Chapter not found'], 404);
                        }
                
                        // Return the chapter with its topics and category
                        return response()->json([
                            'course' => $course,
                            'chapter' => $chapter,
                        ]);
                    } catch (\Exception $e) {
                        // Handle errors
                        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
                    }
                }

                public function topicsStore(TopicRequest $request)
                {
                    // Retrieve the course by its ID
                    $course = $this->getById($request->course_id);

                    // Retrieve the chapter for the course based on the provided chapter_id
                    $chapter = $course->chapter()->where('id', $request->chapter_id)->first();

                    // If the chapter exists, create a new topic under that chapter
                    if ($chapter) {
                        $topic = $chapter->topics()->create([
                            'title' => $request->title, // The topic title
                            'description' => $request->description, // The topic description
                            'assignment' => $request->assignment, // The topic assignment (optional, if provided)
                            'unique_id' => parent::generateUniqueRandomNumber('topics', 'unique_id'), // Generate a unique ID
                        ]);

                         // If an assignment was provided, create a new assignment for the topic

                         if ($request->assignment) {
                            $topic->assignment()->create([
                                'unique_id' => parent::generateUniqueRandomNumber('assignments', 'unique_id'),
                                'user_id' => auth()->user()->id,
                                'description' => $request->assignment,
                            ]);
                        }
                            

                        // Return a success response with the created topic
                        return response()->json([
                            'message' => 'Topic created successfully',
                            'topic' => $topic,
                        ], 201);
                    } else {
                        // Return an error response if the chapter does not exist
                        return response()->json([
                            'message' => 'Chapter not found',
                        ], 404);
                    }
                }

                
                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            