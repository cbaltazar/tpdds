<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account_list');
    }

    /**
     * Show section to load account's files.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadAccount()
    {

        return view('account_load');
    }
}
