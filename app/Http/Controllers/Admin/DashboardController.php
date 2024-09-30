<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.index'); // Assuming the view is located in resources/views/admin/dashboard.blade.phpu
    }
}
