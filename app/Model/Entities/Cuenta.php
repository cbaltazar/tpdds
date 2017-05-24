<?php

namespace App\Model\Entities;

use App\Model\Domain\FormulaElements\FormulaElement;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model implements FormulaElement
{
    public function getEmpresas(){
        return $this->belongsToMany(Empresa::class);
    }

    public function getValue( $data ){
        $valor = Cuenta_Empresa::where('cuenta_id', $this->id)
                                ->where('empresa_id', $data['company'])
                                ->where('periodo', $data['period'])->first()->monto;
        return $valor;
    }
}
