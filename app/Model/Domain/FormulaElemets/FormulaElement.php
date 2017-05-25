<?php

namespace App\Model\Domain\FormulaElements;


abstract class FormulaElement
{
    public abstract function getValue( $data );

    public static function getElement( $entity )
    {
        switch ( get_class($entity) ){
            case 'App\Model\Entities\Cuenta':
                return new AccountElement($entity);
                break;
            default:
                return new IndicatorElement($entity);
        }
    }
}