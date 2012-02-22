<?php
require_once(WCF_DIR.'lib/form/AbstractForm.class.php');
require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceChannelEditor.class.php');
/**
 * @author	Marco Daries
 * @copyright	2009 MaDa-Network.de
 * @website	www.mada-network.de
 */

class IRCServiceFilterForm extends AbstractForm {
	public $templateName = 'ircServiceFilter';
	
	public $chanID = 0;	
	public $values = '';
	
	public $chan = null;
	
	public $filters = array();
	
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['chanID'])) $this->chanID = intval($_REQUEST['chanID']);
		
		$this->chan = new IRCServiceChannelEditor($this->chanID, WCF::getUser()->userID);
		if (!$this->chan->chanID) {
			throw new IllegalLinkException();
		}
		
		if(isset($_GET['remove'])) {
			$sql = "DELETE FROM	wcf".WCF_N."_ircService_user_filter
					WHERE	filterID = '".$_GET['remove']."'
						AND userID = '".WCF::getUser()->userID."' ";
			WCF::getDB()->sendQuery($sql);
			
			$this->removeCache();
		} elseif(isset($_GET['add'])) {
			$this->submit();
		}
	}
	
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['values'])) $this->values = StringUtil::trim($_POST['values']); 

	}
	
	public function readData() {
		parent::readData();
		
		$this->readFilter();
	}
	
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'filters' => $this->filters,
			'chanID' => $this->chanID,
			'values' => $this->values,
			'channelname' => $this->chan->channel
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
		
		$sql = "INSERT IGNORE INTO	wcf".WCF_N."_ircService_user_filter
						(chanID, userID, value)
				VALUES(	'".$this->chanID."',
						'".WCF::getUser()->userID."',
						'".$this->values."')";
		WCF::getDB()->sendQuery($sql);
		
		$this->removeCache();
		$this->saved();
		
		$this->values = '';
	}
	
	protected function readFilter() {
		$sql = "SELECT 	filterID, value
				FROM	wcf".WCF_N."_ircService_user_filter
				WHERE	chanID = ".$this->chanID;		
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$this->filters[] = $row;
		}	
	}
	
	protected function removeCache() {
		WCF::getCache()->clear(WCF_DIR . 'cache', 'irc-service/cache.filters.userID-'.WCF::getUser()->userID.'.php');
	}
	
}
?>