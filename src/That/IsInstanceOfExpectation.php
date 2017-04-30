<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is an instance of the specified class
*/
class IsInstanceOfExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(func_num_args() < 2) {
            throw new \Exception('no class has been passed');
        }
        $class = func_get_arg(1);
        if(!($value instanceof $class)) {
            $class = $this->format($class);
            throw new \Exception("is not an instance of '$class'");
        }
    }

}
