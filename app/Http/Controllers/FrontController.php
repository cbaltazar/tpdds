<?php

namespace App\Http\Controllers;

use App\Model\Domain\AccountsDomain;
use App\Model\Domain\IndicatorDomain;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function loadAccounts(){
        return view('account_load')->with("empresas", AccountsDomain::getInstance()->getCompanies());
    }

    public function accountDetail($company=null){
        return view('account_detail')->with("companyAccounts",
            AccountsDomain::getInstance()->getCompany($company)->cuentas);
    }

    public function viewAccounts(Request $request)
    {
        return view('accounts_view')->with("accounts", AccountsDomain::getInstance()->getAccounts());
    }

//INDICATORS
    public function indicatorList(){
        return view('indicator_list');
    }

    public function indicatorDetail(){
        $accountsMannager = AccountsDomain::getInstance();
        $indicatorsMannager = IndicatorDomain::getInstance();
        $elements = array_merge($accountsMannager->getAvailablesAccounts(), $indicatorsMannager->getAvailablesIndicators());
        return view('indicator_detail')->with("variable", $elements);
    }
//MOTHODOLOGIES
    public function methodList(){
        return view('method_list');
    }

    public function methodDetail(){
        return view('method_detail');
    }
}
