<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\UserProfile;
use App\User;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = 
            UserProfile::join('resume_statuses', 'user_profiles.cv_status', 
                '=', 'resume_statuses.id')
            ->where('cv_status', '=',"1" )
            ->orWhere('cv_status', '=',"2" )
            ->getQuery()
            ->get();
       
        return view('admin.index', ['users' => $users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function showProfile($id)
    {   
        $user =  User::find($id);
        $profile = UserProfile::where('user_id','=', $id)
            ->join('users', 'user_profiles.user_id', '=', 'users.id')
            ->getQuery()
            ->first();

        return view('admin.cv-show')
            ->with('user', $profile)
            ->with('id', $id); 
        
    }

    public function changeStatusCV(Request $request) 
    {        
        $id = $request->input('id');
        $status = $request->input('status');

        $user = UserProfile::where('user_id', '=', $id)
            ->update([
                'cv_status' => "$status" 
            ]);
        
        return response()->json();
    }

    public function download(Request $request)
    {        
        $path = $request->input('path');       

        return response()->download(public_path($path));

    }

    // public function download($file)
    // {        
    //     // $filename = substr($file, 8);
    //     // $path = "uploads/cv/$filename";
    //     // $path = public_path()."/uploads/cv/".$filename;
    //     // if (file_exists($path)) {            
    //     //     return Response::download($path, $filename);
    //     // } else {            
    //     //     exit('Requested file does not exist on our server!');
    //     // }
    //     // return dd($path);

    //     // $path = public_path('uploads/cv/'.$filename);
    //     // return response()->file(public_path('/uploads/'.$file));
    //     // return Storage::disk('public')->download($file->cv_path);
    // }
}
