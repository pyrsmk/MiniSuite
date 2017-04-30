<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is null
*/
class IsNullExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(!is_null($value)) {
            $value = $this->format($value);
            throw new \Exception("expects to be null but is '$value'");
        }
    }

}
