<?php

namespace App\Model\Utilities;


abstract class ElementFilter
{
    public function filterByUserId($user_id, $elements){
        foreach ($elements as $key => $value){
            if($value->user_id != $user_id){
                unset($elements[$key]);
            }
        }
        return $elements;
    }
}