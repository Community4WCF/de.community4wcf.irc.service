<?php
// wcf imports
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */
 
class IRCServiceReadDatasPage extends AbstractPage {
	public $uniqueID = '';
	public $userID = 0;
	public $datas = array();
	public $filters = array();
	
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['uniqueID'])) $this->uniqueID = StringUtil::trim($_REQUEST['uniqueID']); 
		
		$this->checkUniqueID();
		if($this->userID) {
			$this->readFilters();	
			$this->readDatas();			
		}
		
	}
	
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'datas' => $this->datas
		));
	}
	
	public function show() {
		parent::show();
		
		// send content
		WCF::getTPL()->display('ircServiceXML', false);		
		
		// send header
		@header('Content-Type: application/xml; charset='.CHARSET);
	}
	
	protected function readDatas() {
		$count = 0;
		
		$sql = "SELECT 	chanID, channel, serverAddress
				FROM	wcf".WCF_N."_ircService_user_channel
				WHERE	disabled = 0
					AND	status = 0
					AND userID = '".$this->userID."' 
				ORDER BY  	channel ASC, serverAddress ASC";		
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$this->datas[$count]['channelname'] = $row['channel'];		
			$this->datas[$count]['useronlinelists'] = array();
			
			$sql1 = "SELECT nickname, op, voice
					FROM	wcf".WCF_N."_ircService_onlineList
					WHERE	serverAddress = '".$row['serverAddress']."'
						AND	channel = '".$row['channel']."' 
					ORDER BY nickname ASC";		
			$result1 = WCF::getDB()->sendQuery($sql1);
			$count1 = 0;
			while ($row1 = WCF::getDB()->fetchArray($result1)) {
				if($this->checkFilter($row['chanID'], $row1['nickname']) !== false) {
					$this->datas[$count]['useronlinelists'][$count1]['nickname'] = $row1['nickname'];
					$this->datas[$count]['useronlinelists'][$count1]['op'] = $row1['op'];
					$this->datas[$count]['useronlinelists'][$count1]['voice'] = $row1['voice'];
					$count1++;					
				}
			}			
			
			$count++;
		}
	}
	 
	protected function checkUniqueID() {
		$sql = "SELECT 	userID
				FROM	wcf".WCF_N."_ircService_user
				WHERE	disabled = 0
					AND	uniqueID = '".$this->uniqueID."' ";	
		$row = WCF::getDB()->getFirstRow($sql);
		
		$this->userID = $row['userID'];
	}	
	
	protected function readFilters() {				
		$sql = "SELECT 	chanID, value
				FROM	wcf".WCF_N."_ircService_user_filter
				WHERE	userID = ".$this->userID;		
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			if(!isset($this->filters[$row['chanID']])) $this->filters[$row['chanID']] = $row['value'];
			elseif(isset($this->filters[$row['chanID']])) {
				$this->filters[$row['chanID']] .= "\n";
				$this->filters[$row['chanID']] .= $row['value'];
			}
		}	
	}
	
	protected function checkFilter($chanID = 0, $nickname = '') {
		if(!isset($this->filters[$chanID])) return true;
		return StringUtil::executeWordFilter($nickname, $this->filters[$chanID]);
	}
}
?>