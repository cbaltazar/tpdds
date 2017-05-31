<?php

namespace App\Model\Domain\FormulaElements;

/*
 * CREAR ELEMENTOS DE FORMULA PARA IMPLEMENTAR EL COMPOSITE
 * NO USAR LAS ENTIDADES!!!*/

interface FormulaElement
{
    public function getValue($data);
}