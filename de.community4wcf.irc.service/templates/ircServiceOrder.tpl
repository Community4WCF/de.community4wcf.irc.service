{include file="documentHeader" sandbox='false'}
<head>
	<title>{lang}wcf.ircService.order{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file='headInclude' sandbox=false}
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}> 
{include file='header' sandbox=false}
<div id="main">
	
	<div class="mainHeadline"> 
		<img src="{icon}ircServiceOrderL.png{/icon}" alt="" title="{lang}wcf.ircService.order{/lang}" />
		<div class="headlineContainer">
			<h2>{lang}wcf.ircService.order{/lang}</h2>
			<p>{lang}wcf.ircService.order.description{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
    
    {if $errorField}
		<p class="error">{lang}wcf.global.form.error{/lang}</p>
	{/if}
    
    <div class="border">
		<div class="layout-2">
			<div class="columnContainer">	
				<div class="container-1 column first">
					<div class="columnInner">
                    {if !$this->user->getPermission('user.ircservice.canOrder')}
                    	<p class="error">{lang}wcf.ircService.order.noAccess{/lang}</p>
                    {else}                    
                		<form method="post" action="index.php?form=IRCServiceOrder">
	                		<fieldset>
								<legend><label for="eggdrop">{lang}wcf.ircService.order.general{/lang}</label></legend>
								<div class="formElement{if $errorField == 'eggdropID'} formError{/if}">
									<div class="formFieldLabel">
										<label for="eggdrop">{lang}wcf.ircService.eggdrop{/lang}</label>
									</div>
									<div class="formField">
										<select name="eggdropID" id="eggdropID">
											<option value="0"></option>
											{htmlOptions options=$eggdrops disableEncoding=true selected=$eggdropID}
										</select>
										{if $errorField == 'eggdropID'}
											<p class="innerError">
												{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
											</p>
										{/if}
									</div>
									<div class="formFieldDesc">
										<p>{lang}wcf.ircService.eggdrop.description{/lang}</p>
									</div>
								</div>
                                
                                
					
								<div class="formElement{if $errorField == 'channel'} formError{/if}">
									<div class="formFieldLabel">
										<label for="channel">{lang}wcf.ircService.channel{/lang}</label>
									</div>
									<div class="formField">
										<input type="text" class="inputText" name="channel" value="{$channel}" id="channel" />
					
                    					{if $errorField == 'channel'}
											<p class="innerError">
												{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
												{if $errorType == 'double'}{lang}wcf.ircService.channel.double{/lang}{/if}
											</p>
										{/if}
									</div>
									<div class="formFieldDesc">
										<p>{lang}wcf.ircService.channel.description{/lang}</p>
									</div>
								</div>
							</fieldset>
                            
                            <div class="formSubmit">
								<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
								<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
							</div>
							{@SID_INPUT_TAG}
						</form>                        
                  	{/if}
	                </div>
				</div>                
                {include file='ircServiceMenu' sandbox=false}	
			</div>
		</div>
	</div>
</div>
{include file='footer' sandbox=false}
</body>
</html>