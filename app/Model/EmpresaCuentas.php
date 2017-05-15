<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpresaCuentas extends Model
{
    private $NombreEmpresa='';
    private $NombreCuenta='';
    private $Periodo='';
    private $Monto='';

  public function setNombreEmpresa($NEmpresa) {
      $this->NombreEmpresa = $NEmpresa;
  }
  public function getNombreEmpresa() {
      return $this->NombreEmpresa;
  }
  public function setNombreCuenta($NCuenta) {
    $this->NombreCuenta = $NCuenta;
  }
  public function getNombreCuenta() {
    return $this->NombreCuenta;
  }
  public function setPeriodo($Periodo) {
    $this->Periodo = $Periodo;
  }
  public function getPeriodo() {
    return $this->Periodo;
  }
  public function setMonto($NMonto) {
    $this->Monto = $NMonto;
  }
  public function getMonto() {
    return $this->Monto;
  }
}
