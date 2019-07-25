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
	        $profile_picture = $request->file('profile_picture');
	        $name = $user->first_name.'_'.$user->last_name.'_'.$user->id.'_'.$profile_picture->getClientOriginalName();
	        $uploadPath = 'public/user/images/';
	        $profile_picture_url = $profile_picture->move($uploadPath,$name);
	        $user->profile_picture = $profile_picture_url;
        }
        if($request->file('resume') != ""){
	        $resume = $request->file('resume');
	        $name = $user->first_name.'_'.$user->last_name.'_'.$user->id.'_'.$resume->getClientOriginalName();
	        $uploadPath = 'public/user/resume/';
	        $resume_url = $resume->move($uploadPath,$name);
	        $user->resume = $resume_url;
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
    	$count = Application::where('user_id',Auth::user()->id)->where('company_id',$request->id)->count();
    	if($count > 0){
    		$response_code = 101;
    		return response()->json([ 'response_code' => $response_code]);
    	}

    	// store job application
    	$application = new Application;
    	$application->user_id = Auth::user()->id;
    	$application->company_id =  $request->id;
    	$application->save();
    	$response_code = 102;
    	return response()->json([ 'response_code' => $response_code]);
    }
}
