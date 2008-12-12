<?php
// Pull in the NuSOAP code
require_once('../core/SOAP/nusoap.php');
// Create the client instance
$client = new nusoap_client('http://norex.chatetheory.com/SOAP/server.php?wsdl', true);
// Call the SOAP method

$proxy = $client->getProxy();

$err = $proxy->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}


$result = $proxy->call('cmsversion', array());
// Display the result
echo 'CMS Version: ';
print_r($result);
echo "<br /><br />";

$result = $proxy->call('moduleversions', array());
// Display the result
echo 'Modules Version: <br />';
foreach ($result as $mod) {
	echo '<strong>Module:</strong> ' . $mod['name'] . ' <strong>Version:</strong> ' . $mod['version'] . "<br />";
}

echo '<p>This is a SOAP method provided by the Content Module</p>';
echo '<strong>Link Type of Content Module: </strong>';
$result = $proxy->call('Module_Content.linkType', array());
echo($result);

?>
