<?php

namespace App\Http\Controllers;

use App\Model\Cuenta;
use App\Model\Cuenta_Empresa;
use App\Model\Empresa;
use App\Model\Empresa_Cuenta;
use App\Users2;
use App\Role;
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
       /* $accountList = null;
        $empresas = null;
        $created = null;
        if(Session::get("ListaDeDatos")){
            $accountList =  Session::get("ListaDeDatos")->getListCuentas();
            $empresas = $this->getEmpresasCargadas($accountList);
            $created = Session::get("ListaDeDatos")->getCreated();
        }*/

        $empresas = Empresa::all();

        return view('account_load')->with("empresas", $empresas);
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

    public function pruebaBase(){
        $empresa = Empresa::where('nombre', 'EMPRESA 8')->first();
        if(!$empresa){
            echo "no existe la empresa";
        }
        /*$cuenta = Cuenta::find(2);
        $cuenta_empresa = new Cuenta_Empresa();
        $cuenta_empresa->empresa_id = $empresa->id;
        $cuenta_empresa->cuenta_id = $cuenta->id;
        $cuenta_empresa->periodo = "2017/05/14";
        $cuenta_empresa->monto = 234.56;
        $cuenta_empresa->save();*/

        return $empresa;
    }
}
