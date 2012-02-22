<?php

require_once(WCF_DIR.'lib/data/ircService/IRCService.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdropEditor.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceEditor extends IRCService {
	
	public function create($eggdropID, $channel, $code) {
		
		$sql = "SELECT 	serverAddress 
				FROM 	wcf".WCF_N."_ircService_eggdrop 
				WHERE 	eggdropID = '".$eggdropID."' ";
		$row = WCF::getDB()->getFirstRow($sql);
		
		
		$sql = "INSERT IGNORE wcf".WCF_N."_ircService_user
				(userID)
				VALUES(	'".WCF::getUser()->userID."')";
		WCF::getDB()->sendQuery($sql);		
		
		$sql = "INSERT INTO wcf".WCF_N."_ircService_user_channel
				(userID, serverAddress, channel, status)
				VALUES(	'".WCF::getUser()->userID."',
						'".$row['serverAddress']."',
						'".escapeString($channel)."',
						'".$code."')";
		WCF::getDB()->sendQuery($sql);	
		
		IRCServiceEggdropEditor::updateCount($eggdropID, 1);
	}
}
?>