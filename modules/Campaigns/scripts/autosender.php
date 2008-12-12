<?php
//if($_SERVER['HOSTNAME'] == 'woz.norex.ca' && $_SERVER['LOGNAME'] == 'safeballots'){
	set_include_path($_SERVER['PWD'] . '/httpdocs/');
	include_once('core/Database.php');
	include_once('modules/Campaigns/include/Campaign.php');
	include_once('modules/Campaigns/include/CampaignUser.php');
	$sql = 'SELECT id FROM campaigns where autosend = 1';
	$debug = false;
	if(@$argv[1] == 'debug'){
		$debug = true;
	}
	$results = Database::singleton()->query_fetch_all($sql);
	var_dump($results);
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