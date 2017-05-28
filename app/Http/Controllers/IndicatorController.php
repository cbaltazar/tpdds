<?php

namespace App\Http\Controllers;
use App\Model\Domain\AccountsManager;
use Illuminate\Http\Request;
use App\Model\Domain\IndicatorsManager;

class IndicatorController extends Controller
{

  //INDICATORS
      public function indicatorList(){
          return view('indicator_list')->with("indicators", IndicatorsManager::getInstance()->getAllEntities());
      }

      public function indicatorDetail($id=null){
        $accounts = AccountsManager::getInstance()->getAllEntities();
        $indicators = IndicatorsManager::getInstance()->getAllEntities();
        $indicatorObject = IndicatorsManager::getInstance()->getEntity($id);
  // echo $id;
  //  echo $indicatorObject.nombre;
          return view('indicator_detail')->with("variable", array_merge($accounts, $indicators))
                                               ->with("indicatorObject", $indicatorObject);
      }
    public function indicatorSave(Request $request, $id=null){

        if ($id==null)
        {
          $status = IndicatorsManager::getInstance()->save($request);
        }
        else {
          $status = IndicatorsManager::getInstance()->updateEntity($request, $id);
        }

        return redirect('indicatorList')->with('status', $status);
    }

    public function indicatorDelete($id=null){
        $status = IndicatorsManager::getInstance()->deleteEntity($id);
        return redirect('indicatorList')->with('status', $status);
    }

    public function indicatorEvaluate(Request $request){
        return IndicatorsManager::getInstance()->indicatorEvaluate($request);
    }
}
