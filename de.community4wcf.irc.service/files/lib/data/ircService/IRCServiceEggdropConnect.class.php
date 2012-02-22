<?php

// imports
if (!defined('NO_IMPORTS')) {
	require_once(WCF_DIR.'lib/system/exception/SystemException.class.php');
	require_once(WCF_DIR.'lib/data/DatabaseObject.class.php');
	require_once(WCF_DIR.'lib/data/ircService/IRCServiceEggdrop.class.php');
}

/**
 * @author		Marco Daries
 * @copyright	2011 MaDa-Network.de
 * @website		mada-network.de
 *
 * @Original by deixu.net
 * @Modifiziert by MaDa-Network
 */
 
class IRCServiceEggdropConnect extends DatabaseObject {
	protected $resource = null;
	protected $protocol = 'tcp';
	protected $errorNumber;
	protected $errorString;
	protected $timeout = 2;
	
	protected $error = null;
	
	protected $host = '';
	protected $port = 3333;
	protected $loginName = '';
	protected $loginPassword = '';
	
	protected static $connections = array();
	
	public function __construct($eggdropID = 0, $channelCommand = '') {
		
		if(!$eggdropID) return;
		
		$this->readEggdrop($eggdropID);
		
		$this->login();
		
		if($channelCommand) $this->sendRequest($channelCommand."\r");
		$this->disconnect();
	}
	
	protected function readEggdrop($eggdropID) {
		$eggi = new IRCServiceEggdrop($eggdropID);
		
		$this->host = $eggi->host;
		$this->port = $eggi->port;
		$this->loginName = $eggi->loginName;
		$this->loginPassword = $eggi->loginPassword;
	}
	
	public function connect() {
		if(!is_null($this->resource)) return;
		$this->resource = fsockopen($this->host, $this->port, $this->errorNumber, $this->errorString, $this->timeout);
		if ($this->resource === false) {
			throw new SystemException('Can not connect to ' . $this->host . ': '.$this->errorString, 10000);
		}
	}
	
	public function disconnect() {
		if(is_null($this->resource)) return;
		@fclose($this->resource);
		$this->resource = null;
	}
	
	public function send($data) {
		if(is_null($this->resource)) $this->connect();
		usleep(1000);	
		@fputs($this->resource, $data);
	}
	
	public function login() {
		$this->sendRequest($this->loginName."\r");
		$this->sendRequest($this->loginPassword."\r");
	}
	
	public function sendRequest($command) {
		$this->send($command);
	}
}
?>