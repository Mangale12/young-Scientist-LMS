<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ChapterRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ChapterRequest;

class ChapterController extends Controller
{
    protected $repository;
    protected $panel = 'Chapter';
    protected $base_route = 'admin.chapter';
    protected $view_path = 'admin.chapter';

    public function __construct(ChapterRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
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
                    $addChapter = view('admin.section.buttons.button-add-chapter', ['id' => $row->id, 'route' => route($this->base_route.'.chapters', $row->id)]);
                    return $editButton.' '.$deleteButton. ' '.$addChapter;
                })
                ->addColumn('description', function ($row) {
                    return $row->description; // return the raw description content
                })
                ->rawColumns(['description', 'action']) // Render both columns as HTML
                ->make(true);
        }
    }
    public function view($id){
        // Add your custom logic here
        $data['row'] = $this->repository->getById($id);
        return view(parent::loadView($this->view_path.'.view'));
    }
    public function create(){
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(CourseRequest $request){
        if($this->repository->create($request)){
            session()->flash('alert-success', 'Data Created Successsfully !');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'Data Creation Unsucces !');
            return redirect()->back();
        }
    }
    public function edit($id){
        $data['row'] = $this->repository->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(CourseRequest $request, $id){
        if($this->repository->update($id, $request)){
            session()->flash('alert-success', 'Data Updated Successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'Data Updated Failed!');
            return redirect()->back();
        }
    }

    public function chapters($id){
        $data['course_id'] = $id;
        return view(parent::loadView($this->view_path.'.chapters'), compact('data'));
    }
    public function destroy($id){
        $this->repository->delete($id);
        session()->flash('alert-success', 'Data Deleted Successfully!');
    }
}
