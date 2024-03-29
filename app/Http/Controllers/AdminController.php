<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Jobpost;
use App\Application;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $applications = Application::with('user','jobpost')
        ->join('jobposts','jobposts.id','=','applications.jobpost_id')
        ->join('admins','admins.id','=','jobposts.company_id')
        ->orderBy('applications.id','desc')
        ->paginate();

        return view('admin.dashboard',compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
          'first_name' => 'required', 'string', 'max:255',
          'last_name' => 'required', 'string', 'max:255',
          'business_name' => 'required | string',
          'email'         => 'required | string | email | max:255 | unique:admins',
          'password'      => 'required | string | min:6'
        ]);
        // store in the database
        $admins = new Admin;
        $admins->first_name = $request->first_name;
        $admins->last_name = $request->last_name;
        $admins->business_name = $request->business_name;
        $admins->email = $request->email;
        $admins->password=bcrypt($request->password);
        $admins->save();
        return redirect()->route('admin.auth.login');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}