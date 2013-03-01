<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractAction.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceChannel.class.php');
require_once(WCF_DIR.'lib/data/mail/Mail.class.php');

/**
 * @author	Marco Daries
 * @copyright	2009 MaDa-Network.de
 * @website	www.mada-network.de
 */

class IRCServiceSendCodeAgainAction extends AbstractAction {
	public $chanID = 0;
	
	public $service = null;
	
	public function readParameters() {
		parent::readParameters();
						
		if (isset($_REQUEST['chanID'])) $this->chanID = escapeString(intval($_REQUEST['chanID']));
		
		$this->service = new IRCServiceChannel($this->chanID, WCF::getUser()->userID);	
		if (!$this->service->chanID) {
			throw new IllegalLinkException();
		}
		
	}
	
	public function execute() {
		parent::execute();
		
		$this->sendCodeAgain();
		$this->executed();
	}
	
	protected function executed() {
		parent::executed();

		HeaderUtil::redirect('index.php?page=IRCServiceMy&successCode='.$this->chanID.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
	
	protected function sendCodeAgain() {
		$subject = WCF::getLanguage()->get('wcf.ircService.order.mail.subject');
		$text = WCF::getLanguage()->get('wcf.ircService.order.mail.text', array(
			'PAGE_TITLE' => WCF::getLanguage()->get(PAGE_TITLE),
			'PAGE_URL' => PAGE_URL,
			'$userID' => WCF::getUser()->userID,
			'$username' => WCF::getUser()->username,
			'$code' => $this->service->status
		));
			
		$mail = new Mail(array(WCF::getUser()->username => WCF::getUser()->email), $subject, $text);
		$mail->send();	
	}
}
?>