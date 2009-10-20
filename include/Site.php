<?php

/**
 * Site Initialization
 *
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @subpackage Core
 * @version 2.0
 */
error_reporting(E_ALL);

if (isset($_GET['DEBUG'])) {
	define('DEBUG', true);
} else {
	define('DEBUG', false);
}

define('SITE_ROOT', realpath(dirname(__FILE__) . '/../'));
set_include_path(get_include_path() . PATH_SEPARATOR . SITE_ROOT . '/core' . PATH_SEPARATOR . SITE_ROOT . '/core/PEAR' . PATH_SEPARATOR . '/usr/share/php/');
include_once(SITE_ROOT . '/core/libs/Smarty.class.php');
include_once(SITE_ROOT . '/core/libs/Smarty_Compiler.class.php');
include_once(SITE_ROOT . '/core/User.php');

//include_once(SITE_ROOT . '/modules/Cart/include/CartBasket.php');
//include_once(SITE_ROOT . '/modules/Cart/include/CartProduct.php');

//session_start();

date_default_timezone_set('America/Halifax');
define('DISPLAY_TYPE_TABLE', 'table');

// To avoid having 'require' and 'include' all over the place, try
// and autoload the class from the core directory.
function __autoload($class_name) {
	if (!@include_once SITE_ROOT . '/core/' . $class_name . '.php') {
		@include_once SITE_ROOT . '/modules/' . $_REQUEST['module'] . '/include/' . $class_name . '.php';
	}
}

function e($itm) {
	return Database::singleton()->escape($itm);
}

function u($itm) {
	return Database::singleton()->unescape($itm);
}

function array_flatten($array, $preserve_keys = 1, &$newArray = Array()) {
	foreach ($array as $key => $child) {
		if (is_array($child)) {
			$newArray =& array_flatten($child, $preserve_keys, $newArray);
		} elseif ($preserve_keys + is_string($key) > 1) {
			$newArray[$key] = $child;
		} else {
			$newArray[] = $child;
		}
	}
	return $newArray;
}

function authHTML($data, $status, $obj = null) {
	global $smarty;
	 $smarty->template_dir = SITE_ROOT . '/templates';
	 $smarty->compile_dir = SITE_ROOT . '/templates_c';
	 $smarty->plugins_dir[] = SITE_ROOT . '/core/plugins';
	 $smarty->addJS('/js/login.js');
	 
	$config = Config::singleton();
	$modules = $config->getActiveModules();

	if(isset($modules[0]['module'])){
		$smarty->assign('activemodule', $modules[0]['module']);
	}
	
	/*if(!is_null($obj)){
		$smarty->assign('authErr', $obj->getError());
	}*/
	
	$smarty->assign('module', 'User');
	$content = $smarty->fetch('login.tpl');
	$smarty->content['User'] = $content;

	$smarty->render('db:site.tpl');
}

function authInlineHTML() {

	global $smarty;

	$content = $smarty->fetch('login.tpl');	

	$smarty->content[] = $content;
	//$content = $smarty->fetch('login.tpl');

	return $content;	
}


$lang = 'en_CA';
$_SESSION['lang'] = $lang;

putenv("LANGUAGE=" . $_SESSION['lang']); //This works
putenv("LANG=" . $_SESSION['lang']); // This DOES NOT WORK

setlocale(LC_MESSAGES,$_SESSION['lang']);

$domain = "messages"; //What you named your .po files
bindtextdomain($domain,"/home/mini/workspace/Norex2/I18N/locale"); //Where you put the locale dir.
textdomain($domain);



class SmartySite extends Smarty {

	public $css = array();
	public $js = array();
	public $title, $metaTitle, $metaDescription, $metaKeywords;
	
	/* In order to use function chaining (object dereferencing) we need to redefine the compiler class */
	public $compiler_class = 'Smarty_Compiler_Norex'; 

	function __construct() {
		
		$this->Smarty();
		
		/**
		 * This is a HACK. It sucks and I hate doing it. Sets the default namespace to module.
		 * @todo I really want to get rid of this namespace hack... somehow
		 */
		$this->assign('type', 'module');
		$this->compile_id = 'CMS';
	}

	function render($template) {
		$this->assign('css', $this->css);
		$this->assign('js', $this->js);
		$this->assign('title', $this->title);
		$this->assign('metaTitle', $this->metaTitle);
		$this->assign('metaDescription', $this->metaDescription);
		$this->assign('metaKeywords', $this->metaKeywords);

		if (is_null($this->title)) {
			$opts = Config::singleton()->getModuleOptions();
			$this->title = $opts['defaultPageTitle'];
		}
		$this->assign('title', $this->title);

		global $memory;
		global $startTime;

		$this->display($template);

		if (function_exists('memory_get_peak_usage') && function_exists('memory_get_usage')) {
			$memory .= 'Peak: ' . number_format(memory_get_peak_usage() / 1024, 0, '.', ',') . " KB \n";
			$memory .= 'End: ' . number_format(memory_get_usage() / 1024, 0, '.', ',') . " KB \n";
			$memory = 'Page generated in ' . (microtime(true) - $startTime) . ' seconds | Memory Usage: ' . ($memory);
			if (DEBUG) Debug::singleton()->addMessage('Load Time', $memory);
		}

		if (DEBUG) echo Debug::singleton();
	}

	function addCSS($url) {
		if (!in_array($url, $this->css)) {
			$this->css[] = $url;
		}
	}

	function addJS($url) {
		if (!in_array($url, $this->js)) {
			$this->js[] = $url;
		}
	}

	function setPageTitle($title) {
		$this->title = $title;
	}
	
	function setMetaTitle($metaTitle) {
		$this->metaTitle = $metaTitle;
	}
	
	function setMetaDescription($metaDescription) {
		$this->metaDescription = $metaDescription;
	}
	
	function setMetaKeywords($metaKeywords) {
		$this->metaKeywords = $metaKeywords;
	}

}

/* In order to use function chaining (object dereferencing) we need to redefine the compiler class */
class Smarty_Compiler_Norex extends Smarty_Compiler {

    public $_obj_call_regexp = null;
   
    function __construct() {
       $this->Smarty_Compiler();
       
       $this->_obj_call_regexp = '(?:' . $this->_obj_start_regexp . '(?:' . $this->_obj_params_regexp . ''.'(?:' . $this->_obj_ext_regexp . '(?:' . $this->_obj_params_regexp . '|' . $this->_obj_single_param_regexp . '(?:\s*,\s*' . $this->_obj_single_param_regexp . ')*))*' .    ')?(?:' . $this->_dvar_math_regexp . '(?:' . $this->_num_const_regexp . '|' . $this->_dvar_math_var_regexp . ')*)?)';
    }
}

//require_once(SITE_ROOT . '/core/plugins/resource.db.php');
$smarty = new SmartySite();


$config = Config::singleton();

$smarty->assign('config', $config);
if (file_exists(SITE_ROOT . '/templates/local')) {
	$smarty->template_dir = SITE_ROOT . '/templates/local';
}
$smarty->compile_dir = SITE_ROOT . '/templates_c';
$smarty->plugins_dir[] = SITE_ROOT . '/core/plugins';
?>
