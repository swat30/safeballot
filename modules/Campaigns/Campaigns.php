<?php
class Module_Campaigns extends Module {

	function getAdminInterface() {
		$this->addJS('/modules/Campaigns/js/voteadmin.js');
		$this->addCSS('/modules/Campaigns/css/campaign.css');
		switch(@$_REQUEST['section']){
			case 'addedit':
				if($this->user->hasPerm('addcampaign')){
					$campaign = new Campaign(@$_REQUEST['campaign_id']);
					$form = $campaign->getAddEditForm();
					$this->smarty->assign('form', $form);
					if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['submit'])) {
						return $this->topLevelAdmin();
					}
					return $this->smarty->fetch( 'admin/campaigns_addedit.tpl' );
				}
				return $this->smarty->fetch('../../../cms/templates/error.tpl');
			case 'campaigndelete':
				$campaign = new Campaign($_REQUEST['campaign_id']);
				if($this->user->hasPerm('addcampaign') && $this->user->getAuthGroup() == $campaign->getGroup() && strpos($campaign->getStatus(), 'pcoming') > 0){
					$campaign->delete();
					unset($campaign);
					return $this->topLevelAdmin();
				}
				return $this->smarty->fetch('../../../cms/templates/error.tpl');
			case 'viewresults':
				if($this->user->hasPerm('viewcampaign')){
					$campaign = new Campaign($_REQUEST['campaign_id']);
					$this->smarty->assign('campaign', $campaign);
					return $this->smarty->fetch('admin/campaign_results.tpl');
				}
				return $this->smarty->fetch('admin/campaign_recips_addedit.tpl');
			case 'questionedit':
				if($this->user->hasPerm('addcampaign')){
					$this->addJS('/modules/Campaigns/js/choice.js');
					$campaign = new Campaign($_REQUEST['campaign_id']);
					$this->smarty->assign('campaign', $campaign);
					if(isset($_REQUEST['choices_submit'])){
						
						if(!is_null(@$_REQUEST['choice'])){
							foreach($_REQUEST['choice'] as $key => $achoice){
								if(is_numeric($key)){
									$choice = new CampaignChoice($key);
									if(!empty($achoice['main'])){
										$choice->setCampaign($_REQUEST['campaign_id']);
										$choice->setChoice($achoice['main']);
										$choice->save();
										if(is_array(@$_REQUEST['choice'][$key])){
											$choice->createChildren($_REQUEST['choice'][$key]);
										}
									} else {
										$choice->delete();
									}
								}
							}
						}
						
						if(!is_null(@$_REQUEST['nChoice'])){
							if(isset($_REQUEST['nChoice'])){
								foreach($_REQUEST['nChoice'] as $key => $achoice){
									if(!empty($achoice['main'])){
										$choice = new CampaignChoice();
										$choice->setCampaign($_REQUEST['campaign_id']);
										$choice->setChoice($achoice['main']);
										$choice->save();
										if(is_array(@$_REQUEST['nChoice'][$key])){
											$choice->createChildren($_REQUEST['nChoice'][$key]);
										}
									}
								}
							}
						}
						
						return $this->topLevelAdmin();
					}
					return $this->smarty->fetch('admin/campaign_choices_addedit.tpl');
				}
				return $this->smarty->fetch('../../../cms/templates/error.tpl');
			case 'reciplist':
				return $this->recipTopLevelAdmin();
			case 'recipaddedit':
				if($this->user->hasPerm('addcampaignrecips')){
					if(!is_null(@$_REQUEST['recipient_id'])){
						$recipient = new CampaignUser($_REQUEST['recipient_id']);
					} else {
						$recipient = new CampaignUser();
						$recipient->setGroup($this->user->getAuthGroup());
					}
					$form = $recipient->getAddEditForm();
					$this->smarty->assign('form', $form);
					if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['submit'])) {
						return $this->recipTopLevelAdmin();
					}
					return $this->smarty->fetch('admin/campaign_recips_addedit.tpl');
				}
				return $this->smarty->fetch('../../../cms/templates/error.tpl');
			case 'recipcsvup':
				if($this->user->hasPerm('addcampaignrecips')){
					$form = Campaign::getCSVForm();
					$this->smarty->assign('form', $form);
					if($form->validate() && $form->isSubmitted() && $_POST['submit']){
						return $this->recipTopLevelAdmin();
					}
					return $this->smarty->fetch('admin/campaign_csvup.tpl');
				}
				return $this->smarty->fetch('../../../cms/templates/error.tpl');
			case 'recipdelete';
				if($this->user->hasPerm('addcampaignrecips')){
					if(!is_null($_REQUEST['id']) && CampaignUser::exists($_REQUEST['id'])){
						$recipient = new CampaignUser($_REQUEST['id']);
						if($recipient->getGroup() == $this->user->getAuthGroup()){
							$recipient->delete();
							unset($_REQUEST['id']);
						} else {
							return $this->smarty->fetch('../../../cms/templates/error.tpl');
						}
					}
					return $this->recipTopLevelAdmin();
				}
				return $this->smarty->fetch('../../../cms/templates/error.tpl');
			case 'votesend':
				if($this->user->hasPerm('addcampaignrecips')){
					$campaign = new Campaign($_REQUEST['campaign_id']);
					return $campaign->mailOut('votes');
				}
				return 'You do not have permission to perform this action.';
			case 'voteprint':
				if($this->user->hasPerm('generatereciplist')){
					$campaign = new Campaign($_REQUEST['campaign_id']);
					$campaign->preparePdf();
				}
				return $this->topLevelAdmin();
			case 'resultsend';
				if($this->user->hasPerm('addcampaignrecips')){
					$campaign = new Campaign($_REQUEST['campaign_id']);
					return $campaign->mailOut('results');
				}
				return 'You do not have permission to perform this action.';
			case 'listbilling':
				if($this->user->hasPerm('admin')){
					$groups = Group::getGroups();
					$this->smarty->assign('groups', $groups);
					return $this->smarty->fetch('admin/billing_list.tpl');
				}
			case 'viewbilling':
				if($this->user->hasPerm('admin')){
					$group = new Group($_REQUEST['group_id']);
					$this->smarty->assign('group', $group);
					$campaigns = Campaign::getCampaigns($_REQUEST['group_id']);
					$campaignsSorted = array_merge($campaigns['upcoming'], $campaigns['progress'], $campaigns['ended']);
					$this->smarty->assign('campaigns', $campaignsSorted);
					return $this->smarty->fetch('admin/billing_view.tpl');
				}
			case 'togglestatus':
				if($this->user->hasPerm('admin')){
					$group = new Group($_REQUEST['group_id']);
					if($group->getStatus() > 0){
						$group->setStatus(0);
					} else {
						$group->setStatus(1);
					}
					$group->save();
				}
				$groups = Group::getGroups();
				$this->smarty->assign('groups', $groups);
				return $this->smarty->fetch('admin/billing_list.tpl');
				break;
			case 'whovoted':
				if($this->user->hasPerm('addcampaign')){
					$campaign = new Campaign($_REQUEST['campaign_id']);
					$this->smarty->assign('votedlist', $campaign->userVotedList());
					$this->smarty->assign('notvotedlist', $campaign->userVotedList(false));
					$this->smarty->assign('campaignName', $campaign->getName());
					return $this->smarty->fetch('admin/voted_list.tpl');
				}
				return $this->topLevelAdmin();
			default:
				if($this->user->hasPerm('admin') && !$this->user->hasPerm('viewcampaign')){
					header("Location: /admin/Campaigns&section=listbilling");
				}
				return $this->topLevelAdmin();
		}
	}
	
	public function topLevelAdmin(){
		if($this->user->hasPerm('viewcampaign')){
			$campaigns = Campaign::getCampaigns($this->user->getAuthGroup(), 0);
			$this->smarty->assign('campaigns', $campaigns);
			$this->smarty->assign('user', $this->user);
			return $this->smarty->fetch( 'admin/campaigns.tpl' );
		}
		return $this->smarty->fetch('../../../cms/templates/error.tpl');
	}
	
	public function recipTopLevelAdmin(){
		if($this->user->hasPerm('viewcampaign')){
			$recipients = Campaign::getRecipients($this->user->getAuthGroup());
			$this->smarty->assign('recipients', $recipients);
			return $this->smarty->fetch('admin/campaign_recips.tpl');
		}
		return $this->smarty->fetch('../../../cms/templates/error.tpl');
	}
	
	function getUserInterface() {
		require_once(SITE_ROOT.'/modules/Campaigns/include/Campaign.php');
		if(@$_REQUEST['hash'] == 'register'){
			$register = new CampaignRegister();
			$form = $register->getRegisterForm();
			$this->smarty->assign('form', $form);
			if($form->validate() && $form->isSubmitted() && isset($_REQUEST['register_submit'])){
				return $this->smarty->fetch('registersucceed.tpl');
			}
			return $this->smarty->fetch('register.tpl');
		} else if(!is_null(@$_REQUEST['hash']) && !empty($_REQUEST['hash'])){
			$cData = Campaign::checkHash($_REQUEST['hash']);
			if($cData){
				$campaign = new Campaign($cData);
				if(strpos($campaign->getStatus(), 'progress') > 0){
					$form = $campaign->getVoteForm($_REQUEST['hash']);
					$this->smarty->assign('campaign', $campaign);
					$this->smarty->assign('form', $form);
					if($form->validate() && $form->isSubmitted() && isset($_POST['submit'])){
						foreach($_POST['vote_choice'] as $selChoice){
							$uChoice = new CampaignChoice($selChoice);
							$uChoice->setVote($_REQUEST['hash']);
						}
 						return $this->smarty->fetch('votesucceed.tpl');
					} else {
						return $this->smarty->fetch('vote.tpl');
					}
				}
			}
			return $this->smarty->fetch('votefail.tpl');
		}
		$form = Campaign::getHashForm();
		$this->smarty->assign('form', $form);
		return $this->smarty->fetch('voteinsert.tpl');
	}
}

?>