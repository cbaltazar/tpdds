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
        $accountList = null;
        if(Session::get("ListaDeDatos")){
            $accountList =  Session::get("ListaDeDatos")->getListCuentas();
        }
        $empresas = $this->getEmpresasCargadas($accountList);

        return view('account_load')->with("empresas", $empresas)->with("created", Session::get("ListaDeDatos")->getCreated());
    }

    public function viewAccounts(Request $request)
    {
        $accountList = null;
        if(Session::get("ListaDeDatos")){
            $accountList =  Session::get("ListaDeDatos")->getListCuentas();
        }
        return view('accounts_view')->with("accounts", $accountList);
    }

    public function accountDetail($company=null){
        $accountList = null;
        $companyAccounts = array();
        if(Session::get("ListaDeDatos")){
            $accountList =  Session::get("ListaDeDatos")->getListCuentas();
            foreach ($accountList as $account){
                if ($account->getNombreEmpresa() == $company){
                  $companyAccounts[] = $account;
                }
            }
        }
        return view('account_detail')->with("companyAccounts", $companyAccounts, $company);
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

    private function getEmpresasCargadas($accountList){
        $empresas = array();
        foreach ($accountList as $account){
            if(!in_array($account->getNombreEmpresa(), $empresas)){
                array_push($empresas, $account->getNombreEmpresa());
            }
        }
        return $empresas;
    }
}
