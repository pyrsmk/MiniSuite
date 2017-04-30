<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is not an object
*/
class IsNotObjectExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(is_object($value)) {
            throw new \Exception('is an object, but should not');
        }
    }

}
