<?php
//if($_SERVER['HOSTNAME'] == 'woz.norex.ca' && $_SERVER['LOGNAME'] == 'safeballots'){
	ini_set('safe_mode', 'off');
	$dir = '/var/www/vhosts/safeballot.com/httpdocs';
	set_include_path($_SERVER['PWD'] . '/httpdocs/');
	include('../../../core/Database.php');
	include('../include/Campaign.php');
	include('../include/CampaignUser.php');
	$sql = 'SELECT id FROM campaigns where autosend = 1';
	if(@$argv[1] == 'debug'){
		$debug = true;
	}
	$results = Database::singleton()->query_fetch_all($sql);
	foreach($results as &$campaign){
		$campaign = new Campaign($campaign['id']);
		switch ($campaign->calcStatus(true)){
			case 2:
				break;
			case 1:
				$sql = 'SELECT aut_email FROM auth WHERE aut_agp_id = '.$campaign->getGroup().' LIMIT 1';
				$email = Database::singleton()->query_fetch($sql);
				$email = $email['aut_email'];
				$sql = 'SELECT agp_name FROM auth_groups WHERE agp_id = '.$campaign->getGroup();
				$group = Database::singleton()->query_fetch($sql);
				$group = $group['agp_name'];
				$campaign->mailOut('votes', $group, $email);
				if($debug){
					echo "Sent ".$campaign->getName()." emails.\n";
				}
			default:
				$sql = 'UPDATE campaigns SET autosend = 0 WHERE id = '.$campaign->getId();
				$result = Database::singleton()->query($sql);
				if($debug){
					echo "Removed ".$campaign->getName()."'s autosend.\n";
				}
				break;
		}
	}
//}

?>