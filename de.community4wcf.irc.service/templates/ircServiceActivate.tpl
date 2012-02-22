{include file="documentHeader"}
<head>
	<title>{lang}wcf.ircService.activate{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file='headInclude' sandbox=false}	
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{include file='header' sandbox=false}

<div id="main">	
	<div class="mainHeadline">
		<img src="{icon}ircServiceL.png{/icon}" alt="" title="{lang}wcf.ircService.activate{/lang}" />
		<div class="headlineContainer">
			<h2> {lang}wcf.ircService.activate{/lang}</h2>
			<p>{lang}wcf.ircService.activate.description{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
	
	{if $errorField}
		<p class="error">{lang}wcf.global.form.error{/lang}</p>
	{/if}
	
	<form method="post" action="index.php?form=IRCServiceActivate">
		<div class="border content">
			<div class="container-1">
				<div class="formElement{if $errorField == 'userID'} formError{/if}">
					<div class="formFieldLabel">
						<label for="userID">{lang}wcf.ircService.activate.userID{/lang}</label>
					</div>
					<div class="formField">
						<input type="text" class="inputText" name="userID" value="{$userID}" id="userID" />
				
						{if $errorField == 'userID'}
							<p class="innerError">
								{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
							</p>
						{/if}
					</div>
					<div class="formFieldDesc">
						<p>{lang}wcf.ircService.activate.userID.description{/lang}</p>
					</div>
				</div>
				
				<div class="formElement{if $errorField == 'code'} formError{/if}">
					<div class="formFieldLabel">
						<label for="code">{lang}wcf.ircService.activate.code{/lang}</label>
					</div>
					<div class="formField">
						<input type="text" class="inputText" name="code" value="{$code}" id="code" />
				
						{if $errorField == 'code'}
							<p class="innerError">
								{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								{if $errorType == 'wrong'}{lang}wcf.ircService.activate.error{/lang}{/if}
							</p>
						{/if}
					</div>
					<div class="formFieldDesc">
						<p>{lang}wcf.ircService.activate.code.description{/lang}</p>
					</div>
				</div>
											
			</div>
		</div>
			
		<div class="formSubmit">
			<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
			<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
		</div>
			
		{@SID_INPUT_TAG}
	</form>
</div>
{include file='footer' sandbox=false}
</body>
</html>