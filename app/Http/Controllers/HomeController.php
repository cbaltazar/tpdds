<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Session;
use App\Providers\SingletonCuentas;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function loadAccounts()
    {
        return view('account_load');
    }

    public function viewAccounts(Request $request)
    {
        $listaDeDatos = SingletonCuentas::getInstance();
        var_dump($listaDeDatos);
        return view('accounts_view');
    }
}
