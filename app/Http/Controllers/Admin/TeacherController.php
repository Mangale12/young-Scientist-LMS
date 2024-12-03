<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TeacherRepositoryInterface;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\TeacherFeedbackRequest;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends DM_BaseController
{
    protected $repository;
    protected $base_route = 'site.teacher';
    protected $view_path = 'site.teacher';
    protected $panel = "Teacher";
    public function __construct(TeacherRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        $this->view_path = 'admin.teachers';
        $this->base_route = 'admin.teachers';
        return view(parent::loadView($this->view_path.'.index'));
    }

    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        $this->base_route = 'admin.teachers';
        $this->view_path = 'admin.teachers';
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route.'.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route.'.destroy', $row->id)]);
                    $addChapter = view('admin.section.buttons.button-add-chapter', ['id' => $row->id, 'route' => route($this->base_route.'.chapters', $row->id)]);
                    return $editButton.' '.$deleteButton. ' '.$addChapter;
                })
                ->addColumn('name', function($row){
                    $row->user->name;
                })
                ->addColumn('email', function($row){
                    $row->user->email;
                })
                ->addColumn('total_course', function($row){
                    return $row->courses->count();
                })
                ->rawColumns(['action']) // Render both columns as HTML
                ->make(true);
        }
    }

    public function courses($id){
        return response($this->repository->getById($id)->courses);
    } 

    public function create(){
        return view($this->view_path.'.create');
    }
    public function store(TeacherRequest $request){
        return $this->repository->create($request);
    }

    public function dashboard(){
        $route = 'site.teacher';
        return view('site.user.dashboard', compact('route'));
    }

    // for teacher dashboard
    public function courseList(Request $request){
        $route = 'site.teacher';
        if($request->ajax()){
            return $this->repository->courseList(1);
        }else{
            return view('site.user.course.course-list', compact('route'));
        }
    }
    public function courseAssignment($course_id){
        return $this->repository->courseAssignment($course_id);
    }

    public function courseAssignmentSubmit($school_id, $course_id, $assignment_id){
        return $this->repository->courseAssignmentSubmit($school_id, $course_id, $assignment_id);
    }

    public function feedback(TeacherFeedbackRequest $request){
        return $this->repository->feedback($request);
    }
    public function coursesChapterCount($courseId){
        return $this->repository->coursesChapterCount($courseId);
    }

    public function courseDetails(Request $request, $unique_id){
        $route = 'site.teacher';
        if($request->ajax()){
            return $this->repository->courseDetails($unique_id);
        }else{
            return view('site.user.course.course', compact('unique_id', 'route'));
        }
    }

    public function topicDetails(Request $request, $course_id, $chapter_id, $topic_id){
        $route = 'site.teacher';
        if($request->ajax()){
            return $this->repository->topicDetails($course_id, $chapter_id, $topic_id);
        } else{
            return view('site.user.course.topic', compact('course_id', 'chapter_id', 'topic_id', 'route'));
        }
    }
    
    public function assignmentList(Request $request){
        $route = 'site.teacher';
        if($request->ajax()){
            return $this->repository->assignmentList(1);
        }else{
            return view('site.user.assignment-list', compact('route'));
        }
    }
    
}
