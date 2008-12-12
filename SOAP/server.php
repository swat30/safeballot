<?php
require_once('../include/Site.php');
require_once '../core/SOAP/nusoap.php';

$server = new soap_server;
$ns = 'http://' . $_SERVER['SERVER_NAME'] . '/SOAP';

$server->configureWSDL('cms', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

$active = Config::getActiveModules();
foreach ($active as $module) {
	$cur = Module::factory($module['module']);
	if ($cur->getProvidesInterface('getSoapInterface')) {
		$cur->getSoapInterface(&$server, $ns);
	}
}

$server->wsdl->addComplexType(
    'versions',
    'complexType',
    'struct',
    'all',
    '',
array(
        'name' => array('name' => 'name', 'type' => 'xsd:string'),
        'version' => array('name' => 'version', 'type' => 'xsd:string')
)
);

$server->wsdl->addComplexType(
    'VersionsArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
array(),
array(
array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:versions[]')
),
    'tns:versions'
);



// Register the method to expose
$server->register('cmsversion',                // method name
array(),        // input parameters
array('return' => 'xsd:string'),      // output parameters
$ns);

$server->register('moduleversions',                // method name
array(),        // input parameters
array('return' => 'tns:VersionsArray'),      // output parameters
$ns);

function moduleversions() {
	$active = Config::getActiveModules();
	$versions = array();
	foreach ($active as $module) {
		$cur = Module::factory($module['module']);
		$versions[] = array('name'=>$module['module'], 'version' => $cur->version);
		unset($cur);
	}
	return $versions;
}

function cmsversion() {
	return '4.99-gamma';
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>