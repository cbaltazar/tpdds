<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use App\Model\Domain\DomainManagers\CompaniesManager;
use App\Model\Domain\DomainManagers\MethodologiesManager;

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
        /*Obtengo los detalles de la compania*/
        $domainManager = CompaniesManager::getInstance();
        $company = $domainManager->getOne($company);

        /*Consulta al AccountCompanyRelationManager, los periodos existentes en la base de datos*/
        $domainManager = AccountCompanyRelationManager::getInstance();
        $periods = $domainManager->getColumn("periodo");

        /*Obtengo la cantidad de indicadores disponibles, para armar la tabla.*/
        $domainManager = IndicatorsManager::getInstance();
        $indicatorsCount = $domainManager->getQuantity("activo",1);

        return view('company_detail')->with("companyName", $company->nombre)
                                     ->with("companyAccounts",$company->cuentas)
                                     ->with("indicatorsPeriods", $periods)
                                     ->with("indicatorsCount", $indicatorsCount);
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
        $domainManager = IndicatorsManager::getInstance();

        $indicatorObject = $domainManager->getOne($id);

        return view('indicator_detail')->with("variable", $domainManager->getAvailablesFromulaElements())
                                       ->with("indicatorObject", $indicatorObject);
    }


//MOTHODOLOGIES
    public function methodList(){

        return view('method_list');
    }

    public function methodDetail($id=null){
        $domainManager = MethodologiesManager::getInstance();
        return view('method_detail')->with("elements", $domainManager->getAvailablesFromulaElements())
                                         ->with("id", $id);
    }

    public function methodEval(){
        return view('method_eval');
    }
}
