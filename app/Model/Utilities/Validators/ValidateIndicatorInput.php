<?php

namespace App\Model\Utilities\Validators;

use App\Model\Entities\Cuenta;
use Exception;
use Symfony\Component\ExpressionLanguage\Lexer;
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

        if(!$this->validateFormulaElements($params)){
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
        $par = "~\($sexpr\)~";
        $matches = array();
        while(preg_match($par, $formula)){
            $formula = preg_replace($par, 'x', $formula);
        }
        $response = preg_match("~^$sexpr$~", $formula);
        return $response;
    }

    public function validateFormulaElements($params){
        $response = true;
        $lexer = new Lexer();
        $tokens = $lexer->tokenize($params->formula);
        while(!$tokens->isEOF()){
            $token = $tokens->current;
            if($token->type == 'name'){
                if(!$this->validateElement($token)) {
                    $response = false;
                    break;
                }
            }
            $tokens->next();
        }
        return $response;
    }

    private function validateElement($element){
        $response = true;
        if(!$this->existName(Indicador::class, $element->value) && !$this->existName(Cuenta::class, $element->value)){
            $response = false;
        }
        return $response;
    }
}