<?php
/**
 * Observer Class
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @version 2.0
 */

/**
 * Observer Class
 * 
 * Create an Observer object. An observer object and modify an Observable object at runtime
 * using triggers.
 * 
 * @package CMS
 * @subpackage Core
 */
class Observer {
    /**
    * Private
    * $subject a child of class Observable that we're observing
    */
    public $subject;
    public $smarty;
 
    /**
    * Constructs the Observer
    * @param $subject the object to observe
    */
    function Observer (& $subject) {
        $this->subject=& $subject;
        // Register this object so subject can notify it
        $subject->addObserver($this);
        $this->smarty = new SmartySite();
        $this->smarty->compile_dir = SITE_ROOT . '/templates_c';
    }
 
    /**
    * Abstract function implemented by children to repond to
    * to changes in Observable subject
    * @return void
    */    
    function update() {
        trigger_error ('Update not implemented');
    }
}
?>
