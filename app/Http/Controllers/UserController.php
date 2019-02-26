<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;

use App\UserProfile;
use App\User;

class UserController extends Controller
{

  
    public function index()
    {
        $id = Auth::user()->id;      
        $users =  User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                        ->join('resume_statuses', 'user_profiles.cv_status', 
                             '=', 'resume_statuses.id')
                        ->where('user_id','=',$id)
                        ->getQuery() 
                        ->first();

        return view('user.index')
            ->with('users', $users)
            ->with('id', $id);        
    }

    public function userManage(Request $request)
    {        
        // $users = DB::table('users')
        //     ->leftJoin('roles', 'users.role_id', '=', 'roles.id')            
        //     ->get();        
        // return view('user.manage')->with('users', $users);

        if($request->ajax()) { 
            $users = User::where(
                'username', 'like', '%'.$request->keywords.'%') 
                ->orWhere('email', 'like', '%'.$request->keywords.'%');                      
            $users = $users->paginate(10);

            $request->keywords == '' ? $keywords = '' : $keywords = $request->keywords; 
            
            $view = (String)view('user.list') 
                ->with('users', $users)
                ->render(); 
            
            return response()->json([
                'view' => $view,                 
                'keywords' => $keywords, 
                'test' => $users,
                'status' => 'success']); 
        } else { 
            $users = DB::table('users')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->paginate(10);
            return view('user.manage')->with('users', $users); 
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Request $request)
    {
       
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

    public function showProfile($id)
    {
        return redirect()->view('user.profile')
        ->with('id', $id);
    }

    public function showFormProfile($id)
    {        
        return view('user.form-detail')
         ->with('id', $id);
    }

    public function storeProfile(Request $request)
    {
        $messages = [
            'required' => 'Kolom ini harus diisi',            
        ];
        $rules = [            
            'first_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);
        if($validation->fails()) {
            return redirect()->back()->withInput()
            ->withErrors($validation);
        }

        $id = $request->id;
        UserProfile::create([
            'user_id' => $id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,            
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,  
        ]);

        return redirect()->route('users.index', $id);       
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
            $destination_path = 'uploads/cv/';
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
