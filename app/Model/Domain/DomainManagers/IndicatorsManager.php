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
        $indicator = null;
        if( $id != null){
            $indicator = $this->getOne($id);
        }else{
            $indicatorFactory = $this->getFactory(Indicador::class);
            $indicator = $indicatorFactory->createObject();
        }

        $indicator->nombre = $data->input('name');
        $indicator->descripcion = $data->input('description');
        is_array($data->status) ? $indicator->activo = 1:$indicator->activo = 0;
        $indicator->formula = $data->input('formula');
        $indicator->elementosDeFormula = $data->formulaElements;

        $this->ormConnection->saveEntity($indicator);
    }

    /* Devuelve el mensaje de guardado de indicadores.
     * */
    public function saveMessage($saved)
    {
        return "Indicador guardado con exito!";
    }

    /*se agregan porque es abstracto en la clase padre, pero no se implementa ya que no se necesita
      en esa clase
    */
    function deleteRelations($id){}

    public function deleteMessage(){}

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
}
