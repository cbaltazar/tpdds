<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SingletonCuentas extends ServiceProvider
{
  private $Cuentas;
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
    //  $Cuentas[] = $cuenta;
   }
}
