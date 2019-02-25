<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserProfile;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function home()
    {
        return view('home.homepage');
    }

    public function index(Request $request)
    {
        $this->middleware('auth');
        
        $role = $request->user()->role;

        // if role = admin
        if ($request->user()->hasRole('admin')) {

            return redirect()->route('admin.index');           
           
        // if role = user 
        } elseif ($request->user()->hasRole('user')) {
            
            //jika user belum mengisi profil
            $id = $request->user()->id; 
            $email = $request->user()->email;
            $user = User::leftJoin('user_profiles', 'users.id', 
                '=', 'user_profiles.user_id', 'left_outer')
                ->where('email', '=', $email)
                ->getQuery()
                ->first();
            if ($user->first_name == NULL) {
                return redirect()->route('users.profile-form', $id);                  
            } elseif ($user->first_name !== NULL) {
                return redirect()->route('users.index', $user->id);                    
            }
            
        } else {
            return redirect('home.homepage');
        }       
    }


}
