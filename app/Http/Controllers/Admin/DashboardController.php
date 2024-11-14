<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends DM_BaseController
{
    protected $panel = 'Dashboard';
    protected $base_route = 'admin.dashboard';
    protected $view_path = 'admin.dashboard';

    public function index(){
        return view(parent::loadView('admin.index')); // Assuming the view is located in resources/views/admin/dashboard.blade.phpu
    }
}
