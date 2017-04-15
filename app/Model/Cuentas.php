<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    private $id_cuenta;
    private $nombre;

    public function setIdCuenta($idcuenta) {
        $this->id_cuenta = $idcuenta;
    }
    public function getIdCuenta() {
        return $this->id_cuenta;
    }
    public function setNombre($CNombre) {
        $this->nombre = $CNombre;
    }
    public function getNombre() {
        return $this->nombre;
    }
}
