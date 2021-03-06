<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is a resource
*/
class IsResourceExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(!is_resource($value)) {
            $value = $this->format($value);
            throw new \Exception("should be a resource but instead saw '$value'");
        }
    }

}
