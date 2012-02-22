{include file="documentHeader" sandbox='false'}
<head>
	<title>{lang}wcf.ircService.filter{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file='headInclude' sandbox=false}
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}> 
{include file='header' sandbox=false}
<div id="main">
	
	<div class="mainHeadline"> 
		<img src="{icon}ircServiceMyL.png{/icon}" alt="" title="{lang}wcf.ircService.filter{/lang}" />
		<div class="headlineContainer">
			<h2>{lang}wcf.ircService.filter{/lang}</h2>
			<p>{lang channelname=$channelname}wcf.ircService.filter.description{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
    
    <div class="border">
		<div class="layout-2">
			<div class="columnContainer">	
				<div class="container-1 column first">
					<div class="columnInner">
                    	<form method="post" action="index.php?form=IRCServiceFilter&amp;chanID={@$chanID}">
	                    	<h3 class="subHeadline">{lang}wcf.ircService.filter.title{/lang}</h3>
					
							<div class="formElement{if $errorField == 'values'} formError{/if}">
								<div class="formFieldLabel">
									<label for="values">{lang}wcf.ircService.filter.value{/lang}</label>
								</div>
							
								<div class="formField">
									<input type="text" class="inputText" name="values" value="{$values}" id="values" />
							
                            		{if $errorField == 'values'}
										<div class="innerError">
											{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
										</div>
									{/if}
								</div>
								<div class="formFieldDesc">
									<p>{lang}wcf.ircService.filter.value.description{/lang}</p>
								</div>
							</div>
                    
    	                	<fieldset>
								<legend>{lang}wcf.ircService.filter.aktiv{/lang}</legend>
								<ul class="memberList">
									{foreach from=$filters item=filter}
										<li class="deletable">
											<span>{$filter.value}</span>
											<a href="index.php?form=IRCServiceFilter&amp;remove={@$filter.filterID}&amp;chanID={@$chanID}{@SID_ARG_2ND}" title="{lang}wcf.ircService.filter.remove{/lang}" class="memberRemove deleteButton"><img src="{icon}deleteS.png{/icon}" alt="" longdesc="{lang}wcf.ircService.filter.remove.sure{/lang}" /></a>
										</li>
									{/foreach}
								</ul>
							</fieldset>     
                        
            	            <div class="formSubmit">
								<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
								<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
								{@SID_INPUT_TAG}
                                <input type="hidden" name="add" value="{@$chanID}" />
							</div>
						</form>               
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