<?php

namespace App\Model\ORMConnections;

use Illuminate\Database\Eloquent\Model;

interface IORMConnection
{
    public function getAll($model);

    public function findByColumnName($model, $columnName, $value);

    public function findById($model, $id);
}