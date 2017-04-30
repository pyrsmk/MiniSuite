<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value equals to another value
*/
class EqualsExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(func_num_args() < 2) {
            throw new \Exception("no value has been passed");
        }
        $value2 = func_get_arg(1);
        $type1 = gettype($value);
        $type2 = gettype($value2);
        if($type1 != $type2) {
            throw new \Exception("Types mismatch : $type1 vs $type2");
        }
        if($value != $value2) {
            $value = $this->format($value);
            $value2 = $this->format($value2);
            throw new \Exception("should equals to '$value2' but instead saw '$value'");
        }
    }

}
