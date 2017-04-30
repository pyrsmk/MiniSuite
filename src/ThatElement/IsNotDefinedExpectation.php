<?php

namespace MiniSuite\ThatElement;

use Minisuite\AbstractExpectation;

/*
    Verify if the element is not defined
*/
class IsNotDefinedExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        $index = func_get_arg(1);
        if(isset($value[$index])) {
            throw new \Exception("'$index' is defined but should not be");
        }
    }

}
