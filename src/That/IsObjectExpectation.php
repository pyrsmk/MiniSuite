<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is an object
*/
class IsObjectExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(!is_object($value)) {
            $value = $this->format($value);
            throw new \Exception("should be an object but instead saw '$value'");
        }
    }

}
