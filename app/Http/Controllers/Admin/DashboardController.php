<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){

        $header_title='Dashboard';
        return view('admin.dashboard',['header_title'=>$header_title]);
    }
}
