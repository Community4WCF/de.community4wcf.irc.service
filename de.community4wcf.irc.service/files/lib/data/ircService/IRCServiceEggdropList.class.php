<?php
require_once(WCF_DIR.'lib/data/DatabaseObjectList.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdrop.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */
 
class IRCServiceEggdropList extends DatabaseObjectList {
	public $eggdrops = array();
	
	public function countObjects() {
		$sql = "SELECT	COUNT(*) AS count
			FROM		wcf".WCF_N."_ircService_eggdrop
			".(!empty($this->sqlConditions) ? "WHERE ".$this->sqlConditions : '');
		$row = WCF::getDB()->getFirstRow($sql);
		return $row['count'];
	}
	
	public function readObjects() {
		$sql = "SELECT	*
			FROM		wcf".WCF_N."_ircService_eggdrop
			".$this->sqlJoins."
			".(!empty($this->sqlConditions) ? "WHERE ".$this->sqlConditions : '')."
			".(!empty($this->sqlOrderBy) ? "ORDER BY ".$this->sqlOrderBy : '');
		$result = WCF::getDB()->sendQuery($sql, $this->sqlLimit, $this->sqlOffset);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$this->eggdrops[] = new IRCServiceEggdrop(null, $row);
		}
	}
	
	public function getObjects() {
		return $this->eggdrops;
	}
	
}

?>