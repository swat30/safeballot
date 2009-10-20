<?php
class CampaignUser {
	protected $name = null;
	protected $email = null;
	protected $id = null;
	protected $group = null;
	protected $type = null;
	
	public function __construct( $id = null ){
		if(!is_null($id)){
			$sql = "SELECT * FROM campaign_recipients WHERE id=\"".$id."\"";
			$result = Database::singleton()->query_fetch($sql);
			
			$this->id = $result['id'];
			$this->name = $result['name'];
			$this->email = $result['email'];
			$this->group = $result['group_id'];
			$this->type = $result['contact_type'];
		}
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setGroup($id){
		$this->group = $id;
	}
	
	public function setContactType($type){
		$this->type = $type;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getGroup(){
		return $this->group;
	}
	
	public function getContactType(){
		return $this->type;
	}
	
	public function save(){
		if(!is_null($this->id)){
			$sql = "UPDATE campaign_recipients SET ";
		} else {
			$sql = "INSERT INTO campaign_recipients SET ";
		}
		
		if(!is_null($this->name)){
			$sql .= "name = \"".e($this->name)."\", ";
		}
		if(!is_null($this->email)){
			$sql .= "email = \"".e($this->email)."\", ";
		}
		if(!is_null($this->group)){
			$sql .= "group_id = \"".e($this->group)."\", ";
		}
		if(!is_null($this->type)){
			$sql .= "contact_type = \"".e($this->type)."\", ";
		}
		
		if (!is_null($this->id)) {
			$sql .= 'id="' . e($this->id) . '" where id="' . $this->id . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
			if($_SESSION['authenticated_user']->hasPerm('newuserhash')){
				$this->existHashGen();
			}
		}
	}
	
	public function delete(){
		$sql = 'delete from campaign_recipients where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
		
		$sql = 'select campaign_id from campaign_hash where user_id="' . e($this->id) . '"';
		$campaigns = Database::singleton()->query_fetch_all($sql);
		foreach($campaigns as $campaign){
			$campaign = new Campaign($campaign['campaign_id']);
			if(strpos($campaign->getStatus(), "pcoming") > 0){
				$sql = 'delete from campaign_hash where campaign_id="'.e($campaign->getId()).'" and user_id="'.e($this->id).'"';
				Database::singleton()->query($sql);
			}
		}
	}
	
	public static function exists($id){
		$sql = 'SELECT id FROM campaign_recipients WHERE id="'.$id.'"';
		$result = Database::singleton()->query_fetch($sql);
		
		if($result){
			return true;
		}
		return false;
	}
	
	public static function getByEmail($addr){
		if(filter_var($addr, FILTER_VALIDATE_EMAIL)){
			$sql = 'SELECT id FROM campaign_recipients WHERE email = \''.e($addr)."'";
			$result = Database::singleton()->query_fetch_all($sql);
			
			if($result && count($result) == 1){
				$id = $result[0]['id'];
				$sql = 'INSERT INTO campaign_hash_requests SET IP = \''.$_SERVER['REMOTE_ADDR'].'\', email = \''.e($addr).'\'';
				
				Database::singleton()->query($sql);
				
				$sql = 'SELECT hash,campaign_id FROM campaign_hash WHERE user_id = '.$id;
				$results = Database::singleton()->query_fetch_all($sql);
				
				$body = "This e-mail address was used to request the retrieval of hash keys on the SafeBallot system. ".
					"If you believe you have received this message in error, please contact the person in charge of voting ".
					"campaigns at your organization and ensure to keep the original copy of this contact.\n\nHash keys:\n";
				if($results){
					for($i = 0; $i < count($results); $i++){
						$cid = $results[$i]["campaign_id"];
						$hash = $results[$i]["hash"];
						$campaign = new Campaign($cid);
						
						if($campaign->calcStatus(true) == 1){
							$body .= "\nCampaign '".$campaign->getName()."' -> ".$hash;
						}
					}
				} else
					$body .= "There are currently no voting campaigns in progress.";
					
				mail($addr, 'Hash Key Retrieval', $body, "From: Safeballot <safeballot@safeballot.com>");
				return true;
			}
		}
		
		return false;
	}
	
	public static function getRetievalForm(&$err = false, $target = '/Vote/Retrieve_Key'){
		$form = new Form('campaign_hash_retrieval', 'POST', $target);
		
		$form->addElement('text', 'email', 'Your E-mail Address');
		$form->addElement('submit', 'submit', 'Retrieve');
		$form->addRule('email', 'You must enter a valid e-mail address', 'required');
		
		if($form->isSubmitted() && isset($_POST['submit'])){
			if($form->validate()){
				$err = !CampaignUser::getByEmail($form->exportValue('email'));
			}
		}
		
		return $form;
	}
	
	public function getAddEditForm($target = '/admin/Campaigns&section=recipaddedit'){
		$form = new Form ( 'campaign_recipient_addedit', 'POST', $target, '', array ('class' => 'admin' ) );
		
		$form->addElement('text', 'name', 'Name');
		$form->addElement('text', 'email', 'E-mail');
		$chk = & $form->createElement('select', 'contact_type', 'Contact type', array("admin" => "Admin", "result" => "Result viewer", "normal" => "Normal user"));
		$form->addElement($chk);
		$form->addElement('hidden', 'group_id', $this->group);
		$form->addElement('submit', 'submit', 'Submit');
		
		$form->addRule('name', 'Please enter a recipient name', 'required');
		$form->addRule('email', 'Please enter an email address', 'required');
		
		if (!is_null($this->id)) {
			$form->setConstants( array ( 'recipient_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'recipient_id' );
			
			$defaultValues ['name'] = $this->getName();
			$defaultValues ['email'] = $this->getEmail();
			$defaultValues ['contact_type'] = $this->getContactType();
		} else $defaultValues ['contact_type'] = "normal";
		$form->setDefaults( $defaultValues ); 
		
		if($form->isSubmitted() && isset($_POST['submit'])){
			if($form->validate()){
				$this->name = $form->exportValue('name');
				$this->email = $form->exportValue('email');
				$this->type = $form->exportValue('contact_type');
			
				$this->save();
			}
		}
		
		return $form;
	}
	
	public function getHash($campaign){
		$sql = 'SELECT hash FROM campaign_hash WHERE user_id="'.$this->id.'" AND campaign_id="'.$campaign.'"';
		$result = Database::singleton()->query_fetch($sql);
		
		return $result['hash'];
	}
	
	public function existHashGen(){
		$campaigns = Campaign::getCampaigns($this->group);
		$campaigns = array_merge($campaigns['upcoming'], $campaigns['progress']);
		foreach($campaigns as $campaign){
			$campaign->genHash($this->id);
		}
	}
}
?>