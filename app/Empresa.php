<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    private $id;
    private $Nombre='';
    private $Cuentas = array();

    public function addCuenta($cuenta)
    {
       $Cuentas[] = $cuenta;
    }
}
