<?php

namespace MiniSuite;

use Closure;
use Chernozem\Container as Chernozem;

/*
    Base suite class
*/
class Suite extends Chernozem {

    /*
        Closure $init
    */
    protected $init;
    
    /*
        Constructor

        Parameters
            string $name
    */
    public function __construct($name = null) {
        if($name) {
            echo "\n  $name\n\n";
        }
    }
    
    /*
        Register the init function
        
        Parameters
            Closure $init
        
        Return
            MiniSuite\Suite
    */
    public function hydrate(Closure $init) {
        $this->init = $init;
        return $this;
    }
    
    /*
        Run a test
        
        Return
            MiniSuite\Suite
    */
    public function expects($message) {
        // Hydrate tests
        if($this->init) {
            $hydrate = $this->init;
            $hydrate($this);
        }
        // Create expectation
        return new Expect(
            $this,
            function() use($message) {
                echo "    [v] $message\n";
            },
            function($err) use($message) {
                echo "    [x] $message\n",
                     "      $err\n";
            }
        );
    }
    
    /*
        Protect a closure
        
        Return
            Chernozem\Value
    */
    public function protect(Closure $value) {
        return new \Chernozem\Value($value);
    }
    
}
