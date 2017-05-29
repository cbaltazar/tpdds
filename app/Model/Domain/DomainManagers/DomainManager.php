<?php

/*
 * Se utilizan las clases "Manager", para comunicar los controladores con los modelos.
 * DomainManager: clase abstracta que agrupa comportamiento general de los distintos managers.
 * En ciertos casos, se utiliza el patron Template Method.
 * */

namespace App\Model\Domain\DomainManagers;

abstract class DomainManager
{
    /*
     * Atributos generales. $ormConnection se utliza para guardar un objeto que se comunica directamente
     * con la base de datos, a travez el orm elegido (En este caso, Eloquent).
     * $model guarda el nombre del modelo al que refiere el manager.
     * */
    protected $ormConnection = null;
    protected $model = null;

    /*------------------------------------------------------
     * Metodos del patron "Template Method"
     * */
    abstract function deleteMessage();
    abstract function saveElement($data, $id);
    abstract function saveMessage();
    abstract function deleteRelations($id);

    /*
     * Getters and Setters
     * */
    /*------------------------------------------------------
     * ORM Connection
     * */
    public function getOrmConnection(){
        return $this->ormConnection;
    }
    public function setOrmConnection($orm){
        $this->ormConnection = $orm;
    }

    /*------------------------------------------------------
     * Model
     * */
    public function getModel(){
        return $this->model;
    }
    public function setModel($model){
        $this->model = $model;
    }

    /*
     * Metodos para obtener los objetos de la base de datos.
    /*--------------------------------------------------------------------

     * getAll: devuelve todos los objetos del modelo pasado como parametro
     * */
    public function getAll(){
        return $this->ormConnection->getAll( $this->model );
    }

    /* getOne: retorna el objeto del modelo, con el id pasado como
     * parametro.
     * */
    public function getOne($id){
        $obj = $this->ormConnection->findById( $this->model,$id);
        return $obj;
    }

    /* getWhere: retorna el objeto del modelo, teniendo en cuenta las condiciones
     * pasadas como parametros
     * */
    public function getWhere($where){
        return $obj = $this->ormConnection->findWhere( $this->model, $where);
    }

    /* getColumn: retorna los datos de la columna pasada como parametro
     * */
    public function getColumn($column){
        return $this->ormConnection->getDistinct($this->model, $column);
    }

    /*
     * Metodos para guardar y borrar objetos de la base de datos.
    /*--------------------------------------------------------------------

     save: guarda la informacion pasada como parametro.
     Utiliza el metodo saveElement, que es implementado en cada clase hija.
    */
    public function save($data, $id){
        $this->saveElement($data, $id);
        return $this->saveMessage();
    }

    /* delete: borra el elemento cuyo id es pasado como parametro.
     * el metodo deleteMessage y deleteRelations, es implementado por las clases hijas.
     * */
    public function delete($id){
        $this->deleteRelations($id);
        $this->ormConnection->deleteEntity( $this->model, $id);
        return $this->deleteMessage();
    }

    /*
     * Otras funciones auxiliares
     *
     * ----------------------------------------------------------------

      getAvailablesElements: retorna los nombres de los de los elementos del modelo seleccionado.
      Se utliza a la hora de cargar la formula de un indicador, para validar que los elementos
      ingresados, existan.
     */
    public function getAvailablesElements(){
        $elements = $this->ormConnection->getAll( $this->model );
        $availablesElements = array();

        foreach ($elements as $element) {
            $obj = new \stdClass();
            $obj->id = $element->getId();
            $obj->nombre = $element->getNombre();
            array_push($availablesElements,$obj);
        }
        return $availablesElements;
    }

    /*getObject: busca el elemento con el nombre seleccionado. Si no se encuentra, lo crea.
      Se ultiliza a la hora de cargar el archivo de empresas y cuentas.
     * */
    public function getObject($type, $name){
        $object = $this->ormConnection->findByColumnName($type,'nombre',$name);
        if (!$object){
            $factory = $this->getFactory($type);
            $object = $factory->createObject();
            $object->nombre = $name;
            $this->ormConnection->saveEntity($object);
        }
        return $object;
    }

    /* getFormulaElement: Devuelve el elemento de dominio, que es parte de la formula de un indicador.
     * */
    public function getFromulaElement($id){
        return $this->ormConnection->findFormulaElementEntity($id);
    }

    /* getFactory: devuelve la fabrica que crea el objeto del modelo necesario.
     * */
    public function getFactory($type){
        $namespace = explode("\\", $type, 3);
        $namespace[count($namespace)-1] = 'Factories\\'.$namespace[count($namespace)-1]."Factory";
        $factory = implode('\\', $namespace);

        return new $factory();
    }
}
