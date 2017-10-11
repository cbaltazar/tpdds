<?php

namespace App\Model\Utilities;

use Illuminate\Support\Facades\Auth;


abstract class ElementFilter
{
    public function filterByUserId($user_id, $elements){
        foreach ($elements as $key => $value){
            if(Auth::user()->role != "admin"){
                if($value->user_id != $user_id){
                    unset($elements[$key]);
                }
            }
        }
        return $elements;
    }
}