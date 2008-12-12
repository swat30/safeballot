<?php

/**
 * The config class provides a get/set mechanism for both global CMS options
 * as well as module specific options.
 * @package CMS
 * @author Christopher Troup <chris@norex.ca>
 * @version 2.0
 */

/**
 * Get and Set module and core options.
 * 
 * Your should never try to instatiate this class by itself. It WOULD be resource
 * intensive that way. Instead, use its singleton() accessor method to get its 
 * static reference.
 * @package CMS
 * @subpackage Core
 */
class Config {

	/**
	 * Contains a reference to the single instance of the config object
	 *
	 * @var Config
	 * @static 
	 */
	private static $instance;

	/**
	 * Contains an array of global CMS options
	 *
	 * @var array
	 */
	public $options;

	/**
	 * An array of currently active modules
	 *
	 * @var array
	 * @static
	 */
	public static $activeModules = null;

	/**
	 * Constructs the Config object.
	 * 
	 * Sets the object's options var to the global CMS options
	 */
	protected function __construct() {
		$this->options = $this->getModuleOptions();
	}

	/**
	 * Return a reference to the Config object
	 * 
	 * If the object has not yet been created, then create the object and
	 * set a link to it. Otherwise, skip creating the object and simply
	 * return the link.
	 *
	 * @return ref
	 * @static 
	 */
	public static function singleton() {
		if (! isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c();
		}
		
		return self::$instance;
	}

	/**
	 * Get currently active modules
	 *
	 * @return array
	 * @static 
	 */
	public static function getActiveModules() {
		// Nifty little bit of caching to save a database query or two (or fifty). If the active
		// modules are not already stored then get them from the DB and cache them using the
		// static keyword variable.
		if (is_null(self::$activeModules)) {
			$sql = 'select * from modules where status="active" order by sort_order asc';
			$modules = Database::singleton()->query_fetch_all($sql);
			
			$active = array();
			foreach ($modules as $mod) {
				$active[$mod['id']] = $mod;
			}
			self::$activeModules = $active;
		}
		
		return self::$activeModules;
	}

	/**
	 * Check to see if module is a trigger
	 *
	 * @deprecated I don't think I ever actually used this. Remove it?
	 * @todo Check to see if isTrigger is actually used.
	 * @param string $module
	 */
	public static function isTrigger($module) {

	}

	/**
	 * Checks to see if the passed module is active
	 *
	 * @param string $name
	 * @return bool True if module is active, false otherwise
	 */
	public function getIsModuleActive($name) {
		
		foreach (self::getActiveModules() as $module) {
			if ($module['module'] == $name)
				return true;
		}
		return false;
	}

	/**
	 * Get an array of module options
	 *
	 * @param string $module
	 * @return array Array of options for the passed module name
	 */
	public function getModuleOptions($module = null) {
		if (! isset($module)) {
			$module = 'CMS';
		}
		//$classname = $module . '_Config';
		//if ((class_exists($classname)) || (@include_once SITE_ROOT . '/modules/' . $module . '/' . $module . '_Config.php')) {
		//	$configClass = new $classname();
		//	return $configClass->getModuleOptions();
		//} else {
			$sql = 'select options from module_options where module="' . $module . '" limit 1';
			$options = Database::singleton()->query_fetch_all($sql);
			$options = @unserialize($options[0]['options']);
			return $options;
		//}
	}

	/**
	 * Set module options
	 * 
	 * @todo This is probably not working. I don't really remember testing it.
	 * @param string $module
	 * @param array $options
	 * @return Config|bool If the working module is the core CMS then return status of update, otherwise return
	 * config object for work.
	 */
	public function setModuleOptions($module, $options) {
		$classname = $module . '_Config';
		if ((class_exists($classname)) || (@include_once SITE_ROOT . '/modules/' . $module . '/' . $module . '_Config.php')) {
			$configClass = new $classname();
			return $configClass->setModuleOptions();
		} else {
			
			$sql = 'update module_options set options="' . e(serialize($options)) . '" where module="' . $module . '"';
			return Database::singleton()->query($sql);
		}
	}

}

?>