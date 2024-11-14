<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $teachers = $this->teacherRepository->getAll();
        return response()->json($teachers);
    }

    public function show($id)
    {
        $teacher = $this->teacherRepository->getById($id);
        return response()->json($teacher);
    }

    public function store(UserRequest $request)
    {
        $data = $request->only(['name', 'email', 'subject_expert', 'phone', 'password']);
        $teacher = $this->teacherRepository->create($data);
        return response()->json($teacher, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'email', 'subject_expert', 'phone', 'password']);
        $teacher = $this->teacherRepository->update($id, $data);
        return response()->json($teacher);
    }

    public function destroy($id)
    {
        $this->teacherRepository->delete($id);
        return response()->json(null, 204);
    }
}
