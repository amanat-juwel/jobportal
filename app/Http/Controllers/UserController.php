<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use App\Application;

class UserController extends Controller
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
    public function profile()
    {	
    	$user = User::find(Auth::user()->id);

        return view('user.profile', compact('user'));
    }

    /**
     * Upload user file
     *
     * @return String
     */
    public function fileUpload($file,$upload_path){

        $name = Auth::user()->first_name.'_'.Auth::user()->last_name.'_'.Auth::user()->id.'_'.$file->getClientOriginalName();
        $file_url = $file->move($upload_path,$name);
        return $file_url;
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'skills' => 'required|string',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'resume' => 'mimes:doc,pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //validation passed

        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->skills = preg_replace('/[^A-Za-z0-9,]/', ',', $request->skills);

        //upload user proPic & resume if exist
        if($request->file('profile_picture') != ""){
	        $file = $request->file('profile_picture');
            $upload_path = 'public/user/images/';
	        $user->profile_picture = $this->fileUpload($file,$upload_path);
        }
        if($request->file('resume') != ""){
	        $file = $request->file('resume');
            $upload_path = 'public/user/resume/';
	        $user->resume = $this->fileUpload($file,$upload_path);
        }
        
        $user->update();

        return redirect('/profile')->with('success','Profile Updated');
    }

    public function applyForJob(Request $request){

    	// check if user has uploaded his resume
    	if(is_null(Auth::user()->resume)){
    		$response_code = 100;
    		return response()->json([ 'response_code' => $response_code]);
    	}

    	// check if user has already applied for this job
    	$count = Application::where('user_id',Auth::user()->id)->where('jobpost_id',$request->id)->count();
    	if($count > 0){
    		$response_code = 101;
    		return response()->json([ 'response_code' => $response_code]);
    	}

    	// store job application
    	$application = new Application;
    	$application->user_id = Auth::user()->id;
    	$application->jobpost_id =  $request->id;
    	$application->save();
    	$response_code = 102;
    	return response()->json([ 'response_code' => $response_code]);
    }
}
