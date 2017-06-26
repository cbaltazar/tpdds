<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\MethodologiesManager;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function saveMethodology(Request $request, $id = null){
        $domainManager = MethodologiesManager::getInstance();
        $status = $domainManager->save( json_decode( $request->get('jsonData') ), $id );

        if( !is_array($status)){
            return redirect('methodDetail/'.$id)->with('status', $status);
        }
        return redirect('methodList')->with('status', $status);
    }

    public function deleteMethodology($id=null){
        $domainManager = MethodologiesManager::getInstance();
        $status = $domainManager->delete($id);
        return redirect('methodList')->with('status', $status);
    }

    public function evaluateMethodology(Request $request){
        $domainManager = MethodologiesManager::getInstance();

        return $domainManager->evaluate( json_decode($request->getContent()) );
    }
}
