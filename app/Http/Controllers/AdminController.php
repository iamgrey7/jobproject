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
        $users = UserProfile::with(['cvStatus'])
                    ->whereIn('cv_status', ['1','2'])                
                    ->where('cv_path', '!=', NULL)                
                    ->get();

        return view('admin.index', ['users' => $users]); 
    }

    public function showProfile($id)
    {   
        $user =  User::find($id);
        $profile =  UserProfile::with('user')
            ->where('user_id','=', $id)
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
