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
    //coba
    public function fillTable() {
        if($request->ajax()) { 
            $users = 
            User::join('statuses', 'users.status', '=', 
                    'statuses.id')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->paginate(10);

            $view = (String)view('user.list') 
            ->with('users', $users)
            ->render();
            
            return response()->json([
                'view' => $view,
            ]);  
        }
    }




  
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

    

    public function userManage(Request $request)
    {        
        if($request->ajax()) { 

            $users =                 
            // User::join('statuses', 'users.status', '=', 
            //         'statuses.id')
            //     ->join('roles', 'users.role_id', '=', 'roles.id')
            //     ->where('username', 'like', '%'.$request->keywords.'%') 
            //     ->orWhere('email', 'like', '%'.$request->keywords.'%');

            User::with(['role', 'status'])
                ->where('username', 'like', '%'.$request->keywords.'%') 
                ->orWhere('email', 'like', '%'.$request->keywords.'%')
                ->paginate(10);

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
            $users = 
            User::with(['role', 'status'])->paginate(10);  
            return view('user.manage')->with('users', $users); 
        }
    }

    public function storeUser(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,            
            'dob' => $request->dob,            
            'role_id' => $request->role_id,
            'status_id' => 1,
            'path_foto' => '', 
        ]);

        //refresh table setelah create
        $table = User::with(['role', 'status'])->paginate(10);

        $view = (String)view('user.list') 
        ->with('users', $table)
        ->render();

        return response()->json([            
            'view' => $view,
        ]);
    }


    public function update(Request $request, $id)
    {        
        $user = User::find($id)->update([
            'username' => $request->username,
            'email' => $request->email,               
            'role_id' => $request->role_id,
            'status_id' => $request->status_id,            
        ]);
        //refresh table setelah update
        $table = User::with(['role', 'status'])->paginate(10);

        $view = (String)view('user.list') 
        ->with('users', $table)
        ->render();

        return response()->json([            
            'view' => $view,
        ]);
    }


    public function destroy(Request $request, $id)
    {                
        User::find($id)->delete();

        //refresh table setelah delete
        $table = User::with(['role', 'status'])->paginate(10);

        $view = (String)view('user.list') 
        ->with('users', $table)
        ->render();

        return response()->json([            
            'view' => $view,
        ]);
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
