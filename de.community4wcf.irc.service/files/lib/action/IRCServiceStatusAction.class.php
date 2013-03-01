<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractAction.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceChannelEditor.class.php');

/**
 * @author	Marco Daries
 * @copyright	2009 MaDa-Network.de
 * @website	www.mada-network.de
 */

class IRCServiceStatusAction extends AbstractAction {
	public $disabled = 0;
	public $chanID = 0;
	
	public $service = null;
	
	public function readParameters() {
		parent::readParameters();
						
		if (isset($_REQUEST['chanID'])) $this->chanID = escapeString(intval($_REQUEST['chanID']));
		if (isset($_REQUEST['disabled'])) $this->disabled = escapeString(intval($_REQUEST['disabled']));
		
		$this->service = new IRCServiceChannelEditor($this->chanID, WCF::getUser()->userID);	
		if (!$this->service->chanID) {
			throw new IllegalLinkException();
		}
		
	}
	
	public function execute() {
		parent::execute();
		
		$this->service->disabled($this->disabled);
		$this->executed();
	}
	
	protected function executed() {
		parent::executed();

		HeaderUtil::redirect('index.php?page=IRCServiceMy'.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
}
?>