<?php

namespace App\Http\Controllers;

use App\Interviews;
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
        $interview=Interviews::all();
        $accepted_candidate=Interviews::where('candidate_status',"=","accept")->count();
        $rejected_candidate=Interviews::where('candidate_status',"=","reject")->count();
        return view('home',compact('interview','accepted_candidate','rejected_candidate'));
    }
}
