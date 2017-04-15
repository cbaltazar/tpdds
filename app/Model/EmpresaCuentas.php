<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpresaCuentas extends Model
{
    private $id_empresa;
    private $id_cuenta;
    private $periodo;
    private $monto=0;

    public function setIdEmpresa($idempresa) {
        $this->id_empresa = $idempresa;
    }
    public function getIdEmpresa() {
        return $this->id_empresa;
    }
    public function setIdCuenta($idcuenta) {
        $this->id_cuenta = $idcuenta;
    }
    public function getIdCuenta() {
        return $this->id_cuenta;
    }
    public function setPeriodo($Cperiodo) {
        $this->periodo = $Cperiodo;
    }
    public function getPeriodo() {
        return $this->periodo;
    }
    public function setMonto($NMonto) {
      $this->monto = $NMonto;
    }
    public function getMonto() {
      return $this->monto;
    }
}
