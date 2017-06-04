<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\AccountsManager;
use App\Model\Domain\DomainManagers\AccountCompanyRelationManager;
use App\Model\Domain\DomainManagers\IndicatorsManager;
use App\Model\Domain\DomainManagers\CompaniesManager;
use Symfony\Component\ExpressionLanguage\Parser;
use Symfony\Component\ExpressionLanguage\Lexer;
use Symfony\Component\ExpressionLanguage\Node;

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






    private function check_syntax($str) {

        $lexer = new Lexer();
        $parser = new Parser(array());
        $tokenizado = $lexer->tokenize('((EBITDA*2.5)/(FDS*0.33))*888');

        while(!$tokenizado->isEOF()){
            $token = $tokenizado->current;
            if($token->type == 'name'){
                echo "<br>";var_dump($token); echo "<br>";
            }
            $tokenizado->next();
        }
        die;

        // define the grammar
        $number = "\d+(\.\d+)?";
        $ident  = "[a-zA-Z]\w*";
        $atom   = "[+-]?($number|$ident)";
        $op     = "[+*/-]";
        $sexpr  = "$atom($op$atom)*"; // simple expression

        // step1. remove whitespace
        $str = preg_replace('~\s+~', '', $str);

        // step2. repeatedly replace parenthetic expressions with 'x'
        $par = "~\($sexpr\)~";
        while(preg_match($par, $str, $matches))
            $str = preg_replace($par, 'x', $str);

        // step3. no more parens, the string must be simple expression
        $match = preg_match("~^$sexpr$~", $str);
    }

    public function calcular()
    {
        $tests = array(
            "((Indicador)+centa",
            "((EBITDA*2.5)/(FDS*0.33))*888"
        );

        foreach($tests as $t)
            echo $t, "=", $this->check_syntax($t) ? "ok" : "nope", "\n";

    }
}
