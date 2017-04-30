<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is null
*/
class IsCallableExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(!is_callable($value)) {
            throw new \Exception('is not callable');
        }
    }

}
