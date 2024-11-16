<?php

            namespace App\Repositories;
            use App\Http\Requests\ChapterRequest;
            use App\Models\Chapter;
            use App\Models\Assignment;
            use Illuminate\Support\Facades\Log;
            use DB;

            class ChapterRepository extends DM_BaseRepository implements ChapterRepositoryInterface
            {
                private $chapterCategory;
                private $assignment;
                public function __construct(ChapterCategoryRepositoryInterface $chapterCategory, Assignment $assignment){
                    $this->chapterCategory = $chapterCategory;
                    $this->assignment = $assignment;
                }
                public function getAll()
                {
                    return Chapter::all();
                }

                public function getById($id)
                {
                    return Chapter::findOrFail($id);
                }

                public function create(ChapterRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $chapter =  Chapter::create([
                            'title'=>$request->title,
                            'description'=>$request->description,
                            'unique_id' => parent::generateUniqueRandomNumber('chapters', 'unique_id'),
                            'chapter_category_id' => $request->chapter_category_id,
                            'course_id' => $request->course_id,
                        ]);
                        $this->assignment::create([
                            'chapter_id' => $chapter->id,
                            'description' => $request->assignment,
                            'course_id' => $request->course_id,
                            'unique_id' => parent::generateUniqueRandomNumber('assignments', 'unique_id'),
                            'user_id' => auth()->user()->id,
                        ]);
                        DB::commit();
                        return true;
                    } catch (\Throwable $th) {
                        //throw $th;
                        DB::rollBack();
                        Log::info($th);
                        return false;
                    }
                    
                }

                public function getChapterCategory(){
                    return $chapterCategory = $this->chapterCategory->getActiveData();
                }

                public function update($id, ChapterRequest $request)
                {
                    try {
                        DB::beginTransaction();
                        $model = $this->getById($id);
                        $model->update([
                            'title'=>$request->title,
                            'description'=>$request->description,
                        ]);
                        $this->assignment->where('chapter_id', $id)
                                        ->update([
                                            'description' => $request->assignment
                                        ]);
                        DB::commit();
                    return true;
                    } catch (\Throwable $th) {
                        //throw $th;
                        DB::rollBack();
                        Log::info($th);
                        return false;
                    }
                   
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            