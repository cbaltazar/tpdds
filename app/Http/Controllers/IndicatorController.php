<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Domain\IndicatorDomain;

class IndicatorController extends Controller
{
    public function indicatorSave(Request $request){
        $indicators = IndicatorDomain::getInstance()->saveIndicator($request);
        return redirect('indicatorDetail')->with('status', 'Archivo cargado correctamente!');
    }
}
