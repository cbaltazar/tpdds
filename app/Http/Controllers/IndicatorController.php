<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Domain\DomainManagers\IndicatorsManager;

class IndicatorController extends Controller
{
    public function indicatorSave(Request $request, $id=null){
        $domainManager = IndicatorsManager::getInstance();
        $status = $domainManager->save($request, $id);
        return redirect('indicatorList')->with('status', $status);
    }

    public function indicatorDelete($id=null){
        $domainManager = IndicatorsManager::getInstance();
        $status = $domainManager->delete($id);
        return redirect('indicatorList')->with('status', $status);
    }

    public function indicatorEvaluate(Request $request){
        return IndicatorsManager::getInstance()->indicatorEvaluate($request);
    }
}
