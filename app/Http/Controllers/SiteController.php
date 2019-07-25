<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobpost;

class SiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {	
    	$job_posts = Jobpost::orderBy('id')->get();

        return view('welcome', compact('job_posts'));
    }
}
