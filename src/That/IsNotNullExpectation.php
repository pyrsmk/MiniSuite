<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is not null
*/
class IsNotNullExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(is_null($value)) {
            throw new \Exception('is null, but should not');
        }
    }

}
