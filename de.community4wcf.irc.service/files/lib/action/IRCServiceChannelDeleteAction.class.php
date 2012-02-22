<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractAction.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceChannelEditor.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropConnect.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropEditor.class.php');

/**
 * @author	Marco Daries
 * @copyright	2009 MaDa-Network.de
 * @website	www.mada-network.de
 */

class IRCServiceChannelDeleteAction extends AbstractAction {
	public $chanID = 0;
	
	public $service = null;
	public $eggdrop = null;
	
	public function readParameters() {
		parent::readParameters();
						
		if (isset($_REQUEST['chanID'])) $this->chanID = intval($_REQUEST['chanID']);
		
		$this->service = new IRCServiceChannelEditor($this->chanID, WCF::getUser()->userID);	
		if (!$this->service->chanID) {
			throw new IllegalLinkException();
		}
		
	}
	
	public function execute() {
		parent::execute();		
		$eggdropID = $this->readEggdropID();		
		$channelCommand = '.-chan '.$this->service->channel;
		new IRCServiceEggdropConnect($eggdropID, $channelCommand);	
		
		$this->eggdrop = new IRCServiceEggdropEditor($eggdropID);
		$this->eggdrop->updateCount($this->eggdrop->eggdropID);
		
		$this->service->delete();
		$this->executed();
	}
	
	protected function readEggdropID() {		
		$sql = "SELECT	eggdropID
				FROM	wcf".WCF_N."_ircService_eggdrop
				WHERE	serverAddress = '".$this->service->serverAddress."' ";
		$row = WCF::getDB()->getFirstRow($sql);	
		
		return $row['eggdropID'];	
	}
	
	protected function executed() {
		parent::executed();

		HeaderUtil::redirect('index.php?page=IRCServiceMy&successDelete='.$this->chanID.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
}
?>