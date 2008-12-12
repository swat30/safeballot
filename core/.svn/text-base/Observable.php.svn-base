<?php
/**
 * Observable Class
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @version 2.0
 */

/**
 * Observable Class
 * 
 * Create an Observable object. Observable objects allow other objects to modify them at runtime.
 * @package CMS
 * @subpackage Core
 */
class Observable {
    /**
    * Private
    * @var an array of Observer objects to notify
    */
    public $observers;
 
    /**
    * Private
    * $state store the state of this observable object
    */
    public $state;
 
    /**
    * Constructs the Observerable object
    */
    function Observable () {
        $this->observers=array();
    }
 
    /**
    * Calls the update() function using the reference to each
    * registered observer - used by children of Observable
    * @return void
    */ 
    function notifyObservers ($data = null) {
        $observers=count($this->observers);
        for ($i=0;$i<$observers;$i++) {
            $this->observers[$i]->update($data);
        }
    }
 
    /**
    * Register the reference to an object object
    * @return void
    */ 
    function addObserver (& $observer) {
        $this->observers[]=& $observer;
    }
 
    /**
    * Returns the current value of the state property
    * @return mixed
    */ 
    function getState () {
        return $this->state;
    }
 
    /**
    * Assigns a value to state property
    * @param $state mixed variable to store
    * @return void
    */ 
    function setState ($state) {
        $this->state=$state;
    }
}
?>
