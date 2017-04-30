<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value is not the same as another value
*/
class IsNotTheSameAsExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        if(func_num_args() < 2) {
            throw new \Exception('no value has been passed');
        }
        $val = func_get_arg(1);
        if($value === $val) {
            $val = $this->format($val);
            throw new \Exception("is the same as '$val' but should not");
        }
    }

}
