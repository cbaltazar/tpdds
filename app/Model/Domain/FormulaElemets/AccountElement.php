<?php

namespace App\Model\Domain\FormulaElements;

use App\Model\Entities\Cuenta_Empresa;

class AccountElement extends FormulaElement
{
    function __construct( $accountEntity, $dm )
    {
        $this->model = $accountEntity;
        $this->domainManager = $dm;
    }

    public function getValue( $data ){
        $result = -1;
        $cuenta = $this->domainManager->getWhere( $this->getConditions($data) );

        if($cuenta != null){
            $result = $cuenta->monto;
        }

        return $result;
    }

    private function getConditions($data){
        $where = array();

        $account_id = ['cuenta_id', '=', $this->model->id];
        $company_id = ['empresa_id', '=', $data['company']];
        $period = ['periodo', '=', $data['period']];

        array_push($where, $account_id);
        array_push($where, $company_id);
        array_push($where, $period);

        return $where;
    }
}