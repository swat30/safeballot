<?php
class CampaignChoice {
	protected $id = null;
	protected $campaign = null;
	protected $choice = null;
	protected $parent = null;
	
	public function __construct($id = null){
		if(!is_null($id)){
			$sql = 'SELECT * FROM campaign_choices WHERE id="'.$id.'"';
			$result = Database::singleton()->query_fetch($sql);
			
			$this->id = $result['id'];
			$this->campaign = $result['campaign_id'];
			$this->choice = $result['choice'];
			$this->parent = $result['parent'];
		}
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getCampaign(){
		return $this->campaign;
	}
	
	public function getChoice(){
		return $this->choice;
	}
	
	public function getParent(){
		return $this->parent;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setCampaign($campaign){
		$this->campaign = $campaign;
	}
	
	public function setChoice($choice){
		$this->choice = $choice;
	}
	
	public function setParent($parent){
		$this->parent = $parent;
	}
	
	public function save(){
		if(!is_null($this->id)){
			$sql = "UPDATE campaign_choices SET ";
		} else {
			$sql = "INSERT INTO campaign_choices SET ";
		}
		
		if(!is_null($this->choice)){
			$sql .= "choice = \"".e($this->choice)."\", ";
		}
		
		if(!is_null($this->campaign)){
			$sql .= "campaign_id = \"".e($this->campaign)."\", ";
		}
		
		$sql .= "parent = \"";
		if(!is_null($this->parent)){
			$sql .= e($this->parent);
		} else {
			$sql .= '0';
		}
		$sql .= "\", ";
		
		if (!is_null($this->id)) {
			$sql .= 'id="' . e($this->id) . '" where id="' . $this->id . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		
		Database::singleton()->query($sql);
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
		}
	}
	
	public function delete(){
		$sql = 'DELETE FROM campaign_choices WHERE id="'.$this->id.'" OR parent="'.$this->id.'"';
		$result = Database::singleton()->query($sql);
	}
	
	public function createChildren($children){
		if(isset($children['new'])){
			foreach(@$children['new'] as $nOption){
				if(!empty($nOption)){
					$opt = new CampaignChoice();
					$opt->setCampaign($this->getCampaign());
					$opt->setChoice(stripslashes($nOption));
					$opt->setParent($this->getId());
					$opt->save();
				}
			}
		}
		
		if(isset($children['exist'])){
			foreach(@$children['exist'] as $optId => $nOption){
				$opt = new CampaignChoice($optId);
				if(!empty($nOption)){
					$opt->setCampaign($this->getCampaign());
					$opt->setChoice(stripslashes($nOption));
					$opt->setParent($this->getId());
					$opt->save();
				} else {
					$opt->delete();
				}
			}
		}
	}
	
	public function getVotes(){
		$sql = 'SELECT id FROM campaign_votes WHERE choice_id="'.$this->id.'"';
		$result = Database::singleton()->query_fetch_all($sql);
		
		return count($result);
	}
	
	public function setVote($hash){
		//if($this->getCampaign() == Campaign::checkHash($hash)){
			$sql = 'INSERT INTO campaign_votes SET choice_id="'.$this->id.'", date="'.date("Y-m-d H:i:s").'", hash="'.$hash.'"';
			$result = Database::singleton()->query($sql);
		/*	return true;
		}
		return false;*/
	}
}

?>