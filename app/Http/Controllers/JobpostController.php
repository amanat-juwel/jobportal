<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobpost;
use App\Application;
use Auth;

class JobpostController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_posts = Jobpost::where('company_id',Auth::user()->id)->orderBy('id')->get();

        return view('admin.jobpost.index', compact('job_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobpost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string',
            'job_description' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'country' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //validation passed

        $job_post = new Jobpost;
        $job_post->job_title = $request->job_title;
        $job_post->job_description = $request->job_description;
        $job_post->salary = $request->salary;
        $job_post->location = $request->location;
        $job_post->country = $request->country;
        $job_post->company_id = Auth::user()->id;
        $job_post->save();

        return redirect('jobpost')->with('success','JobPost Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $job_post = Jobpost::findOrFail($id);

        //validate
        if(Auth::user()->id != $job_post->company_id){
            return view('404');
        }

        return view('admin.jobpost.edit', compact('job_post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string',
            'job_description' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'country' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //validation passed

        $job_post = Jobpost::find($id);
        $job_post->job_title = $request->job_title;
        $job_post->job_description = $request->job_description;
        $job_post->salary = $request->salary;
        $job_post->location = $request->location;
        $job_post->country = $request->country;
        $job_post->company_id = Auth::user()->id;
        $job_post->update();

        return redirect('jobpost')->with('success','JobPost Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // validate
        $count = Application::where('jobpost_id',$id)->count();
        if($count > 0){
            return redirect('jobpost')->with('danger','You can not delete this job at this moment.');
        }

        // validation passed
        Jobpost::findOrFail($id)->delete();
        
        return redirect('jobpost')->with('success','JobPost Deleted');
    }
}
