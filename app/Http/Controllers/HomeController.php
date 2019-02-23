<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // single role diff homepage 
        if ($request->user()->hasRole('admin')) {
            return redirect()->route('admin.index')            
            ->with('role', $role);
        }
        elseif ($request->user()->hasRole('user')) {
            return redirect()->route('user.index')
            ->with('role', $role);
        } else {
            return view('home');
        }       
    }
}
