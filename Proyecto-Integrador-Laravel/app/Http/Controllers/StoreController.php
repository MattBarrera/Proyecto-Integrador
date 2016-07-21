<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
<<<<<<< HEAD:Proyecto-Integrador-Laravel/app/Http/Controllers/HomeController.php
        //$this->middleware('auth');
=======
        // $this->middleware('auth');
>>>>>>> origin/dev:Proyecto-Integrador-Laravel/app/Http/Controllers/StoreController.php
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Store.Store');
    }
    public function home()
    {
        return view('welcome');
    }
}
