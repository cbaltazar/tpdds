<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use App\Model\Domain\DomainManagers\CompaniesManager;

class FrontController extends Controller{

    public function lockscreen(){
        return view('lockscreen');
    }

    /*
     * Consulta el manager de empresas, que se conecta con el ORM y se trae todos las empresas
     * de la base, para mostrarlas en el listado.
     *
     */
    public function companyList(){
        $domainManager = CompaniesManager::getInstance();
        return view('company_list')->with("empresas", $domainManager->getAll());
    }

    /*
     * Consulta al manager de empresas, el cual devuelve la empresa seleccionada
     *
     */
    public function companyDetail($company=null){
        $domainManager = CompaniesManager::getInstance();
        $company = $domainManager->getOne($company);

        $domainManager = AccountCompanyRelationManager::getInstance();
        /*Consulta al AccountCompanyRelationManager, los periodos existentes en la base de datos*/
        $periods = $domainManager->getColumn("periodo");

        return view('company_detail')->with("companyName", $company->nombre)
                                     ->with("companyAccounts",$company->cuentas)
                                     ->with("indicatorsPeriods", $periods);
    }

//INDICATORS

    /*
     * Utiliza el manager de indicadores para obtener la lista de los indicadores disponibles.
     *
     */
    public function indicatorList(){
        $domainManager = IndicatorsManager::getInstance();
        return view('indicator_list')->with("indicators", $domainManager->getAll());
    }

    /*
     * Utiliza el manager de indicadores para obtener los detalles de un indicador dado.
     * Tambien utiliza el manager de Cuentas, para obter las cuentas disponibles y asi validar
     * la carga de formulas de indicadores
     *
     */
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
