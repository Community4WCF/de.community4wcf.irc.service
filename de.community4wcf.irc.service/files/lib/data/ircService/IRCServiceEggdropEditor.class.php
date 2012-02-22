<?php

require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdrop.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceEggdropEditor extends IRCServiceEggdrop {
	
	public function create($eggdropName, $host, $port, $serverAddress, $loginName, $loginPassword, $maxCount) {
		
		$sql = "INSERT INTO wcf".WCF_N."_ircService_eggdrop
				(eggdropName, host, port, serverAddress, loginName, loginPassword, maxCount)
				VALUES(	'".escapeString($eggdropName)."',
						'".escapeString($host)."',
						'".$port."',
						'".escapeString($serverAddress)."',
						'".escapeString($loginName)."',
						'".escapeString($loginPassword)."',
						'".$maxCount."')";
		WCF::getDB()->sendQuery($sql);		
		
		$eggdropID = WCF::getDB()->getInsertID("wcf".WCF_N."_ircService_eggdrop", 'eggdropID');
		
		return new IRCServiceEggdrop($eggdropID);
		
	}
	
	public function update($eggdropName, $host, $port, $serverAddress, $loginName, $loginPassword, $maxCount) {
		$sql = "UPDATE	wcf".WCF_N."_ircService_eggdrop
				SET		eggdropName = '".escapeString($eggdropName)."',
						host = '".escapeString($host)."',
						port = '".$port."',
						serverAddress = '".escapeString($serverAddress)."',
						loginName = '".escapeString($loginName)."',
						loginPassword = '".escapeString($loginPassword)."',
						maxCount = '".$maxCount."'
				WHERE 	eggdropID = ".$this->eggdropID;
		WCF::getDB()->sendQuery($sql);
		
	}
	
	public function delete() {
				
		$sql = "DELETE FROM	wcf".WCF_N."_ircService_eggdrop
				WHERE		eggdropID = ".$this->eggdropID;
		WCF::getDB()->sendQuery($sql);
		
	}
	
	public function updateCount($eggdropID, $add = 0) {
		$sql = "UPDATE	wcf".WCF_N."_ircService_eggdrop
				SET		count = ".(!empty($add) ? "count+1" : "count-1")."
				WHERE 	eggdropID = ".$eggdropID;
		WCF::getDB()->sendQuery($sql);
		
	}
}
?>