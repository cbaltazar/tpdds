<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function loadAccount()
    {
        return view('account_load');
    }

    public function viewAccount()
    {
        return view('account_view');
    }
}
