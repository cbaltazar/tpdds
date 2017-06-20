<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\MethodologiesManager;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function saveMethodology(Request $request){
        $domainManager = MethodologiesManager::getInstance();
        $status = $domainManager->save( json_decode( $request->get('jsonData') ), null );

        if( !is_array($status)){
            return redirect('methodDetail')->with('status', $status);
        }
        return redirect('methodList')->with('status', $status);
    }
}
