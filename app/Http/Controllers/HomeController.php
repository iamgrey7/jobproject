<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = $request->user()->role;

        // if role = admin
        if ($request->user()->hasRole('admin')) {

            return redirect()->route('admin.index');           
           
        // if role = user 
        } elseif ($request->user()->hasRole('user')) {
            
            //jika user belum mengisi profil dan upload cv 
            $id = $request->user()->id;
            $user = User::find($id);

            if ($user->has_filled_profile == false) {
                return redirect()->route('users.profile-form', $id);  

            } elseif ($user->has_filled_profile == true) {
                return redirect()->route('users.index', $user->id);                    
            }            

        } else {
            return redirect()->route('home');
        }       
    }
}
