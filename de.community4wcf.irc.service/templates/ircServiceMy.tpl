{include file="documentHeader" sandbox='false'}
<head>
	<title>{lang}wcf.ircService.my{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file='headInclude' sandbox=false}
	<style type="text/css">
		.disabled {
			color: #F00;
		}		
		.activ {
			color: #0F0;
		}
	</style>
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}> 
{include file='header' sandbox=false}
<div id="main">
	
	<div class="mainHeadline"> 
		<img src="{icon}ircServiceMyL.png{/icon}" alt="" title="{lang}wcf.ircService.my{/lang}" />
		<div class="headlineContainer">
			<h2>{lang}wcf.ircService.my{/lang}</h2>
			<p>{lang}wcf.ircService.my.description{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
    
    {if $successCode}
		<p class="success">{lang}wcf.ircService.my.channel.action.sendCodeAgain.success{/lang}</p>	
	{/if} 
    {if $successDelete}
		<p class="success">{lang}wcf.ircService.my.channel.action.delete.success{/lang}</p>	
	{/if}
    
    <div class="border">
		<div class="layout-2">
			<div class="columnContainer">	
				<div class="container-1 column first">
					<div class="columnInner">
                    {if $userInfos->userID == 0}
                    	<p class="error">{lang}wcf.ircService.my.noAccount{/lang}</p>
                    {else}                    
					{cycle values='container-1,container-2' print=false advance=false}
						<div class="contentBox">
							<h3 class="subHeadline">{lang}wcf.ircService.my.account{/lang}</h3>

							<ul class="dataList">
								<li class="{cycle} formElement">
									<p class="formFieldLabel">{lang}wcf.ircService.my.account.uniqueID{/lang}</p>
									<p class="formField">{$userInfos->uniqueID}</p>
								</li>  
								<li class="{cycle} formElement">
									<p class="formFieldLabel">{lang}wcf.ircService.my.account.disabled{/lang}</p>
									<p class="formField"><span class="{if $userInfos->disabled}disabled{else}activ{/if}">
                                    {if $userInfos->disabled}{lang}wcf.ircService.my.account.disabled.no{/lang}{else}{lang}wcf.ircService.my.account.disabled.yes{/lang}{/if}</span></p>
								</li> 
                          	</ul>
								
							<div class="buttonBar">
								<div class="smallButtons">
									<ul><li class="extraButton"><a href="#top" title="{lang}wcf.global.scrollUp{/lang}"><img src="{icon}upS.png{/icon}" alt="{lang}wcf.global.scrollUp{/lang}" /> <span class="hidden">{lang}wcf.global.scrollUp{/lang}</span></a></li></ul>
								</div>
							</div>
                     	</div>    
                        
                        <div class="contentBox">
							<h3 class="subHeadline">{lang}wcf.ircService.my.channel{/lang}</h3>
							
                            
                           	{foreach from=$channels item=channel}
								<ul class="dataList">
									<li class="{cycle} formElement">
										<p class="formFieldLabel">{lang}wcf.ircService.my.channel.eggdrop{/lang}</p>
										<p class="formField">{$channel['eggdropName']}</p>
									</li>  
									<li class="{cycle} formElement">
										<p class="formFieldLabel">{lang}wcf.ircService.my.channel.channel{/lang}</p>
										<p class="formField">{$channel['channel']}</p>
									</li> 
                                    <li class="{cycle} formElement">
										<p class="formFieldLabel">{lang}wcf.ircService.my.channel.disabled{/lang}</p>
										<p class="formField"><span class="{if $channel['disabled'] || $channel['status'] != 0}disabled{else}activ{/if}">
                                    {if $channel['disabled'] || $channel['status'] != 0}{lang}wcf.ircService.my.channel.disabled.no{/lang}{else}{lang}wcf.ircService.my.channel.disabled.yes{/lang}{/if}</span></p>
									</li>
                              	</ul>
								
								<div class="buttonBar">
									<div class="smallButtons">
										<ul>                                        
                	                    	<li class="extraButton"><a href="#top" title="{lang}wcf.global.scrollUp{/lang}"><img src="{icon}upS.png{/icon}" alt="{lang}wcf.global.scrollUp{/lang}" /> <span class="hidden">{lang}wcf.global.scrollUp{/lang}</span></a></li>
                                            
                                            <li><a onclick="return confirm('{lang}wcf.ircService.my.channel.action.delete.sure{/lang}')" href="index.php?action=IRCServiceChannelDelete&amp;chanID={$channel['chanID']}{@SID_ARG_2ND}"><span>{lang}wcf.ircService.my.channel.action.delete{/lang}</span></a></li>
                                            
                                    		{if $channel['disabled'] && $channel['status'] == 0}
	                                        	<li><a href="index.php?action=IRCServiceStatus&amp;chanID={$channel['chanID']}{@SID_ARG_2ND}" title="{lang}wcf.ircService.my.channel.action.disabled.yes{/lang}"><span>{lang}wcf.ircService.my.channel.action.disabled.yes{/lang}</span></a></li>
    	                                    {else if $channel['status'] == 0}
        	                                    <li><a href="index.php?action=IRCServiceStatus&amp;chanID={$channel['chanID']}&amp;disabled=1{@SID_ARG_2ND}" title="{lang}wcf.ircService.my.channel.action.disabled.no{/lang}"><span>{lang}wcf.ircService.my.channel.action.disabled.no{/lang}</span></a></li>
        	                                    <li><a href="index.php?form=IRCServiceFilter&amp;chanID={$channel['chanID']}{@SID_ARG_2ND}" title="{lang}wcf.ircService.my.channel.action.filter{/lang}"><span>{lang}wcf.ircService.my.channel.action.filter{/lang}</span></a></li>
                                           	{else}
        	                                    <li><a href="index.php?action=IRCServiceSendCodeAgain&amp;chanID={$channel['chanID']}{@SID_ARG_2ND}" title="{lang}wcf.ircService.my.channel.action.activNowSend{/lang}"><span>{lang}wcf.ircService.my.channel.action.sendCodeAgain{/lang}</span></a></li>
            	                          	{/if}
                    	                </ul>
									</div>
								</div>
                                
                                <br />
							{/foreach}
                     	</div>                 
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