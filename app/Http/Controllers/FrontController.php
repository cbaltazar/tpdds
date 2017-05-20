<?php

namespace App\Http\Controllers;

use App\Model\Cuenta;
use App\Model\Cuenta_Empresa;
use App\Model\Domain;
use App\Model\Empresa;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function loadAccounts(){
        return view('account_load')->with("empresas", Domain::getInstance()->getCompanies());
    }

    public function accountDetail($company=null){
        return view('account_detail')->with("companyAccounts",
            Domain::getInstance()->getCompany($company)->cuentas);
    }

    public function viewAccounts(Request $request)
    {
        $empresas = Cuenta_Empresa::all();
        $accountList = array();
        foreach ($empresas as $empresa){
            $e = new \stdClass();
            $e->nombreEmpresa = Empresa::find($empresa->empresa_id)->nombre;
            $e->nombreCuenta = Cuenta::find($empresa->cuenta_id)->nombre;
            $e->periodo = $empresa->periodo;
            $e->monto = $empresa->monto;

            array_push($accountList, $e);
        }

        return view('accounts_view')->with("accounts", $accountList);
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
