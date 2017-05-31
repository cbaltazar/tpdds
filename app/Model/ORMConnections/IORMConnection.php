<?php

namespace App\Model\ORMConnections;

use Illuminate\Database\Eloquent\Model;

interface IORMConnection
{
    public function getAll($model);

    public function findByColumnName($model, $columnName, $value);

    public function findAllByColumnName($model, $columnName, $value);

    public function findById($model, $id);

    public function findWhere($model, $where);

    public function getDistinct($model, $column);

    public function countWhere($model, $columnName, $value);

    public function saveEntity($entity);

    public function deleteEntity($model, $id);

    public function findFormulaElementEntity($id);
}