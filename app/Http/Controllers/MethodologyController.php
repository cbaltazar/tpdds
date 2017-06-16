<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\MethodologiesManager;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function post(Request $request){
        $domainManager = MethodologiesManager::getInstance();
        $domainManager->save( $request->getContent(), null );
        var_dump( json_decode( $request->getContent() ) );die;
    }
}
