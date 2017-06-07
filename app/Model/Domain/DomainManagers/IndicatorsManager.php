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
        $params = $this->getParams($data);

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
                array_push($results, $this->prepareIndicator($indicator, $request));
            }
        }

        return json_encode($results);
    }

    /*se agregan porque son abstractos en la clase padre, pero no se implementa ya que no se necesita
    en esta clase
    */
    function deleteRelations($id){}

    public function deleteMessage(){
      return "Indicador borrado con exito!";
    }

    /*--------------------- Funciones Auxiliares -------------------------------------------------------------*/
    public function prepareIndicator($indicator, $request){
        $result = new \stdClass();
        $formulaElementFactory = $this->getFactory(IndicatorElement::class);
        $indicatorElement = $formulaElementFactory->createObject($indicator, IndicatorsManager::getInstance());
        $empresa = $this->ormConnection->findById(Empresa::class, $request->input('company'));
        $result->company = $empresa->getNombre();
        $result->indicator = $indicator->getNombre();
        $result->period = $request->input('period');
        if($indicator->isActive() == 1){
            $result->value = $indicatorElement->evaluateFormula($request->input());
        }else{
            $result->value = "Inactivo";
        }

        return $result;
    }

    public function getParams($data){
        $params = new \stdClass();
        $params->name = $data->input('name');
        $params->description = $data->input('description');
        $params->formula = $data->input('formula');
        $params->elementosDeFormula = $data->formulaElements;
        is_array($data->status) ? $params->activo = 1:$params->activo = 0;

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
