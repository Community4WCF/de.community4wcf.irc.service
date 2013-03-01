<?php

require_once(WCF_DIR.'lib/acp/form/IRCServiceEggdropAddForm.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceEggdropEditForm extends IRCServiceEggdropAddForm {
	public $neededPermissions = 'admin.ircservice.canEditEggdrop';
	
	public $eggdropID = 0;
	
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['eggdropID'])) $this->eggdropID = escapeString(intval($_REQUEST['eggdropID']));
		$this->eggdrop = new IRCServiceEggdropEditor($this->eggdropID);
		if (!$this->eggdrop->eggdropID) {
			throw new IllegalLinkException();
		}
		
	}
	
	public function readData() {
		parent::readData();

		if (!count($_POST)) {
			$this->eggdropName = $this->eggdrop->eggdropName;
			$this->host = $this->eggdrop->host;
			$this->port = $this->eggdrop->port;
			$this->serverAddress = $this->eggdrop->serverAddress;
			$this->loginName = $this->eggdrop->loginName;
			$this->loginPassword = $this->eggdrop->loginPassword;
			$this->maxCount = $this->eggdrop->maxCount;
		}
		
	}
	
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'eggdropID' => $this->eggdropID,
			'action' => 'edit'
		));
		
	}
	
	public function save() {
		AbstractForm::save();
		
		$this->eggdrop->update($this->eggdropName, $this->host, $this->port, $this->serverAddress, $this->loginName, $this->loginPassword, $this->maxCount);
		
		$this->saved();
		
		WCF::getTPL()->assign('success', true);
		
	}
}
?>