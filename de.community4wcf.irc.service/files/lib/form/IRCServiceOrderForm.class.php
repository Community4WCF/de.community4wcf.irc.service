<?php
require_once(WCF_DIR.'lib/form/AbstractForm.class.php');
require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
require_once(WCF_DIR.'lib/data/ircService/IRCServiceEditor.class.php');
require_once(WCF_DIR.'lib/data/mail/Mail.class.php');

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 */

class IRCServiceOrderForm extends AbstractForm {
	public $templateName = 'ircServiceOrder';
	
	public $eggdropID = 0;
	public $channel = '#';
	
	public $eggdrops = array();
	
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['eggdropID'])) $this->eggdropID = escapeString(intval($_POST['eggdropID']));
		if (isset($_POST['channel'])) $this->channel = escapeString(StringUtil::trim($_POST['channel'])); 
		
		if(substr($this->channel, 0, 1) !== "#") $this->channel = "#".$this->channel;

	}
	
	public function readData() {
		parent::readData();
		
		$this->readEggdrop();
	}
	
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'eggdropID' => $this->eggdropID,
			'channel'	=> $this->channel,
			'eggdrops' => $this->eggdrops			
		));	
	}
	
	public function validate() {
		parent::validate();
		
		if (empty($this->eggdropID)) {
			throw new UserInputException('eggdropID');
		}
		
		if (empty($this->channel)) {
			throw new UserInputException('channel');
		}
		
		if($this->checkChannel()) {
			throw new UserInputException('channel', 'double');
		}
	}
	
	public function show() {
		
		if (!MODULE_IRCSERVICE) {			
			throw new IllegalLinkException();
		}
		
		PageMenu::setActiveMenuItem('wcf.header.menu.ircservice');		
		WCF::getUser()->checkPermission('user.ircservice.canView');
					
		parent::show();
	}
	
	public function save() {
		parent::save();
	
		$code = UserRegistrationUtil::getActivationCode();
		
		IRCServiceEditor::create($this->eggdropID, $this->channel, $code);
		
		$subject = WCF::getLanguage()->get('wcf.ircService.order.mail.subject');
		$text = WCF::getLanguage()->get('wcf.ircService.order.mail.text', array(
			'PAGE_TITLE' => WCF::getLanguage()->get(PAGE_TITLE),
			'PAGE_URL' => PAGE_URL,
			'$userID' => WCF::getUser()->userID,
			'$username' => WCF::getUser()->username,
			'$code' => $code
		));
			
		$mail = new Mail(array(WCF::getUser()->username => WCF::getUser()->email), $subject, $text);
		$mail->send();
						
		WCF::getTPL()->assign(array(
			'url' => 'index.php?page=Index',
			'message' => WCF::getLanguage()->get('wcf.ircService.order.success'),
			'wait' => 5
		));
		WCF::getTPL()->display('redirect');
		exit;
	}
	
	protected function readEggdrop() {
		$sql = "SELECT	eggdropID, eggdropName
				FROM	wcf".WCF_N."_ircService_eggdrop
				WHERE	count < maxCount";
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$this->eggdrops[$row['eggdropID']] = $row['eggdropName'];
		}
	}
	
	protected function checkChannel() {
			$sql = "SELECT	COUNT(*) AS count
					FROM	wcf".WCF_N."_ircService_user_channel
					WHERE	channel = '".$this->channel."' 
						AND serverAddress = (	SELECT 	serverAddress 
												FROM 	wcf".WCF_N."_ircService_eggdrop 
												WHERE 	eggdropID = '".$this->eggdropID."')";
			$row = WCF::getDB()->getFirstRow($sql);
		
		return $row['count'];
	}
}
?>