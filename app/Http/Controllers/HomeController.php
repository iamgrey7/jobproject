<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //jika sudah login
        if (Auth::check()) {

             // if role = admin
            if ($request->user()->hasRole('admin')) {

                return redirect()->route('admin.index');           
            
            // if role = user 
            } elseif ($request->user()->hasRole('user')) {
                
                //jika user belum mengisi profil
                $id = $request->user()->id; 
                $Profile = UserProfile::where('user_id', '=', $id);
                $user = User::with(['profile', 'profile.cvStatus'])
                    ->find($id); 
               
                if (!$Profile->exists()) {
                    return view('applicant.form-detail')
                        ->with('id', $id); 
                // } else {
                } elseif ($user->profile->first_name !== NULL) {
                    return view('applicant.dashboard')                    
                        ->with('user', $user);              
                }
            } 

        // jika belum login
        } else {
            return view('home.homepage');
        }

           
    }


}
