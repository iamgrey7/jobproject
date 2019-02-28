<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\UserProfile;
use App\User;

class ApplicantController extends Controller
{

    public function index()
    {
        $id = Auth::user()->id;      
        $users =  
        User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->join('resume_statuses', 'user_profiles.cv_status', 
                    '=', 'resume_statuses.id')
            ->where('user_id','=',$id)
            ->getQuery() 
            ->first();

        return view('user.index')
            ->with('users', $users)
            ->with('id', $id);        
    }

    
     // public function showFormProfile(Request $request)
    // {        
    //     return view('applicant.form-detail')
    //         ->with('user', $user);
    // }

    public function showProfile($id)
    {
        return redirect()->view('user.profile')
            ->with('id', $id);
    }

    public function storeProfile(Request $request)
    {
        $messages = [
            'required' => 'Kolom ini harus diisi',
            'numeric' => 'Nomor Telepon harus berupa angka',           
        ];
        $rules = [            
            'first_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);
        if($validation->fails()) {
            return redirect()->back()
            ->withInput()
            ->withErrors($validation);;
            
        }

        $id = $request->user()->id;
        UserProfile::create([
            'user_id' => $id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,            
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,  
        ]);

        return redirect()->route('home');       
    }

    public function uploadCV(Request $request)
    {        
        $messages = [
            'required' => 'Pilih CV yang akan di upload',
            'max' => 'Ukuran file maksimum 1Mb',
            'mimes' => 'File harus berekstensi .PDF',
        ];
        $rules = [            
            'upload_cv' => 'required|mimes:pdf|max:1000'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);
        if($validation->fails()) {
            return redirect()->back()->withInput()
            ->withErrors($validation);
        }

        $id = $request->user()->id;
        $profile = UserProfile::where('user_id', '=', $id)->first();
        if($request->hasFile('upload_cv')) {
            $file = $request->file('upload_cv');
            $destination_path = 'uploads/cv/';
            $filename = str_random(6).'_'.$profile->first_name.'_'.$profile->last_name.'.pdf';
            $file->move($destination_path, $filename); 
            $file = $destination_path.$filename;  
        } else {
            $file = NULL;
        }

        // reset status cv ke unread jika sebelumnya reject
        if ($profile->cv_status == "4"){
            $profile->cv_status = "1";
        }

        $profile->cv_path = $file;
        $profile->save();

        // return response()->json([
        //     'test' => $users,
        //     'status' => 'success']); 
        
        return redirect()->route('home');
    }
    
}
