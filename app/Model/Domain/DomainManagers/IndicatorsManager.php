<?php
/*
 * IndicatorManager: se encarga de realizar las acciones relacionadas con los indicadores.
 * Implementa el patron Singleton.
 * */
namespace App\Model\Domain\DomainManagers;

use App\Model\Domain\FormulaElements\IndicatorElement;
use App\Model\Entities\Cuenta;
use App\Model\Entities\Indicador;
use App\Model\Entities\Empresa;
use App\Model\ORMConnections\EloquentConnection;
use App\Model\Utilities\Validators\ValidateIndicatorInput;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\ExpressionLanguage\Lexer;
use App\Model\Utilities\IndicatorsFilter;

class IndicatorsManager extends DomainManager
{
    protected static $obj = null;

    private function __construct($orm){
        $this->ormConnection=$orm;
        $this->model = Indicador::class;
        $this->validator = new ValidateIndicatorInput();
        $this->validator->setOrm($this->ormConnection);
        $this->filter = new IndicatorsFilter();
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

        $this->ormConnection->saveEntity($this->setValues($indicator, $params, $id));
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

    private function getDataFromCache($params){
        $cacheKey = $params->company.$params->period.$params->user_id;
        return \Cache::get($cacheKey);
    }

    /*indicatorEvaluate: evalua todos los indicadores, para una empresa y un periodo dados.
     * */
    public function indicatorEvaluate($params){
        if(!Auth::id())
            Auth::loginUsingId($params->user_id);

        $response = $this->getDataFromCache($params);
         if( !$response ){
             $indicators = array();
             if( isset($params->indicator) && $params->indicator != null){
                 $indicators[] = $this->getOne($params->indicator);
             }else{
                 $indicators = $this->getAllByUserId(Auth::id());//$this->getAll();
             }
             $results = array();

             foreach ($indicators as $indicator){
                 if($indicator->isActive()){
                     array_push($results, $this->calculateIndicator($indicator, $params));
                 }
             }

             $cacheKey = $cacheKey = $params->company.$params->period.$params->user_id;
             $response = json_encode($results);
             \Cache::put($cacheKey, $response, 60);
         }

        return $response;
    }

    /*se agregan porque son abstractos en la clase padre, pero no se implementa ya que no se necesita
    en esta clase
    */
    function deleteRelations($id){}

    public function deleteMessage(){
      return "Indicador borrado con exito!";
    }

    /*--------------------- Funciones Auxiliares -------------------------------------------------------------*/
    public function prepareResult($params, $indicator, $indicatorElement){
        $result = new \stdClass();
        //tomo los datos de la empresa de la base de datos.
        $empresa = $this->ormConnection->findById(Empresa::class, $params->company);
        $result->company = $empresa->getNombre();
        $result->indicator = $indicator->getNombre();
        $result->period = $params->period;
        //si el indicador esta activo, evaluo su formula, si no, pongo inactivo.
        ($indicator->isActive() == 1) ? $result->value = $indicatorElement->getValue($params) : $result->value = "Inactivo";
        return $result;
    }

    public function calculateIndicator($indicator, $params){
        //camuflo la entidad dentro de un elemento de formula. creo el elemento con una fabrica.
        $formulaElementFactory = $this->getFactory(IndicatorElement::class);
        //creo el elemento indicador pasandole la entidad para que la use.
        $indicatorElement = $formulaElementFactory->createObject();
        //le seteo los valores del orm y la entidad.
        $indicatorElement->setOrmConnection($this->ormConnection);
        $indicatorElement->setModel($indicator);
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
                $params->formula = str_replace(" ", "_", $data->input('formula'));
                $params->elementosDeFormula = $data->formulaElements;
                is_array($data->status) ? $params->activo = 1:$params->activo = 0;
                break;
        }
        return $params;
    }

    public function setValues($indicator, $params, $id){
        if($this->validateInput($params, $id)){
            $indicator->nombre = $params->name;
            $indicator->descripcion = $params->description;
            $indicator->activo = $params->activo;
            $indicator->formula = str_replace("_", " ", $params->formula);
            if(!$params->elementosDeFormula){
                $params->elementosDeFormula = $this->addElementosDeFormula($params);
            }
            $indicator->elementosDeFormula = $params->elementosDeFormula;
            $indicator->user_id = Auth::id();
            $indicator->created_at = new \DateTime();
            $indicator->updated_at = new \DateTime();

            return $indicator;
        }
    }

    private function addElementosDeFormula($params){
        $tokens = $this->getTokens($params->formula);
        $formulaElements = array();

        foreach ($tokens as $token){
            $formulaInfo = new \stdClass();
            $elem = $this->ormConnection->findByColumnName(Indicador::class,'nombre', $token);
            if(!$elem) $elem = $this->ormConnection->findByColumnName(Cuenta::class,'nombre', $token);

            $formulaInfo->id = $elem->getId();
            $formulaInfo->class = explode('\\', get_class($elem))[3];
            $formulaElements[] = json_encode($formulaInfo);
        }
        $formulaElements = implode(",", $formulaElements);
        return '['.$formulaElements.']';
    }

    private function getTokens($formula){
        $lexer = new Lexer();
        $tokens = $lexer->tokenize($formula);
        $elements = array();
        while(!$tokens->isEOF()){
            $token = $tokens->current;
            if($token->type == 'name')
                $elements[]=$token->value;
            $tokens->next();
        }
        return $elements;
    }

}
