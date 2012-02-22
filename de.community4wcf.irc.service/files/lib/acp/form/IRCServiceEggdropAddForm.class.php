<?php

require_once(WCF_DIR.'lib/acp/form/ACPForm.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropEditor.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */
 
class IRCServiceEggdropAddForm extends ACPForm {
	
	public $templateName = 'ircServiceEggdropAdd';
	public $neededPermissions = 'admin.ircservice.canAddEggdrop';
	public $activeMenuItem = 'wcf.acp.menu.link.ircservice.eggdrop.add';
	
	public $eggdropName = '';
	public $host = '';
	public $port = 3333;
	public $serverAddress = '';
	public $loginName = '';
	public $loginPassword = '';
	public $maxCount = 0;
	
	public $eggdrop = null;
	
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['eggdropName'])) $this->eggdropName = StringUtil::trim($_POST['eggdropName']);
		if (isset($_POST['host'])) $this->host = StringUtil::trim($_POST['host']);
		if (isset($_POST['port'])) $this->port = intval($_POST['port']);
		if (isset($_POST['serverAddress'])) $this->serverAddress = StringUtil::trim($_POST['serverAddress']);
		if (isset($_POST['loginName'])) $this->loginName = StringUtil::trim($_POST['loginName']);
		if (isset($_POST['loginPassword'])) $this->loginPassword = StringUtil::trim($_POST['loginPassword']);
		if (isset($_POST['maxCount'])) $this->maxCount = intval($_POST['maxCount']);
		
	}
	
	public function validate() {
		parent::validate();
		
		if (empty($this->eggdropName)) {
			throw new UserInputException('eggdropName', 'empty');
		}
		
		if (empty($this->host)) {
			throw new UserInputException('host', 'empty');
		}
		
		if (empty($this->port)) {
			throw new UserInputException('port', 'empty');
		}
		
		if (empty($this->serverAddress)) {
			throw new UserInputException('serverAddress', 'empty');
		
		
		}if (empty($this->loginName)) {
			throw new UserInputException('loginName', 'empty');
		}
		
		if (empty($this->loginPassword)) {
			throw new UserInputException('loginPassword', 'empty');
		}
	}
	
	public function assignVariables() {
		parent::assignVariables();
		
		
		WCF::getTPL()->assign(array(
			'eggdropName' => $this->eggdropName,
			'host' => $this->host,
			'port' => $this->port,
			'serverAddress' => $this->serverAddress,
			'loginName' => $this->loginName,
			'loginPassword' => $this->loginPassword,
			'maxCount' => $this->maxCount,
			'action' => 'add'
		));
		
	}	
	
	public function save() {
		parent::save();
		
		$this->eggdrop = IRCServiceEggdropEditor::create($this->eggdropName, $this->host, $this->port, $this->serverAddress, $this->loginName, $this->loginPassword, $this->maxCount);
		
		$this->saved();
		
		$this->eggdropName = $this->host = $this->loginName = $this->loginPassword = $this->serverAddress = '';
		$this->port = 3333;
		$this->maxCount = 0;
		
		WCF::getTPL()->assign('success', true);
		
	}
}
?>