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
        return view('account_load')->with("empresas", AccountsManager::getInstance()->getCompanies());
    }

    public function accountDetail($company=null){
        $company = AccountsManager::getInstance()->getCompany($company);
        return view('account_detail')->with("companyName", $company->nombre)->with("companyAccounts",$company->cuentas);
    }

    public function viewAccounts(Request $request)
    {
        return view('accounts_view')->with("accounts", AccountsManager::getInstance()->getAccounts());
    }

//INDICATORS
    public function indicatorList(){
        return view('indicator_list')->with("indicators", IndicatorsManager::getInstance()->getIndicators());
    }

    public function indicatorDetail($id=null){
        $accounts = AccountsManager::getInstance()->getAvailablesAccounts();
        $indicators = IndicatorsManager::getInstance()->getAvailablesIndicators();

        $indicatorObject = IndicatorsManager::getInstance()->getIndicator($id);

        return view('indicator_detail')->with("variable", array_merge($accounts, $indicators))
                                             ->with("indicatorObject", $indicatorObject);
    }
//MOTHODOLOGIES
    public function methodList(){
        return view('method_list');
    }

    public function methodDetail(){
        return view('method_detail');
    }
}
