<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use App\Model\Domain\DomainManagers\CompaniesManager;
use Illuminate\Http\Request;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    public function companyList(){
        /*Consulta el manager de empresas, que se conecta con el ORM y se trae todos las empresas de la base, para mostrarlas en el listado.*/
        $domainManager = CompaniesManager::getInstance();
        return view('company_list')->with("empresas", $domainManager->getAll());
    }

    public function companyDetail($company=null){
        $domainManager = CompaniesManager::getInstance();
        $company = $domainManager->getOne($company);

        return view('company_detail')->with("companyName", $company->nombre)->with("companyAccounts",$company->cuentas);
    }

    public function accountDetail($company=null){
        /*Consulta el manager de empresas para traerse los detalles de la cuenta seleccionada.*/
        $domainManager = CompaniesManager::getInstance();
        $company = $domainManager->getOne($company);

        return view('account_detail')->with("companyName", $company->nombre)->with("companyAccounts",$company->cuentas);
    }

    public function viewAccounts(Request $request){
        /*Se comunica con el manager de Cuenta Empresa, para obtener las empresas con sus respectivas cuentas, pero ordenado por cuentas.*/
        $domainManager = AccountCompanyRelationManager::getInstance();
        return view('accounts_view')->with("accounts", $domainManager->getAll());
    }

//INDICATORS
    public function indicatorList(){
        /*Utiliza el manager de indicadores para obtener la lista de los indicadores disponibles.*/
        $domainManager = IndicatorsManager::getInstance();
        return view('indicator_list')->with("indicators", $domainManager->getAll());
    }

    public function indicatorDetail($id=null){
        /*-*/
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
