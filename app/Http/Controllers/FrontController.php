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
use App\Providers\SingletonCuentas;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function loadAccounts(){
        $empresas = Empresa::all();

        return view('account_load')->with("empresas", $empresas);
    }

    public function accountDetail($company=null){

        $empresa = Empresa::where('nombre', $company)->first();
        $cuentas = $empresa->getCuentas;

        return view('account_detail')->with("companyAccounts", $cuentas);
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
