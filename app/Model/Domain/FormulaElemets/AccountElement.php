<?php

/*
 * AccountElement: maneja el elemento de formula, cuando este es una Cuenta. Devuelve el monto.
 * */

namespace App\Model\Domain\FormulaElements;

use App\Model\Entities\Cuenta_Empresa;
use App\Model\ORMConnections\EloquentConnection;

class AccountElement extends FormulaElement
{
    public function getValue( $data ){
        $result = -1;
        $accountCopanyRelation = $this->orm->findWhere(Cuenta_Empresa::class, $this->getConditions($data) );

        if($accountCopanyRelation != null){
            $result = $accountCopanyRelation->getMonto();
        }

        return $result;
    }

    private function getConditions($data){
        $where = array();

        $account_id = ['cuenta_id', '=', $this->model->getId()];
        $company_id = ['empresa_id', '=', $data->company];
        $period = ['periodo', '=', $data->period];

        array_push($where, $account_id);
        array_push($where, $company_id);
        array_push($where, $period);

        return $where;
    }
}