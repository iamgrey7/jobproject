<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\UserProfile;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        return view('user.index')->with('id', $id);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function showFormProfile($id)
    {        
        return view('user.form-detail')
         ->with('id', $id);
    }

    public function storeProfile(Request $request)
    {
        $id = $request->id;
        UserProfile::create([
            'user_id' => $id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,            
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,  
        ]);

        // $user = User::find($id);
        // $user->has_filled_profile = true;
        // $user->save();
        // dd($user);
    }

    public function changeFilled($id) {
        $user = User::find($id);
        $user->has_filled_profile = true;
        $user->save();   
    }

    public function uploadCV(Request $request, $id)
    {        
        $messages = [
            'required' => 'Pilih CV yang akan di upload',
            'max' => 'Ukuran file maksimum 2Mb',
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

        $profile = UserProfile::where('user_id', '=', $id)->first();
        if($request->hasFile('upload_cv')) {
            $file = $request->file('upload_cv');
            $destination_path = 'uploads/';
            $filename = str_random(6).'_'.$profile->first_name.'_'.$profile->last_name.'.pdf';
            $file->move($destination_path, $filename); 
            $file = $destination_path.$filename;
        } else {
            $file = NULL;
        }

        $profile->cv_path = $file;
        $profile->save();
        
        return redirect()->route('users.index', $id);
    }
    
 
}
