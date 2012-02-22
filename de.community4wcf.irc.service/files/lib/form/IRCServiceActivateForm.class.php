<?php
require_once(WCF_DIR.'lib/form/AbstractForm.class.php');
require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropConnect.class.php');
/**
 * @author	Marco Daries
 * @copyright	2009 MaDa-Network.de
 * @website	www.mada-network.de
 */

class IRCServiceActivateForm extends AbstractForm {
	public $templateName = 'ircServiceActivate';
	
	public $code = 0;
	public $userID = 0;
	
	public $ircServiceData = null;
	public $hosting = null;
	
	const CONSONANTS 	= 'BCDFGHJKLMNPRSTVWXYZ';
	const VOCALS		= 'AEIOU';

	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['code'])) $this->code = intval($_REQUEST['code']);
		if (isset($_REQUEST['userID'])) $this->userID = intval($_REQUEST['userID']);

	}
		
	public function validate() {
		parent::validate();
				
		if (empty($this->userID)) {
			throw new UserInputException('userID');
		}
		
		if (empty($this->code)) {
			throw new UserInputException('code');
		}elseif(!$this->checkData()) {
			throw new UserInputException('code', 'wrong');
		}
		
	}

	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'code' => $this->code,
			'userID' => $this->userID
		));
	}
	
	public function show() {
		
		if (!MODULE_IRCSERVICE) {			
			throw new IllegalLinkException();
		}
		
		PageMenu::setActiveMenuItem('wcf.header.menu.ircservice');
		WCF::getUser()->checkPermission('user.ircservice.canView');
		
		parent::show();
				
	}
	
	public function save() {
		parent::save();	
		
		$eggdropID = $this->readEggdropID();		
		$channelCommand = '.+chan '.$this->readChannel();
		new IRCServiceEggdropConnect($eggdropID, $channelCommand);		
		
		$sql = "UPDATE	wcf".WCF_N."_ircService_user_channel
				SET	status = '0'
				WHERE	userID = '".$this->userID."'
					AND	status = ".$this->code;
		WCF::getDB()->sendQuery($sql);
		
		if(!$this->checkUniqueID()) {
			$this->newUniqueID();
		}
		
		WCF::getTPL()->assign(array(
			'url' => 'index.php?page=IRCServiceMy'.SID_ARG_2ND,
			'message' => WCF::getLanguage()->get('wcf.ircService.activate.success'),
			'wait' => 5
		));
		WCF::getTPL()->display('redirect');
		exit;
	}
	
	protected function checkData() {
		$sql = "SELECT	COUNT(*) AS count
				FROM	wcf".WCF_N."_ircService_user_channel
				WHERE	userID = '".$this->userID."' AND status = '".$this->code."' ";
		$row = WCF::getDB()->getFirstRow($sql);
		if($row['count']) return true;
		else return false;	
	}
	
	protected function checkUniqueID() {
		$sql = "SELECT	uniqueID
				FROM	wcf".WCF_N."_ircService_user
				WHERE	userID = '".$this->userID."' ";
		$row = WCF::getDB()->getFirstRow($sql);
		return $row['uniqueID'];
	}
	
	protected function newUniqueID() {
		$newID = ""; 
    	$counts = 25; 
    	$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 

   		mt_srand((double)microtime()*1000000); 

   		for ($i=1; $i <= $counts; $i++) { 
        	$newID .= substr($string, mt_rand(0,strlen($string)-1), 1); 
    	} 
     
	 	$sql = "SELECT	COUNT(*) AS count
				FROM	wcf".WCF_N."_ircService_user
				WHERE	uniqueID = '".$newID."' ";
		$row = WCF::getDB()->getFirstRow($sql);
		
		if($row['count'] == 0) {
			$sql = "UPDATE	wcf".WCF_N."_ircService_user
					SET		uniqueID = '".$newID."'
					WHERE	userID = ".$this->userID;
			WCF::getDB()->sendQuery($sql);
			
			WCF::getSession()->updateUserData();
		} else {
			$this->newUniqueID();
		}	
	}
	
	protected function readEggdropID() {
		$sql = "SELECT	eggdropID
				FROM	wcf".WCF_N."_ircService_eggdrop
				WHERE	serverAddress = (	SELECT 	serverAddress 
											FROM 	wcf".WCF_N."_ircService_user_channel 
											WHERE 	userID = '".$this->userID."'
												AND	status = '".$this->code."') ";
		$row = WCF::getDB()->getFirstRow($sql);	
		
		return $row['eggdropID'];
	}
	
	protected function readChannel() {
		$sql = "SELECT	channel
				FROM	wcf".WCF_N."_ircService_user_channel 
				WHERE 	userID = '".$this->userID."'
					AND	status = '".$this->code."' ";
		$row = WCF::getDB()->getFirstRow($sql);	
		
		return $row['channel'];
	}
}
?>