<?php

            namespace App\Repositories;
            use App\Http\Requests\CourseResourceRequest;
            use App\Models\CourseResource;
            use Illuminate\Support\Facades\Log;
            class CourseResourceRepository extends DM_BaseRepository implements CourseResourceRepositoryInterface
            {
                protected $folder_path_image;
                protected $folder_path_file;
                protected $folder = 'course_resource';
                protected $file   = 'file';
                protected $prefix_path_image = '/upload_file/course_resource/';
                protected $prefix_path_file = '/upload_file/course_resource/file/';
                protected $chapterCategory;
                public function __construct()
                {
                    $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                    $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                }
                public function getAll()
                {
                    return CourseResource::all();
                }
                public function getActiveData(){
                    return CourseResource::where('status', 1)->get();
                }
                public function getById($id)
                {
                    return CourseResource::findOrFail($id);
                }

                public function create(CourseResourceRequest $request)
                {
                    try {
                        $files = [];
                        if($request->hasFile('file')){
                            foreach ($request->file('file') as $file) {
                                $uploadedFilePath = parent::uploadImage($file, $this->folder_path_image, $this->prefix_path_image);
                                $files[] = $uploadedFilePath;
                            }
                        }
                        return CourseResource::create([
                            'title'=>$request->title,
                            'description'=>$request->description,
                            'file_path'=>json_encode($files),
                            'unique_id' => parent::generateUniqueRandomNumber('courses', 'unique_id'),
                            'status' => $request->status,
                        ]);
                        return true;
                    } catch (\Throwable $th) {
                        Log::info($th);
                        return false;
                    }
                    
                }

                public function update($id, CourseResourceRequest $request)
                {
                    try {
                        // Fetch the existing model
                        $model = $this->getById($id);

                        // Decode the existing file paths into an array
                        $existingFiles = json_decode($model->file_path, true) ?? [];

                        // Check if new files are uploaded
                        if ($request->hasFile('file')) {
                            foreach ($request->file('file') as $file) {
                                // Upload each file and store its path
                                $uploadedFilePath = parent::uploadImage($file, $this->folder_path_image, $this->prefix_path_image);
                                $existingFiles[] = $uploadedFilePath;
                            }
                        }

                        // Update the model
                        $model->update([
                            'title'       => $request->title,
                            'description' => $request->description,
                            'file_path'   => json_encode($existingFiles),
                            'status'      => $request->status,
                        ]);

                        return $model;

                    } catch (\Throwable $th) {
                        // Log the error for debugging purposes
                        Log::error('Error updating course resource: ' . $th->getMessage(), [
                            'id'      => $id,
                            'request' => $request->all(),
                        ]);
                        return false;
                    }
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            