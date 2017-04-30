<?php

namespace MiniSuite;

/*
    Expectation interface
*/
interface ExpectationInterface {

    /*
        Check if the condition is matched

        Parameters
            mixed $value
    */
    public function check($value);

}
