<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is not an array
*/
class IsNotArrayExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(is_array($value)) {
            throw new \Exception('is an array, but should not');
        }
    }

}
