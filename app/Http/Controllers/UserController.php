<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use DB;

use App\UserProfile;
use App\User;

class UserController extends Controller
{

        public function __construct()
        {
            $this->middleware('auth');
        }

  
    public function index(Request $request)
    {        
        if($request->ajax()) { 

            $users =    
            User::with(['role', 'status'])
                ->where('username', 'like', '%'.$request->keywords.'%') 
                ->orWhere('email', 'like', '%'.$request->keywords.'%')
                ->get();
                // ->paginate(10);

            $request->keywords == '' ? $keywords = '' : $keywords = $request->keywords; 
            
            $view = (String)view('user.list') 
                ->with('users', $users)
                ->render(); 
            
            return response()->json([
                'view' => $view,                 
                // 'keywords' => $keywords, 
                // 'test' => $users,
                'status' => 'success']); 
        } else {             
            $users = 
            User::with(['role', 'status'])->get();
                // ->paginate(10);

            return view('user.index')->with('users', $users); 
        }
    }

    public function storeUser(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada, harap isi :attribute yang lain',
            'before' => 'Umur anda minimal 17 tahun untuk mendaftar',
            'min' => ':attribute harus minimal :min karakter'                    
        ];
        
        $rules = [         
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:5',
            'dob' => 'required|before:17 years ago',
            'role_id' => 'required'
        ];    

        $validation = Validator::make($request->all(), $rules, $messages);
        if($validation->fails()) {           
            return withInput()
            ->withErrors($validation); 

        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),            
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
        $messages = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada, harap isi :attribute yang lain',                             
        ];
        
        $rules = [         
            'username' => 'required|string|unique:users,username,'.$id.',id',
            'email' => 'required|string|email|unique:users,email,'.$id.',id',
        ];    

        $validation = Validator::make($request->all(), $rules, $messages);
        if($validation->fails()) {           
            return withInput()
            ->withErrors($validation); 

        }

        $user = User::find($id);
        $user->username = $request->username;        
        $user->email = $request->email;
        $user->status_id = $request->status_id;                
        $user->role_id = $request->role_id;   
        $user->save();

        //refresh table setelah update
        $table = User::with(['role', 'status'])->paginate(10);

        $view = (String)view('user.list') 
        ->with('users', $table)
        ->render();

        return response()->json([            
            'view' => $view,
        ]);
    }


    public function destroy(Request $request)
    {                
        User::find($request->id)->delete();
        // User::find($request->user()->id)->delete();

        //refresh table setelah delete
        $table = User::with(['role', 'status'])->paginate(10);

        $view = (String)view('user.list') 
        ->with('users', $table)
        ->render();

        return response()->json([            
            'view' => $view,
        ]);
    }
  
    
    
 
}
