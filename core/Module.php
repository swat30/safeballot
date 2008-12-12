<?php
/**
 * This file provides a framework for Modules
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @version 2.0
 */

/**
 * The module class provides a factory method to build Modules. 
 * 
 * You should never to to instantiate this class by itself. Instead you should access it
 * with something like:
 * <code>
 * $module = Module::factory('my_module');
 * </code>
 * @todo Provide handling for $_GET and $_POST variables and parse them into variable arrays.
 * @package CMS
 * @subpackage Core
 */
abstract class Module extends Observable  {
	
		/**
		 * A module level database connection. 
		 * 
		 * This is pseudo-unnessasary since the Database is
		 * availible statically with Database::singleton(), but it saves a tiny bit of memory to
		 * have it instantiated now.
		 *
		 * @var Database
		 * @static 
		 */
		public $db;
		public $version;
		protected $template;
		
		/**
		 * Create and return reference to loaded module.
		 * 
		 * This determines if the nessasary files exist for the module to be created. If so, it creates
		 * a SmartySite class for the module to use, then assigns it template directories, compiled template
		 * directories and makes sure the plugins directory is set to the core.
		 *
		 * @param string $name
		 * @return ref|bool Reference to loaded module
		 */
		public static final function &factory($name, $parentSmarty = null) {
			if (@include_once SITE_ROOT . '/modules/' . $name . '/' . $name . '.php') {

				require_once 'HTML/AJAX/Helper.php';
				$ajaxHelper = new HTML_AJAX_Helper ( );
				
				$classname = 'Module_' . $name;
				
				$module = new $classname;
				
				/*foreach (Config::getActiveModules() as $active) {
					include_once SITE_ROOT . '/modules/' . $active['module'] . '/' . $active['module'] . '.php';
					$modulename = 'Module_' . $active['module'];
					$trigger = new $modulename();
					if (is_subclass_of($trigger, 'Observer')) {
						$trigger->Build($module);
					}
				} */
				
				if (!is_null($parentSmarty)) {
					$module->parentSmarty =& $parentSmarty;
				}
				
				// Set up module's Smarty resouce. Make sure it has its own template directory
				// as well as a unique compile id. Using the class name is a clever way of avoiding
				// computing a _real_ unique one, since the site architecture will throw and error
				// long before Smarty does if there are overlapping class names.
				// If the template directory 'local' exists then we will load from that directory
				// instead of the normal one. This allows us to seperate templated content on a 
				// site-by-site basis and further seperates core code from custom module code.
				$module->smarty = new SmartySite();
				if (file_exists(SITE_ROOT . '/modules/' . $name . '/local')) {
					$module->smarty->template_dir = SITE_ROOT . '/modules/' . $name . '/templates/local';
				} else {
					$module->smarty->template_dir = SITE_ROOT . '/modules/' . $name . '/templates';
				}
				
				if (file_exists(SITE_ROOT . '/modules/' . $name . '/plugins')) {
					$module->smarty->plugins_dir[] = SITE_ROOT . '/modules/' . $name . '/plugins';
				}
				$module->smarty->compile_dir = SITE_ROOT . '/templates_c';
				$module->smarty->plugins_dir[] = SITE_ROOT . '/core/plugins';
				$module->smarty->compile_id = $classname;
				
				$module->smarty->assign('module', &$module);
				
				// Give the module access to the site-wide DB connection. This LOOKS like each module
				// is assigned its own DB object, but the class singleton ensures that its actually
				// a shared connection.
				$module->db = Database::singleton();
				if (@isset($_SESSION['authenticated_user'])) {
					$module->user = new User($_SESSION['authenticated_user']->getId());
					$module->smarty->assign_by_ref('user', $module->user);
					
				} 
				
				return $module;
			} else {
				return false;
			}
		}
		
		public function addCSS($url) {
			$this->parentSmarty->addCSS($url);
		}
		
		public function addJS($url) {
			$this->parentSmarty->addJS($url);
		}
		
		public function setPageTitle($title) {
			$this->parentSmarty->setPageTitle($title);
		}
		
		public function setMetaTitle($title) {
			$this->parentSmarty->setMetaTitle($title);
		}

		public function setMetaDescription($desc) {
			$this->parentSmarty->setMetaDescription($desc);
		}

		public function setMetaKeywords($kwrds) {
			$this->parentSmarty->setMetaKeywords($kwrds);
		}
		
		/**
		 * This sends a trigger signal to the Observable object.
		 *
		 * @param string $action
		 * @param unknown $data
		 */
		public function trigger($action, $data = null) {
			$this->setState($action);
        	$this->notifyObservers($data);
		}
		
		public function getProvidesInterface($method) {
			$test = new ReflectionClass($this);
			if ($test->hasMethod($method)) {
				return true;
			} else {
				return false;
			}
		}
}

?>
