<?php
// wcf imports
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');
require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/MessageParser.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */
 
class IRCServicePage extends AbstractPage {
	public $templateName = 'ircService';
	
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'ircGeneralMessage' => $this->getFormattedMessage()
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
	
	public function getFormattedMessage() {
		
		// parse message
		$parser = MessageParser::getInstance();
		$parser->setOutputType('text/html');
		return $parser->parse(IRCSERVICE_GENERAL_MESSAGE, IRCSERVICE_GENERAL_MESSAGE_ENABLE_SMILEY, IRCSERVICE_GENERAL_MESSAGE_ALLOW_HTML, IRCSERVICE_GENERAL_MESSAGE_ENABLE_BBCODES);
	}
}
?>