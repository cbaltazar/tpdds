<?php
/**
 * Created by PhpStorm.
 * User: amansilla
 * Date: 22/06/17
 * Time: 12:47
 */

namespace App\Model\Domain\Rules;


class RuleMAX extends Rule
{
    public function evaluate($results, $rule)
    {
        /*array donde se guardan los resultados de aplicar el indicador o cuenta de la regla,
        por empresa, para el rango de periodos.*/
        $companies = $results;
        $indicatorResults = array();
        foreach ($companies as $companyId => $value){
            $indicatorResults[$companyId] = $this->getValuesOfPeriods($companyId, $rule);
        }
        /*Devuelve el array de resultados parciales, con la valoracion que consiguio cada empresa,
        luego de haberle aplicado esta regla.*/
        return $this->applyCondition($indicatorResults, $results,$rule);
    }

    public function applyCondition($companies, $results,$rule){
        /*Para ordenar, en caso de ser unitario, suma todos los valores de los periodos,
        y ordena por esa suma obtenida.*/
        $companiesSum = $this->addCompaniesValues($companies);
        uasort($companiesSum, function($a, $b) {
            return $b - $a;
        });
        /*La funcion addPoints, toma el array de resultados de aplicar esta regla, y el array de resultados.
        Asigna la valoracion parcial obtenida, a cada empresa.*/
        return $this->addPoints($companiesSum, $results);
    }
}