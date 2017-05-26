<?php

namespace App\Exceptions\CustomExceptions;

class DomainException extends Exception
{
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}