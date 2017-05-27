<?php

namespace App\Model\Domain\FormulaElements;

class AccountElement extends FormulaElement
{
    function __construct( $accountEntity, $dm )
    {
        $this->model = $accountEntity;
        $this->domainManager = $dm;
    }

    public function getValue( $data ){
        $result = -1;
        $accountCopanyRelation = $this->domainManager->getWhere( $this->getConditions($data) );

        if($accountCopanyRelation != null){
            $result = $accountCopanyRelation->getMonto();
        }

        return $result;
    }

    private function getConditions($data){
        $where = array();

        $account_id = ['cuenta_id', '=', $this->model->getId()];
        $company_id = ['empresa_id', '=', $data['company']];
        $period = ['periodo', '=', $data['period']];

        array_push($where, $account_id);
        array_push($where, $company_id);
        array_push($where, $period);

        return $where;
    }
}