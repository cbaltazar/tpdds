<?php
/*
 * IndicatorManager: se encarga de realizar las acciones relacionadas con los indicadores.
 * Implementa el patron Singleton.
 * */
namespace App\Model\Domain\DomainManagers;

use App\Model\Domain\FormulaElements\IndicatorElement;
use App\Model\Entities\Indicador;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;

class IndicatorsManager extends DomainManager
{
    protected static $obj = null;

    function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Indicador::class;
    }

    /*getInstance: devuelve la instancia de la clase.
     * */
    static function getInstance(){
        if(IndicatorsManager::$obj == null){
            IndicatorsManager::$obj = new IndicatorsManager(new EloquentConnection());
        }
        return IndicatorsManager::$obj;
    }

    /*saveElement: guarda el indicador en caso de ser nuevo o lo actualiza.
     * */
    public function saveElement($data, $id){
        $params = $this->getParams($data, 'save');

        $indicator = null;
        if( $id != null){
            $indicator = $this->getOne($id);
        }else{
            $indicatorFactory = $this->getFactory(Indicador::class);
            $indicator = $indicatorFactory->createObject();
        }

        $this->ormConnection->saveEntity($this->setValues($indicator, $params));
        return $indicator;
    }

    /* Devuelve el mensaje de guardado de indicadores.
     * */
    public function saveMessage($saved)
    {
        $msg = "Indicador guardado con exito!";
        if($saved == null) {
            $msg = "Error al guardar el indicador.";
        }
        return $msg;
    }

    /*indicatorEvaluate: evalua todos los indicadores, para una empresa y un periodo dados.
     * */
    public function indicatorEvaluate($request){
        $indicators = $this->getAll();
        $results = array();

        foreach ($indicators as $indicator){
            if($indicator->isActive()){
                $params = $this->getParams($request, 'calculate');
                array_push($results, $this->calculateIndicator($indicator, $params));
            }
        }

        return json_encode($results);
    }

    /*se agregan porque son abstractos en la clase padre, pero no se implementa ya que no se necesita
    en esta clase
    */
    function deleteRelations($id){}
    public function deleteMessage(){}





    /*--------------------- Funciones Auxiliares -------------------------------------------------------------*/
    public function prepareResult($params, $indicator, $indicatorElement){
        $result = new \stdClass();
        //tomo los datos de la empresa de la base de datos.
        $empresa = $this->ormConnection->findById(Empresa::class, $params->companyId);
        $result->company = $empresa->getNombre();
        $result->indicator = $indicator->getNombre();
        $result->period = $params->period;
        //si el indicador esta activo, evaluo su formula, si no, pongo inactivo.
        ($indicator->isActive() == 1) ? $result->value = $indicatorElement->getValue($params) : $result->value = "Inactivo";
        return $result;
    }

    public function calculateIndicator($indicator, $params){
        //camuflar la entidad dentro de un elemento de formula. creo el elemento con una fabrica.
        $formulaElementFactory = $this->getFactory(IndicatorElement::class);
        //creo el elemento indicador pasandole la entidad para que la use.
        $indicatorElement = $formulaElementFactory->createObject($indicator);
        //preparo el objeto resultado
        $result = $this->prepareResult($params, $indicator, $indicatorElement);
        return $result;
    }

    public function getParams($data, $type){
        $params = new \stdClass();
        switch($type){
            case 'save':
                $params->name = $data->input('name');
                $params->description = $data->input('description');
                $params->formula = $data->input('formula');
                $params->elementosDeFormula = $data->formulaElements;
                is_array($data->status) ? $params->activo = 1:$params->activo = 0;
                break;
            case 'calculate':
                $params->period = $data->input('period');
                $params->companyId = $data->input('company');
                break;
        }
        return $params;
    }

    public function setValues($indicator, $params){
        $indicator->nombre = $params->name;
        $indicator->descripcion = $params->description;
        $indicator->activo = $params->activo;
        $indicator->formula = $params->formula;
        $indicator->elementosDeFormula = $params->elementosDeFormula;

        return $indicator;
    }

}
