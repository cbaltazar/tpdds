<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Cuenta_Empresa extends Model
{
    protected $table='cuenta_empresa';

    public $timestamps = false;

    public function empresa(){
        return $this->hasOne(Empresa::class, 'id', 'empresa_id');
    }

    public function cuenta(){
        return $this->hasOne(Cuenta::class, 'id', 'cuenta_id');
    }

    public function getId(){
        return $this->id;
    }

    public function getMonto(){
        return $this->monto;
    }

    public function getPeriodo(){
        return $this->periodo;
    }

    public function setCuentaId($id){
        $this->cuenta_id = $id;
    }

    public function setEmpresaId($id){
        $this->empresa_id = $id;
    }

    public function setMonto($monto){
        $this->monto = $monto;
    }

    public function setPeriodo($periodo){
        $this->periodo = $periodo;
    }

}
