<?php

require_once(WCF_DIR.'lib/action/AbstractAction.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropEditor.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceEggdropDeleteAction extends AbstractAction {
	public $eggdropID = 0;
	public $eggdrop = null;
	
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['eggdropID'])) $this->eggdropID = escapeString(intval($_REQUEST['eggdropID']));

	}
	
	public function execute() {
		parent::execute();

		WCF::getUser()->checkPermission('admin.ircservice.canDeleteEggdrop');
		
		$this->eggdrop = new IRCServiceEggdropEditor($this->eggdropID);
		if (!$this->eggdrop->eggdropID) {
			throw new IllegalLinkException();
		}
		
		$this->eggdrop->delete();
		
		$this->executed();

		header('Location: index.php?page=IRCServiceEggdropList&deleteedeggdropID='.$this->eggdropID.'&packageID='.PACKAGE_ID.SID_ARG_2ND_NOT_ENCODED);	
		exit;
		
	}	
}

?>