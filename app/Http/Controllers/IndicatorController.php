<?php

namespace App\Http\Controllers;

use Doctrine\Common\Cache\Cache;
use Illuminate\Http\Request;
use App\Model\Domain\DomainManagers\IndicatorsManager;

class IndicatorController extends Controller
{
    /*
     * Usa el indicador manager, para guardar o actualizar un indicador.
     * En caso de recibir el id, actualizara ese indicador. Si el id es null,
     * significa que es un indicador nuevo.
     */
    public function indicatorSave(Request $request, $id=null){
        $domainManager = IndicatorsManager::getInstance();
        $status = $domainManager->save($request, $id);
        Cache::flush();
        return redirect('indicatorList')->with('status', $status);
    }

    /*
     * Utiliza el Indicador Manager, para borrar el indicador seleccionado.
     */
    public function indicatorDelete($id=null){
        $domainManager = IndicatorsManager::getInstance();
        $status = $domainManager->delete($id);
        return redirect('indicatorList')->with('status', $status);
    }

    /*
     * Api que calcula los indicadores, para la empresa y periodo pasados por POST
     * */
    public function indicatorEvaluate(Request $request){
        return IndicatorsManager::getInstance()->indicatorEvaluate(json_decode( $request->getContent() ));
    }
}
