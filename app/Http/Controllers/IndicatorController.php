<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Domain\IndicatorsManager;

class IndicatorController extends Controller
{
    public function indicatorSave(Request $request){
        $indicators = IndicatorsManager::getInstance()->saveIndicator($request);
        return redirect('indicatorList')->with('status', 'Indicador cargado correctamente!');
    }

    public function indicatorEvaluate(){
        IndicatorsManager::getInstance()->indicatorEvaluate();
    }
}
