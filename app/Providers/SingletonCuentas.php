<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SingletonCuentas extends ServiceProvider
{
  private $Cuentas;
  private $created;

  static $instancia = null;

  //Por algún motivo laravel require que el constructor sea publico
  //si el constructor no es publico falla con el error "construct() must be public"
  public function __construct()
  {
     $this->Cuentas = array();
  }
  public static function getInstance()
   {
      if (  !self::$instancia instanceof self)
       {
          self::$instancia = new self;
       }
       return self::$instancia;
   }
   public function getListCuentas()
   {
     return $this->Cuentas;
   }
   public function addCuentasToList($cuenta)
   {
     array_push ($this->Cuentas, $cuenta);
   }

    public function setCreated($time){
        $this->created = $time;
    }

    public function getCreated(){
        return $this->created;
    }
}
