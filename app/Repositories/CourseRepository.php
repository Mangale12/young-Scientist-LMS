<?php

            namespace App\Repositories;
            use App\Http\Requests\CourseRequest;
            use App\Models\Course;
            use Illuminate\Support\Facades\Log;
            

            class CourseRepository extends DM_BaseRepository implements CourseRepositoryInterface
            {
                protected $folder_path_image;
                protected $folder_path_file;
                protected $folder = 'blog';
                protected $file   = 'file';
                protected $prefix_path_image = '/upload_file/course/';
                protected $prefix_path_file = '/upload_file/course/file/';
                protected $chapterCategory;
                public function __construct(ChapterCategoryRepositoryInterface $chapterCategory)
                {
                    $this->chapterCategory = $chapterCategory;
                    $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                    $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                }
            

                public function getAll()
                {
                    return Course::all();
                }

                public function getById($id)
                {
                    return Course::findOrFail($id);
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
                        $video_id = null;
                        $thumbnail = null;
                        if($request->video_link) {
                            $video_id = $this->getYoutubeIdFromUrl($link);
                        }
                        if($request->has('thumbnail')){
                            $thumbnail = parent::uploadImage($request->thumbnail, $this->folder_path_image, $this->prefix_path_image);
                        }

                        return Course::create([
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
                        return true;
                    } catch (\Throwable $th) {
                        //throw $th;
                        Log::info($th);
                        return false; 
                    }
                    
                }

                public function update($id, CourseRequest $request)
                {
                    $model = $this->getById($id);
                    try {
                        $video_id = $model->video_id;
                        $thumbnail = $model->thumbnail;
                        if($request->video_link) {
                            $video_id = $this->getYoutubeIdFromUrl($link);
                        }
                        if($request->has('thumbnail')){
                            parent::deleteImage($thumbnail);
                            $thumbnail = parent::uploadImage($request->thumbnail, $this->folder_path_image, $this->prefix_path_image);
                        }

                        return $model::update([
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
                        return true;
                    } catch (\Throwable $th) {
                        //throw $th;
                        Log::info($th);
                        return false; 
                    }
                }

                public function getChapterCategory(){
                    return $this->chapterCategory->getActiveData();
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            