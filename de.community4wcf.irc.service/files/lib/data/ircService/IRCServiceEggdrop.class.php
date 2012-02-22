<?php

require_once(WCF_DIR.'lib/data/DatabaseObject.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceEggdrop extends DatabaseObject {
	
	public function __construct($eggdropID, $row = null) {
		if ($row === null) {
			$sql = "SELECT	*
					FROM	wcf".WCF_N."_ircService_eggdrop
					WHERE	eggdropID = ".$eggdropID;
			$row = WCF::getDB()->getFirstRow($sql);
		}
		
		parent::__construct($row);
	}
}

?>