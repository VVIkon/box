<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Route;
use \Gate;
//use Illuminate\Contracts\Auth\Access\Gate;

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

//        $route = Route::current();
//        $pars = $route->parameters;

        if(Gate::denies('open.home')){
            return redirect('/');
        }

        return view('home');
    }


}
