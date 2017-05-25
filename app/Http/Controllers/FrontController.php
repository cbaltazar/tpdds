<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use App\Model\Domain\DomainManagers\CompaniesManager;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function loadAccounts(){
        $domainManager = CompaniesManager::getInstance();
        return view('account_load')->with("empresas", $domainManager->getAll());
    }

    public function accountDetail($company=null){
        $domainManager = CompaniesManager::getInstance();
        $company = $domainManager->getOne($company);
        return view('account_detail')->with("companyName", $company->nombre)->with("companyAccounts",$company->cuentas);
    }

    public function viewAccounts(Request $request)
    {   $domainManager = AccountCompanyRelationManager::getInstance();
        return view('accounts_view')->with("accounts", $domainManager->getAll());
    }

//INDICATORS
    public function indicatorList(){
        $domainManager = IndicatorsManager::getInstance();
        return view('indicator_list')->with("indicators", $domainManager->getAll());
    }

    public function indicatorDetail($id=null){
        $accounts = AccountsManager::getInstance()->getAvailablesElements();
        $indicators = IndicatorsManager::getInstance()->getAvailablesElements();

        $indicatorObject = IndicatorsManager::getInstance()->getOne($id);

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
