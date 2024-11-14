<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SiteRepositoryInterface;
class SiteController extends Controller
{
    protected $repository;
    private $view_path = 'site.';
    public function __construct(SiteRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        $data['schools'] = $this->repository->getSchool();
        $data['grades'] = $this->repository->getGrade();
        $data['sections'] = $this->repository->getSection();
        return view($this->view_path.'index', compact('data'));
    }
}
