<?php

namespace App\Http\Controllers;

use App\Model\Domain\AccountsManager;
use App\Model\Domain\IndicatorsManager;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function loadAccounts(){
        return view('account_load')->with("empresas", CompanyManager::getInstance()->getAllEntities());
    }

    public function accountDetail($company=null){
        $company = CompanyManager::getInstance()->findByColName("nombre",$company);
        return view('account_detail')->with("companyName", $company->nombre)->with("companyAccounts",$company->cuentas);
    }

    public function viewAccounts(Request $request)
    {
        return view('accounts_view')->with("accounts", AccountsManager::getInstance()->getAllEntities());
    }


//MOTHODOLOGIES
    public function methodList(){
        return view('method_list');
    }

    public function methodDetail(){
        return view('method_detail');
    }

}
