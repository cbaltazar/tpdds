<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\MethodologiesManager;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function post(Request $request){
        $domainManager = MethodologiesManager::getInstance();
        $status = $domainManager->save( json_decode( $request->getContent() ), null );

        return $status;
    }
}
