<?php
// wcf imports
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');
require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCService.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */
 
class IRCServiceMyPage extends AbstractPage {
	public $templateName = 'ircServiceMy';
	
	public $userInfos = null;
	public $channels = array();
	public $successCode = 0;
	public $successDelete = 0;
	
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['successCode'])) $this->successCode = intval($_REQUEST['successCode']);
		if (isset($_REQUEST['successDelete'])) $this->successDelete = intval($_REQUEST['successDelete']);
		
		$this->readUserInfos();
		if($this->userInfos->userID != 0) $this->readChannels();
	}
		
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'userInfos' => $this->userInfos,
			'channels' => $this->channels,
			'successCode' => $this->successCode,
			'successDelete' => $this->successDelete
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
	 
	protected function readUserInfos() {
		$this->userInfos = new IRCService(WCF::getUser()->userID);
	}
	
	protected function readChannels() {
		$sql = "SELECT		chan.*, eggi.eggdropName
				FROM		wcf".WCF_N."_ircService_user_channel chan
				LEFT JOIN	wcf".WCF_N."_ircService_eggdrop eggi
				ON			(chan.serverAddress=eggi.serverAddress)
				WHERE		chan.userID = '".WCF::getUser()->userID."'
				ORDER BY 	chan.channel ASC, eggi.eggdropName ASC";
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$this->channels[] = $row;
		}	
	}
}
?>