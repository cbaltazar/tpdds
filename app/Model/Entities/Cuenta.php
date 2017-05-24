<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Cuenta extends Model implements FormulaElement
{
    public function getEmpresas(){
        return $this->belongsToMany(Empresa::class);
    }

    public function getValue( $data ){
        $result = -1;
        $cuenta = Cuenta_Empresa::where('cuenta_id', $this->id)
                ->where('empresa_id', $data['company'])
                ->where('periodo', $data['period'])->first();
        if($cuenta != null){
            $result = $cuenta->monto;
        }

        return $result;
    }
}
