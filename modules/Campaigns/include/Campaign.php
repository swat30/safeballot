<?php
class Campaign {
	protected $id = null;
	protected $name = null;
	protected $description = null;
	protected $group = null;
	protected $status = null;
	protected $startDate = null;
	protected $endDate = null;
	protected $archived = null;
	
	public function __construct( $id = null ){
		if(!is_null($id)){
			$sql = "SELECT * FROM campaigns WHERE id=".$id;
			$result = Database::singleton()->query_fetch($sql);
			
			$this->id = $result['id'];
			$this->name = $result['name'];
			$this->description = $result['description'];
			$this->group = $result['group_id'];
			$this->startDate = $result['startDate'];
			$this->endDate = $result['endDate'];
			$this->status = $this->calcStatus();
			$this->archived = $result['status'];
			$this->autosend = $result['autosend'];
		}
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getGroup(){
		return $this->group;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function getStartDate(){
		return $this->startDate;
	}
	
	public function getEndDate(){
		return $this->endDate;
	}
	
	public function getArchiveStatus(){
		return $this->archived;
	}
	
	public function getAutoSend() {
		return $this->autosend;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function setDescription($desc){
		$this->description = $desc;
	}
	
	public function setGroup($group){
		$this->group = $group;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function setStartDate($date){
		$this->startDate = $date;
	}
	
	public function setEndDate($date){
		$this->endDate = $date;
	}
	
	public function setArchiveStatus($status){
		$this->archived = $status;
	}
	
	public function setAutoSend($status){
		$this->autosend = $status;
	}
	
	public function save(){
		if(!is_null($this->id)){
			$sql = "UPDATE campaigns SET ";
		} else {
			$sql = "INSERT INTO campaigns SET ";
		}
		
		if(!is_null($this->name)){
			$sql .= "name = \"".e($this->name)."\", ";
		}
		if(!is_null($this->description)){
			$sql .= "description = \"".e($this->description)."\", ";
		}
		if(!is_null($this->group)){
			$sql .= "group_id = \"".e($this->group)."\", ";
		}
		if(!is_null($this->startDate)){
			$sql .= "startDate = \"".e($this->startDate)."\", ";
		}
		if(!is_null($this->endDate)){
			$sql .= "endDate = \"".e($this->endDate)."\", ";
		}
		if(!is_null($this->archived)){
			$sql .= "status = \"".e($this->archived)."\", ";
		}
		if(!is_null($this->autosend)){
			$sql .= "autosend = \"".e($this->autosend)."\", ";
		}
		
		if (!is_null($this->id)) {
			$sql .= 'id="' . e($this->id) . '" where id="' . $this->id . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
			$this->genHash();
		}
	}
	
	public function delete(){
		$sql = 'delete from campaigns where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}
	
	public function calcStatus($int = false){
		$today = date('U');
		
		if($today > strtotime($this->endDate)){
			if($int){
				return 0;
			}
			return 'Ended on '.$this->endDate;
		} else if($today < strtotime($this->startDate)){
			if($int){
				return 2;
			}
			return 'Upcoming on '.$this->startDate;
		}
		if($int){
			return 1;
		}
		return 'In progress, ends on '.$this->endDate;
	}
	
	public function formatDate($date){
		$newDate = null;
		$newDate = @date("Y-m-d H:i:s" ,mktime($date['H'], $date['i'], '00', $date['F'], $date['d'], $date['Y']));
		return $newDate;
	}
	
	
	public function validDates($dates, $value){
		foreach($dates as $date){
			foreach($date as $item){
				if(empty($item) && $item != 0){
					return false;
				}
			}
		}
		
		$start = strtotime($this->formatDate($dates[0]));
		$end = strtotime($this->formatDate($dates[1]));
		if($start > $end || $start < date('U')) {
			return false;
		} 
		return true;
	}
	
	public function genHash($id = null){
		if(is_null($id)){
			$recipients = Campaign::getRecipients($this->getGroup());
			foreach($recipients as $recipient){
				do{
					$hash = sha1(uniqid($this->getId(), true));
					$hash = substr($hash, 0, 20);
				
					$sql = 'INSERT INTO campaign_hash SET user_id="'.e($recipient->getId()).'", campaign_id="'.e($this->getId()).'", hash="'.e($hash).'"';
					$result = Database::singleton()->query($sql);
				} while(!$result);
			}
		} else {
			$recipient = new CampaignUser($id);
			do{
				$hash = sha1(uniqid($this->getId(), true));
				$hash = substr($hash, 0, 20);
			
				$sql = 'INSERT INTO campaign_hash SET user_id="'.e($recipient->getId()).'", campaign_id="'.e($this->getId()).'", hash="'.e($hash).'"';
				$result = Database::singleton()->query($sql);
			} while(!$result);
		}
	}
	
	public static function checkHash($hash){
		$sql = 'SELECT * FROM campaign_votes WHERE hash="'.$hash.'"';
		$check = Database::singleton()->query_fetch($sql);
		if(!$check){
			$sql = 'SELECT campaign_id FROM campaign_hash WHERE hash="'.$hash.'"';
			$result = Database::singleton()->query_fetch($sql);
			
			return $result['campaign_id'];
		}
		return false;
	}
	
	public function getAddEditForm($target = '/admin/Campaigns&section=addedit'){
		$form = new Form ( 'campaign_addedit', 'POST', $target, '', array ('class' => 'admin' ) );
		
		$form->addElement('text', 'name', 'Name');
		$form->addElement('select', 'auto_send', 'Auto-reminder on start', array(0=>'Disable', 1=>'Enable'));
		
		$date[] = $form->createElement('date', 'start_date', 'Start Date', array('format'=>'d F Y - H : i', 'addEmptyOption'=>'true', 'emptyOptionValue'=>'', 'emptyOptionText'=> 'Select', 'minYear'=>date('Y'), 'maxYear'=>date('Y') + 3), array( 'onchange' => 'return !updateEndDate(this)' ));
		$date[] = $form->createElement('date', 'end_date', 'End Date', array('format'=>'d F Y - H : i', 'addEmptyOption'=>'true', 'emptyOptionValue'=>'', 'emptyOptionText'=> 'Select', 'minYear'=>date('Y'), 'maxYear'=>date('Y') + 5));
		$form->addElement($date[0]);
		$form->addElement($date[1]);
		$form->addElement('tinymce', 'description', 'Description');
		$form->addElement('submit', 'submit', 'Submit');
		
		if (!is_null($this->id)) {
			$form->setConstants( array ( 'campaign_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'campaign_id' );
			
			$defaultValues ['name'] = $this->getName();
			$defaultValues ['start_date'] = $this->getStartDate();
			$defaultValues ['end_date'] = $this->getEndDate();
			$defaultValues ['description'] = $this->getDescription();
			$defaultValues ['auto_send'] = $this->getAutoSend();

			$form->setDefaults( $defaultValues );
		}

		$form->registerRule('validDate', 'function', 'validDates', $this);
		//ValidDate...  get it?
		$form->addRule(array( 'start_date', 'end_date'), 'Please make sure that the event has a positive length and that it begins after the current date/time', 'validDate');
		$form->addRule('name', 'Please enter a campaign name', 'required');
		
		if($form->isSubmitted() && isset($_POST['submit'])){
			if($form->validate()){
				$this->setName($form->exportValue('name'));
				$this->setGroup($_SESSION['authenticated_user']->getAuthGroup());
				$this->setDescription($form->exportValue('description'));
				$this->setStartDate($this->formatDate($form->exportValue('start_date')));
				$this->setEndDate($this->formatDate($form->exportValue('end_date')));
				$this->setStatus($this->calcStatus());
				$this->setAutoSend($form->exportValue('auto_send'));
				$this->save();
			}
		}
		
		return $form;
	}
	
	public static function getCampaigns($group, $status = null, $order = null){
		$campaigns = array();
		$sql = 'SELECT * FROM campaigns WHERE group_id="'.$group.'"';
		if(!is_null($status)){
			$sql .= ' AND status="'.$status.'"';
		}
		if(!is_null($order)){
			$sql .= ' ORDER BY '.$order;
		}
		$results = Database::singleton()->query_fetch_all($sql);
		$campaigns['upcoming'] = array();
		$campaigns['progress'] = array();
		$campaigns['ended'] = array();
		foreach($results as &$result){
			if(strtotime($result['startDate']) > date('U')){
				$campaigns['upcoming'][] = new Campaign($result['id']);
			} else if(strtotime($result['endDate']) <= date('U')){
				$campaigns['ended'][] = new Campaign($result['id']);
			} else {
				$campaigns['progress'][] = new Campaign($result['id']);
			}
		}
		return $campaigns;
	}
	
	public function getVoteForm($hash){
		if($this->checkHash($hash) == $this->id){
			$form = new Form( 'vote', 'POST', '/Vote/'.$hash, '');
			
			$choices = array();
			
			foreach($this->getChoices() as $choice){
				if(count($this->getChoices($choice->getId())) > 0){
					$options = array();
					foreach($this->getChoices($choice->getId()) as $option){
						$options[] =& $form->createElement('radio', null, null, $option->getChoice(), $option->getId());
					}
					$form->addGroup($options, 'vote_choice['.$choice->getId().']', $choice->getChoice(), '<br/>');
				}
			}

			$form->addElement('submit', 'submit', 'Vote');
			
			return $form;
		}
		return false;
	}
	
	public function getHashForm(){
		$form = new Form( 'insert_hash', 'POST', '/Vote/', '');
		$form->addElement('text', 'hash', 'Hash');
		$form->addElement('submit', 'hash_submit', 'Submit');
		
		$form->addRule('hash', 'Please enter your hash key', 'required');
		
		return $form;
	}
	
	public function getChoices($parent = 0){
		$sql = 'SELECT * FROM campaign_choices WHERE campaign_id="'.$this->id.'" AND parent="'.e($parent).'" ORDER BY id ASC';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach($results as &$result){
			$result = new CampaignChoice($result['id']);
		}
		
		return $results;
	}
	
	public static function getRecipients($company, $type = null){
		$sql = 'SELECT name,id FROM campaign_recipients WHERE group_id="'.e($company).'"';
		if(!is_null($type)) $sql .= ' AND contact_type="'.e($type).'"';
		$sql .= ' ORDER BY name ASC';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach($results as &$result){
			$result = new CampaignUser($result['id']);
		}
		
		return $results;
	}
	
	
	public static function getCSVForm($target = '/admin/Campaigns&section=recipcsvup'){
		$form = new Form( 'csv_add', 'POST', $target, '', array ('class' => 'admin'));
		
		$form->addElement('file', 'csv_file', 'CSV File');
		$form->addElement('submit', 'submit', 'Upload');
		$form->addRule('csv_file', 'Please upload a csv file', 'uploaded');
		
		if($form->validate() && $form->isSubmitted() && $_POST['submit']){
			Campaign::parseCsv($_FILES['csv_file']['tmp_name']);
		}
		
		return $form;
	}
	
	public function sortVotes($parent = 0){
		$choices = $this->getChoices($parent);
		$sortChoices = array();
		
		foreach($choices as $choice){
			$sortChoices[$choice->getId()] = $choice->getVotes();
		}
		
		arsort($sortChoices, SORT_NUMERIC);
		
		foreach($sortChoices as $key => &$choice){
			$choice = new CampaignChoice($key);
		}
		
		return $sortChoices;
	}
	
	public function getVoteCount(){
		$choices = $this->getChoices();
		$count = 0;
		
		foreach($choices as $choice){
			$tempCount = 0;
			foreach($this->getChoices($choice->getId()) as $option){
				$tempCount += $option->getVotes();
			}
			if($tempCount > $count) $count = $tempCount;
		}
		
		return $count;
	}
	
	public static function parseCsv($csvfile){
		$handle = fopen($csvfile, 'r');
		while(($data = fgetcsv($handle)) != false){
			$newRecip = new CampaignUser();
			$newRecip->setName($data[0]);
			$newRecip->setEmail($data[1]);
			$newRecip->setGroup($_SESSION['authenticated_user']->getAuthGroup());
			$newRecip->save();
		}
	}
	
	public function userCount() {
		$sql = 'SELECT hash FROM campaign_hash WHERE campaign_id="'.$this->id.'"';
		$results = Database::singleton()->query_fetch_all($sql);
		
		return count($results);
	}
	
	public function mailOut($what, $authgroup = null, $useremail = null){
		$errCnt = 0;
		if(is_null($authgroup)){
			$authgroup = $_SESSION['authenticated_user']->getAuthGroupName();
		}
		if(is_null($useremail)){
			$useremail = $_SESSION['authenticated_user']->getEmail();
		}
		switch($what){
			case 'votes':
				$recipients = Campaign::getRecipients($this->group);
				
				foreach($recipients as &$recipient){
					if(!is_null(trim($recipient->getEmail())) && !is_null($recipient->getHash($this->id))){
						$body = "Dear ".$recipient->getName().",\n\n";
						$body .= $authgroup." would like to invite you to vote on the following campaign: ";
						$body .= $this->getName();
						$body .= "\nVoting begins on ".$this->startDate." and ends on ".$this->endDate.". You will only be able to vote during this time period.";
						$body .= "\n\nPlease goto the following link to vote: https://www.safeballot.com/Vote/".$recipient->getHash($this->getId());
						$body .= "\nOr you may goto https://www.safeballot.com/Vote/ and enter '".$recipient->getHash($this->getId())."'.";
						$body .= "\n\nIf you have any questions please contact ".$authgroup." at ".$useremail;
						if(!mail($recipient->getEmail(), 'Voting Campaign', $body, "From: Safeballot <safeballot@safeballot.com>\nReply-to: ".$authgroup." <".$useremail.">")){
							$errCnt++;
						}
					}
				}
				
				if($errCnt > 0){
					return $errCnt.' e-mail(s) failed to send.';
				}
				return 'All e-mails were sent successfully.';
			case 'results':
				$recipients = Campaign::getRecipients($this->group, 'result');
				$recipients = array_merge($recipients, Campaign::getRecipients($this->group, 'admin'));
				$choices = $this->sortVotes();
				
				foreach($recipients as &$recipient){
					if(!is_null(trim($recipient->getEmail())) && !is_null($recipient->getHash($this->id))){
						$body = "Dear ".$recipient->getName().",\n\n";
						$body .= $_SESSION['authenticated_user']->getAuthGroupName()."'s campaign '".$this->getName()."'";
						$body .= "\nVoting ended on ".$this->endDate.".";
						$body .= "\n\nFrom highest to lowest votes, the results were as follows:";
						
						foreach($choices as $choice){
							$body.= "\n\t- ".$choice->getChoice();
							$options = $this->sortVotes($choice->getId());
							foreach($options as $option){
								$body .= "\n\t\t- ".$option->getChoice().": ".$option->getVotes();
							}
						}
						
						if(!mail($recipient->getEmail(), 'Voting Campaign Results', $body, "From: Safeballot <safeballot@safeballot.com>")){
							$errCnt++;
						}
					}
				}
				
				if($errCnt > 0){
					return $errCnt.' e-mail(s) failed to send.';
				}
				return 'All e-mails were sent successfully.';
			default:
				return 'Nothing to e-mail.';
		}
	}
	
	public function preparePdf(){
		$genPdf = new FPDF();
		
		$recipients = Campaign::getRecipients($this->group);
		
		$genPdf->AddPage();
		$genPdf->SetFont('Arial', 'B', "9px");
		foreach($recipients as &$recipient){
			if (!is_null($recipient->getHash($this->id))){ 
				$genPdf->Cell("100%", "12px", $this->name." Voter: ".$recipient->getName(), "LBT", 0);
				$genPdf->Cell("95%", "12px", "Hash: ".$recipient->getHash($this->getId()), "RBT", 1, 'R');
			}
		}
		
		$genPdf->Output();
		$genPdf->Close();
	}
	
	public function userVotedList($voted = true){
		$sql = 'SELECT user_id, hash FROM campaign_hash WHERE campaign_id='.$this->getId();
		$users = Database::singleton()->query_fetch_all($sql);
		$retUsers = array();
		foreach($users as $user){
			$sql = 'SELECT id FROM campaign_votes WHERE hash="'.$user['hash'].'" limit 1';
			$result = Database::singleton()->query_fetch($sql);

			if((($voted && $result['id']) || (!$voted && !$result['id']))){
				$retUsers[] = new CampaignUser($user['user_id']);
			}
		}
		return $retUsers;
	}
	
	public function questionError(){
		$err = false;
		if(count($this->getChoices()) < 1) return true;
		foreach($this->getChoices() as $parent){
			if(count($this->getChoices($parent->getId())) < 2){
				$err = true;
				break;
			}
		}
		return $err;
	}
}
?>