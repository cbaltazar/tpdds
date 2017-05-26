<?php

namespace App\Model\Domain\FormulaElements;

use App\Model\Entities\Cuenta_Empresa;

class AccountElement extends FormulaElement
{
    function __construct( $accountEntity )
    {
        $this->model = $accountEntity;
    }

    public function getValue( $data ){
        $result = -1;
        $cuenta = Cuenta_Empresa::where('cuenta_id', $this->model->id)
            ->where('empresa_id', $data['company'])
            ->where('periodo', $data['period'])->first();
        if($cuenta != null){
            $result = $cuenta->monto;
        }

        return $result;
    }
}