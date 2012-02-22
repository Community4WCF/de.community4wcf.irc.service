{include file='header'}
<div class="mainHeadline">
	<img src="{@RELATIVE_WCF_DIR}icon/ircServiceEggdropAddL.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wcf.acp.ircServiceEggdrop.{@$action}{/lang}</h2>		
	</div>
</div>

{if $errorField}
	<p class="error">{lang}wcf.global.form.error{/lang}</p>
{/if}
{if $success|isset}
	<p class="success">{lang}wcf.acp.ircServiceEggdrop.{@$action}.success{/lang}</p>	
{/if}

<div class="contentHeader">
	<div class="largeButtons">
		<ul><li><a href="index.php?page=IRCServiceEggdropList&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/ircServiceEggdropM.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.list{/lang}" /> <span>{lang}wcf.acp.ircServiceEggdrop.list{/lang}</span></a></li></ul>
	</div>
</div>

<form method="post" action="index.php?form=IRCServiceEggdrop{@$action|ucfirst}">
	<div class="border content">
		<div class="container-1">
			<fieldset>
				<legend>{lang}wcf.acp.ircServiceEggdrop.global.daten{/lang}</legend>
					<div class="formElement{if $errorField == 'eggdropName'} formError{/if}" id="eggdropNameDiv">
						<div class="formFieldLabel">
							<label for="eggdropName">{lang}wcf.acp.ircServiceEggdrop.eggdropName{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="eggdropName" id="eggdropName" value="{$eggdropName}" />
							{if $errorField == 'eggdropName'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="eggdropNameHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.eggdropName.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('eggdropName');
					//]]></script>  
                    
					<div class="formElement{if $errorField == 'host'} formError{/if}" id="hostDiv">
						<div class="formFieldLabel">
							<label for="host">{lang}wcf.acp.ircServiceEggdrop.host{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="host" id="host" value="{$host}" />
							{if $errorField == 'host'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="hostHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.host.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('host');
					//]]></script>  
                    
					<div class="formElement{if $errorField == 'port'} formError{/if}" id="portDiv">
						<div class="formFieldLabel">
							<label for="port">{lang}wcf.acp.ircServiceEggdrop.port{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="port" id="port" value="{$port}" />
							{if $errorField == 'port'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="portHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.port.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('port');
					//]]></script>  
                    
					<div class="formElement{if $errorField == 'serverAddress'} formError{/if}" id="serverAddressDiv">
						<div class="formFieldLabel">
							<label for="serverAddress">{lang}wcf.acp.ircServiceEggdrop.serverAddress{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="serverAddress" id="serverAddress" value="{$serverAddress}" />
							{if $errorField == 'serverAddress'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="serverAddressHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.serverAddress.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('serverAddress');
					//]]></script>   
                    
					<div class="formElement{if $errorField == 'loginName'} formError{/if}" id="loginNameDiv">
						<div class="formFieldLabel">
							<label for="loginName">{lang}wcf.acp.ircServiceEggdrop.loginName{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="loginName" id="loginName" value="{$loginName}" />
							{if $errorField == 'loginName'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="loginNameHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.loginName.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('loginName');
					//]]></script>      
                    
					<div class="formElement{if $errorField == 'loginPassword'} formError{/if}" id="loginPasswordDiv">
						<div class="formFieldLabel">
							<label for="loginPassword">{lang}wcf.acp.ircServiceEggdrop.loginPassword{/lang}</label>
						</div>
						<div class="formField">
							<input type="password" class="inputText" name="loginPassword" id="loginPassword" value="{$loginPassword}" />
							{if $errorField == 'loginPassword'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="loginPasswordHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.loginPassword.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('loginPassword');
					//]]></script>          
                    
					<div class="formElement{if $errorField == 'maxCount'} formError{/if}" id="maxCountDiv">
						<div class="formFieldLabel">
							<label for="maxCount">{lang}wcf.acp.ircServiceEggdrop.maxCount{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="maxCount" id="maxCount" value="{$maxCount}" />
							{if $errorField == 'maxCount'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="maxCountHelpMessage">
							{lang}wcf.acp.ircServiceEggdrop.maxCount.description{/lang}
						</div>
					</div>
					<script type="text/javascript">//<![CDATA[
						inlineHelp.register('maxCount');
					//]]></script>          
            </fieldset>
		</div>
	</div>

	<div class="formSubmit">
		<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
		<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
		<input type="hidden" name="packageID" value="{@PACKAGE_ID}" />	
 		{@SID_INPUT_TAG}
 		{if $eggdropID|isset}<input type="hidden" name="eggdropID" value="{@$eggdropID}" />{/if}
 	</div>
</form>

{include file='footer'}