<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TimeLogType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $log_types = TimeLogType::active()->get();
        $projects = Project::all();
        return view('home', compact('log_types', 'projects'));
    }
}
