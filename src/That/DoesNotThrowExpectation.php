<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
    Verify if the value does not throw an exception
*/
class DoesNotThrowExpectation extends AbstractExpectation {
    
    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value) {
        $isCallable = new IsCallableExpectation($this->minisuite);
        $isCallable->check($value);
        $class = func_num_args() >= 2 ? func_get_arg(1) : null;
        $error = null;
        try {
            $value($this->minisuite);
        }
        catch(\Exception $e) {
            if($class === null) {
                $error = 'should not throw an exception';
            }
            else if($e instanceof $class) {
                $class = $this->format($class);
                $error = "should not throw a '$class' exception";
            }
        }
        if($error) {
            throw new \Exception($error);
        }
    }

}
