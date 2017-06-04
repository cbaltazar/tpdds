<?php

namespace App\Model\Utilities\Validators;

use Exception;
use App\Model\Entities\Indicador;

class ValidateIndicatorInput extends Validator
{
    public function validateParams($params)
    {
        if(!$this->validateFormatName($params->name)){
            throw new Exception("Error en el nombre del indicador.");
        }

        if($this->existName(Indicador::class, $params->name)){
            throw new Exception("Ya existe un indicador con ese nombre.");
        }

        if(!$this->validateFormatFormula($params->formula)){
            throw new Exception("Error en el formato de la formula.");
        }

        if(!$this->validateFormulaElements($params->elementosDeFormula)){
            throw new Exception("Alguno de los elementos de formula no existe o es incorrecto. Verifiquelos y vuelva a intentar");
        }

        return true;
    }

    public function validateFormatFormula($formula){
        // define the grammar
        $number = "\d+(\.\d+)?";
        $ident  = "[a-zA-Z]\w*";
        $atom   = "[+-]?($number|$ident)";
        $op     = "[+*/-]";
        $sexpr  = "$atom($op$atom)*";

        $formula = preg_replace('~\s+~', '', $formula);

        // step2. repeatedly replace parenthetic expressions with 'x'
        $par = "~\($sexpr\)~";
        $matches = array();
        while(preg_match($par, $formula)){
            preg_match($par, $formula, $matches);
            $formula = preg_replace($par, 'x', $formula);
        }

        var_dump($matches);

        $response = preg_match("~^$sexpr$~", $formula);
        return $response;
    }

    public function validateFormulaElements($formulaElements){
        $response = true;
        if($formulaElements){
            $formulaElements = json_decode($formulaElements);
            foreach ($formulaElements as $fe){
                $entity = $this->orm->findById('App\Model\Entities\\'.$fe->class, $fe->id);
                if($entity == null){
                    $response = false;
                    break;
                }
            }
            $response = false;
        }
        return $response;
    }
}