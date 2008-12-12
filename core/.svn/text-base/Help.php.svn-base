<?php

include '../include/Site.php';
require_once 'HTML/AJAX/Helper.php';

$ajaxHelper = new HTML_AJAX_Helper();

class Help {
	
	private $title;
	private $body;
	
	function __construct($helpid = null) {
		$sql = 'select * from help where helpid="' . $helpid . '"';
		$help = Database::singleton()->query_fetch($sql);
		
		$this->title = $help['title'];
		$this->body = $help['body'];
	}
	
	function __toString() {
		return '<strong>' . $this->title . '</strong><br />' . $this->body;
	}
	
}

if ($ajaxHelper->isAJAX()) {
	$help = new Help($_REQUEST['helpid']);
	echo $help->__toString();
}
?>