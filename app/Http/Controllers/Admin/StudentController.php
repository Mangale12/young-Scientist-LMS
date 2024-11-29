<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StudentRepositoryInterface;
use App\Http\Requests\StudentRequest;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends DM_BaseController
{
    protected $repository;
    protected $panel = 'Student';
    protected $base_route = 'admin.students';
    protected $view_path = 'admin.students';

    public function __construct(StudentRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
    }
    public function dashboard(){
        $route = 'site.student';
        return view('site.user.dashboard', compact('route'));
    }
    public function courses(){
        return $this->repository->courses(auth()->user()->id);
    }
    public function coursesChapterCount($courseId){
        return $this->repository->coursesChapterCount($courseId);
    }

    public function courseDetails(Request $request, $unique_id){
        $route = 'site.student';
        if($request->ajax()){
            return $this->repository->courseDetails($unique_id);
        }else{
            return view('site.user.course.course', compact('unique_id', 'route'));
        }
    }

    public function topicDetails(Request $request, $course_id, $chapter_id, $topic_id){
        $route = 'site.student';
        if($request->ajax()){
            return $this->repository->topicDetails($course_id, $chapter_id, $topic_id);
        } else{
            return view('site.user.course.topic', compact('course_id', 'chapter_id', 'topic_id', 'route'));
        }
    }
    
    // Fetch data for the DataTable
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route . '.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route . '.destroy', $row->id)]);

                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action']) // To render HTML content
                ->make(true);
        }

    }

    public function create() {
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(StudentRequest $request) {
        return $this->repository->create($request);
        
    }
}
