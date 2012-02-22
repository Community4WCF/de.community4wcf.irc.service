##############
### Config ###
##############
package require mysqltcl

## Datenbank Host
set dbhost "localhost"

## Datenbank User			
set dbuser ""

## Datenbank Name	
set dbname ""

## Datenbank Password	
set dbpwd ""

## wcf Nummer
set wcfn "1"

## ServerAddresse (Im ACP muss die gleiche Addresse auch stehen mit welchen dieser Bot hier verbunden ist)
set serverAddress ""

#################################
### Ab hier nix mehr Ändern ###
#################################

putlog "\[LOADED] IRC User Online Service by MaDa-Network.de @2011"

bind time - "* * * * *" doTime

proc doTime {min hour day month year} {
  foreach channel [channels] {
   	readData $channel
  }
} 

proc readData {channel} { 
	global botnick dbhost dbuser dbname dbpwd wcfn serverAddress

	if {"$channel" != "$botnick"} {
		set ops 0 
		set halfops 0 
		set voice 0 
		set none 0 


		foreach nickname [chanlist $channel] { 
  			if {[isop $nickname $channel]} { 
      			set nicknamesops($ops) $nickname
      			incr ops 
	   		} elseif {[ishalfop $nickname $channel]} { 
    			set nicknameshalfops($halfops) $nickname
    			incr halfops 
	   		} elseif {[isvoice $nickname $channel]} { 
    			set nicknamesvoice($voice) $nickname
      			incr voice 
	   		} else { 
    	  		set nicknamesnone($none) $nickname 
      			incr none 
	   		} 
		} 

		set db_handle [mysqlconnect -host $dbhost -user $dbuser -db $dbname -password $dbpwd]

		set sql "DELETE FROM wcf$wcfn\_ircService_onlineList WHERE channel = '$channel' AND serverAddress = '$serverAddress';"
		mysqlsel $db_handle $sql

		if { [array exists nicknamesops] } { 
  			for {set x 0} {$x < $ops} {incr x} { 
   				set sql "INSERT INTO wcf$wcfn\_ircService_onlineList (channel, nickname, serverAddress, op, voice) VALUES ('$channel','$nicknamesops($x)', '$serverAddress', '1', '0');"
				mysqlsel $db_handle $sql
   			} 
		} 

		if { [array exists nicknameshalfops] } { 
  			for {set x 0} {$x < $halfops} {incr x} { 
	   			set sql "INSERT INTO wcf$wcfn\_ircService_onlineList (channel, nickname, serverAddress, op, voice) VALUES ('$channel','$nicknameshalfops($x)', '$serverAddress','0', '1');"
				mysqlsel $db_handle $sql
   			} 
		} 

		if { [array exists nicknamesvoice] } { 
   			for {set x 0} {$x < $voice} {incr x} { 
   				set sql "INSERT INTO wcf$wcfn\_ircService_onlineList (channel, nickname, serverAddress, op, voice) VALUES ('$channel','$nicknamesvoice($x)', '$serverAddress','0', '1');"
				mysqlsel $db_handle $sql
   			} 
		} 

		if { [array exists nicknamesnone] } { 
   			for {set x 0} {$x < $none} {incr x} { 
  				set sql "INSERT INTO wcf$wcfn\_ircService_onlineList (channel, nickname, serverAddress, op, voice) VALUES ('$channel','$nicknamesnone($x)', '$serverAddress','0', '0');"
				mysqlsel $db_handle $sql
   			} 
		} 

		mysqlendquery $db_handle 
		mysqlclose $db_handle 

	}
}