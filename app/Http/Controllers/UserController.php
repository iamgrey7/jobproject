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
            User::with(['role', 'status'])
                ->paginate(10);

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
  
    
    
 
}
