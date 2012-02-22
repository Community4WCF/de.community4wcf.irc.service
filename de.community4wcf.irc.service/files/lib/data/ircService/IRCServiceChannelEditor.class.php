<?php

require_once(WCF_DIR.'lib/data/ircService/IRCServiceChannel.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceChannelEditor extends IRCServiceChannel {
	
	public function disabled($status = 0) {
		$sql = "UPDATE	wcf".WCF_N."_ircService_user_channel
				SET		disabled = ".(!empty($status) ? 1 : 0)."				
				WHERE 	chanID = ".$this->chanID;
		WCF::getDB()->sendQuery($sql);	
	}
	
	public function delete() {
		$sql = "DELETE FROM	wcf".WCF_N."_ircService_user_channel
				WHERE 	chanID = ".$this->chanID;
		WCF::getDB()->sendQuery($sql);		
		
		$sql = "DELETE FROM	wcf".WCF_N."_ircService_onlineList
				WHERE 	channel = '".$this->channel."'
				AND serverAddress =  '".$this->serverAddress."' ";
		WCF::getDB()->sendQuery($sql);		
		
		$sql = "DELETE FROM	wcf".WCF_N."_ircService_user_filter
				WHERE 	chanID = '".$this->chanID."' ";
		WCF::getDB()->sendQuery($sql);		
	}
	
}