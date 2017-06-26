<?php

namespace App\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class Regla extends Model
{
    public function setElemento($e){
        $this->elemento = $e;
    }

    public function setCondicion($c){
        $this->condicion = $c;
    }

    public function setDesde($d){
        $this->desde = $d;
    }

    public function setHasta($h){
        $this->hasta = $h;
    }

    public function setModalidad($m){
        $this->modalidad = $m;
    }

    public function setMetodologiaId($mi){
        $this->metodologia_id = $mi;
    }

    public function getElemento(){
        return $this->elemento;
    }

    public function getCondicion(){
        return $this->condicion;
    }

    public function getDesde(){
        return $this->desde;
    }

    public function getHasta(){
        return $this->hasta;
    }

    public function getModalidad(){
        return $this->modalidad;
    }

    public function getMetodologiaId(){
        return $this->metodologia_id;
    }
}
