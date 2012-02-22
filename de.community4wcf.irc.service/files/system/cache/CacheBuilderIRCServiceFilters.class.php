<?php
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

/**
 * @author	Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website	mada-network.de
 */
 
class CacheBuilderIRCServiceFilters implements CacheBuilder {
	/**
	 * @see CacheBuilder::getData()
	 */
	public function getData($cacheResource) {
		$data = array();
		
		$sql = "SELECT 	chanID, value
				FROM	wcf".WCF_N."_ircService_user_filter
				WHERE	userID = ".WCF::getUser()->userID;		
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			if(!isset($data[$row['chanID']])) $data[$row['chanID']] = $row['value'];
			elseif(isset($data[$row['chanID']])) {
				$data[$row['chanID']] .= "\n";
				$data[$row['chanID']] .= $row['value'];
			}
		}
		
		return $data;
	}
}
?>