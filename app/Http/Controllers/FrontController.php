<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Session;
use App\Providers\SingletonCuentas;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function loadAccounts(){
        return view('account_load');
    }

    public function viewAccounts(Request $request)
    {
        return view('accounts_view')->with("accounts",
            Session::get("ListaDeDatos")->getListCuentas());
    }

    public function accountDetail(){
        return view('account_detail');
    }
//INDICATORS
    public function indicatorList(){
        return view('indicator_list');
    }

    public function indicatorDetail(){
        return view('indicator_detail');
    }
//MOTHODOLOGIES
    public function methodList(){
        return view('method_list');
    }

    public function methodDetail(){
        return view('method_detail');
    }
}
