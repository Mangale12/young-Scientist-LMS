<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SchoolRepositoryInterface;
use App\Http\Requests\SchoolRequest;
use Yajra\DataTables\Facades\DataTables;
class SchoolController extends DM_BaseController
{
    protected $repository;
    protected $panel = 'School';
    protected $base_route = 'admin.school';
    protected $view_path = 'admin.school';
    public function __construct(SchoolRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        $data['courses'] = $this->repository->getAllCourse();
        $data['grades'] = $this->repository->getAllGrade();
        return view(parent::loadView($this->view_path.'.index'), compact('data'));

        $data['rows'] = $this->repository->all();
        
        return response()->json($schools);
    }
    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route.'.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route.'.destroy', $row->id)]);
                    $courseList = view('admin.section.buttons.button-add-chapter', ['id' => $row->id, 'route' => route($this->base_route.'.courses', $row->id)]);
                    return $editButton.' '.$deleteButton . ' '.$courseList;
                })
                ->addColumn('course', function($row){
                    return $row->courses;
                })
                ->addColumn('course_count', function($row){
                    return $row->courses->count();
                })
                ->rawColumns(['action']) // To render HTML content
                ->make(true);
        }
    }

    public function courses($id){
        $school = $this->repository->getById($id);
        $grades = $school->grades;
        $courses = $school->courses;
        return response()->json(['grades' => $grades, 'courses'=>$courses]);
    }
    public function gradeSection($school_id, $grade_id){
        return response()->json($this->repository->schoolGradeSection($school_id, $grade_id));
    }
    public function addGradeSection(Request $request){
        return $this->repository->addGradeSection($request);
    }
    public function grades($id){
        return response($this->repository->getById($id)->grades);
    }

    public function addGrade(Request $request){
        return response()->json(['message' => $this->repository->addGrade($request)]);
    }

    public function removeGrade(Request $request){
        return response($this->repository->removeGrade($request));
    }
    public function removeGradeSection(Request $request){
        return response($this->repository->removeGradeSection($request));
    }

    public function gradeSectionStudent($student_id, $grade_id, $section_id){
        $students = $this->repository->gradeSectionStudent($student_id, $grade_id, $section_id);
        return response()->json($students);
    }

    public function addGradeSectionStudent(Request $request){
        return response()->json(['message' => $this->repository->addGradeSectionStudent($request)]);
    }
    public function removeGradeSectionStudent(Request $request){
        return response()->json(['message' => $this->repository->removeGradeSectionStudent($request)]);
    }

    public function gradeSectionCourse($student_id, $grade_id, $section_id){
        return response()->json($this->repository->gradeSectionCourse($student_id, $grade_id, $section_id));
    }

    public function addGradeSectionCourse(Request $request){
        return $this->repository->addGradeSectionCourse($request);
    }

    public function removeGradeSectionCourse(Request $request){
        return $this->repository->removeGradeSectionCourse($request);
    }

    public function gradeSectionCourseTeacher($student_id, $grade_id, $section_id){
        return $this->repository->gradeSectionCourseTeacher($student_id, $grade_id, $section_id);
    }
    public function create(){
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(SchoolRequest $request){
        if($this->repository->create($request)){
            session()->flash('alert-success', 'Data created successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            session()->flash('alert-danger', 'Data created Failed !');
            return redirect()->route($this->base_route.'.index');
        }
    }

    public function edit($id){
        $data['rows']=$this->repository->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }

    public function update(SchoolRequest $request, $id){
        if($this->repository->update($id, $request)){
            session()->flash('alert-success', 'Data updated successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            session()->flash('alert-danger', 'Data updated failed!');
            return redirect()->route($this->base_route.'.index');
        }
    }

    public function delete($id){
        $this->repository->delete($id);
        session()->flash('alert-success', 'Data deleted successfully!');
        return redirect()->route($this->base_route.'.index');
    }

    public function removeCourse(Request $request)
    {
        $school = $this->repository->getById($request->school_id);

        if (!$school) {
            return response()->json(['message' => 'School not found!'], 404);
        }

        $course = $school->courses()
            ->where('courses.id', $request->course_id) // Explicitly specify the table
            ->first();

        if ($course) {
            // Detach the course from the school if using a pivot table
            $school->courses()->detach($course->id);

            return response()->json(['message' => 'Course removed successfully!']);
        } else {
            return response()->json(['message' => 'Course not found for this school!'], 404);
        }
    }


}
