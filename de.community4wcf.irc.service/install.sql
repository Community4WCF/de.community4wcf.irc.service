CREATE TABLE IF NOT EXISTS wcf1_ircService_onlineList (
	channel			VARCHAR(50) 				NOT NULL 	default '',
  	nickname 		VARCHAR(50) 				NOT NULL 	default '',
  	serverAddress 	VARCHAR(255)		 		NOT NULL 	default '',
  	op 				TINYINT(1) 		unsigned 	NOT NULL 	default '0',
  	voice 			TINYINT(1)		unsigned 	NOT NULL 	default '0',
  	KEY nickname (nickname),
  	KEY channel (channel)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS wcf1_ircService_eggdrop (
	eggdropID 		INT(11) 		UNSIGNED 	NOT NULL 	AUTO_INCREMENT PRIMARY KEY ,
	eggdropName 	VARCHAR(50) 				NOT NULL 	default '',
	host 			VARCHAR(255) 				NOT NULL 	default '',
	port 			INT(11) 		UNSIGNED 	NOT NULL 	default '0',
	serverAddress 	VARCHAR(255) 				NOT NULL 	default '',
	loginName	 	VARCHAR(255) 				NOT NULL 	default '',
	loginPassword 	VARCHAR(255) 				NOT NULL 	default '',
	maxCount		INT(11) 		UNSIGNED 	NOT NULL 	default '0',
	count 			INT(11) 		UNSIGNED 	NOT NULL 	default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS wcf1_ircService_user (
	userID			INT(11)			UNSIGNED 	NOT NULL 	default '0',	
	uniqueID	 	VARCHAR(25) 	character set utf8 collate utf8_bin NOT NULL 	default '',
  	disabled 		tinyint(1) 		unsigned  	NOT NULL 	DEFAULT '0',
	UNIQUE (userID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS wcf1_ircService_user_channel (
	chanID	 		INT(11) 		UNSIGNED 	NOT NULL 	AUTO_INCREMENT PRIMARY KEY ,
	userID			INT(11)			UNSIGNED 	NOT NULL 	default '0',	
  	serverAddress 	VARCHAR(255)		 		NOT NULL 	default '',
  	channel		 	VARCHAR(255)		 		NOT NULL 	default '',
  	disabled 		tinyint(1) 		unsigned  	NOT NULL 	DEFAULT '0',
	status 			int(10) 		unsigned  	NOT NULL 	DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS wcf1_ircService_user_filter (
	filterID 		INT(11) 		UNSIGNED 	NOT NULL 	AUTO_INCREMENT PRIMARY KEY ,
	chanID	 		INT(11) 		UNSIGNED 	NOT NULL 	default '0',
	userID			INT(11)			UNSIGNED 	NOT NULL 	default '0',	
  	value		 	VARCHAR(255)		 		NOT NULL 	default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;