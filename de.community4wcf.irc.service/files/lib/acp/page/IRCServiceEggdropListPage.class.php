<?php

require_once(WCF_DIR.'lib/page/SortablePage.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropList.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */
 
class IRCServiceEggdropListPage extends SortablePage {
	public $templateName = 'ircServiceEggdropList';
	public $deleteedeggdropID = 0;
	public $defaultSortField = 'eggdropName';
	
	public $eggdropsList = array();
	
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['deleteedeggdropID'])) $this->deleteedeggdropID = escapeString(intval($_REQUEST['deleteedeggdropID']));
		
		$this->eggdropsList = new IRCServiceEggdropList();
	}
	
	public function readData() {
		parent::readData();
		
		$this->eggdropsList->sqlOffset = ($this->pageNo - 1) * $this->itemsPerPage;
		$this->eggdropsList->sqlLimit = $this->itemsPerPage;
		$this->eggdropsList->sqlOrderBy = $this->sortField." ".$this->sortOrder;		
		$this->eggdropsList->readObjects();
	}
	
	public function countItems() {
		parent::countItems();
		
		return $this->eggdropsList->countObjects();
	}
	
	public function validateSortField() {
		parent::validateSortField();
		
		switch ($this->sortField) {
			case 'eggdropID':
			case 'eggdropName':
			case 'host': 
			case 'port': break;
			default: $this->sortField = $this->defaultSortField;
		}
	}
		
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'eggdropsList' => $this->eggdropsList->getObjects(),
			'deleteedeggdropID' => $this->deleteedeggdropID
		));
	}
	
	public function show() {
		WCFACP::getMenu()->setActiveMenuItem('wcf.acp.menu.link.ircservice.eggdrop.list');
		
		WCF::getUser()->checkPermission(array('admin.ircservice.canEditEggdrop', 'admin.ircservice.canDeleteEggdrop'));
		
		parent::show();
	} 	
}