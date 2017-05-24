<?php

namespace App\Http\Controllers;

use App\Model\Entities\Indicador;
use Illuminate\Http\Request;
use App\Model\Domain\IndicatorsManager;

class IndicatorController extends Controller
{
    public function indicatorSave(Request $request, $id=null){
        $status = IndicatorsManager::getInstance()->saveIndicator($request, $id);
        return redirect('indicatorList')->with('status', $status);
    }

    public function indicatorDelete($id=null){
        $status = IndicatorsManager::getInstance()->deleteIndicator($id);
        return redirect('indicatorList')->with('status', $status);
    }

    public function indicatorEvaluate(Request $request){
        return IndicatorsManager::getInstance()->indicatorEvaluate($request);
    }
}
