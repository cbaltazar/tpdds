<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use App\Providers\SingletonCuentas;
use Illuminate\Support\Facades\Session;

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
        $listaDeDatos = Session::get("ListaDeDatos")->getListCuentas();
        return view('accounts_view')->with("listado", $listaDeDatos);
    }
}
