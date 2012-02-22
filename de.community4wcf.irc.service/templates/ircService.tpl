{include file="documentHeader" sandbox='false'}
<head>
	<title>{lang}wcf.ircService.title{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file='headInclude' sandbox=false}
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}> 
{include file='header' sandbox=false}
<div id="main">
	
	<div class="mainHeadline"> 
		<img src="{icon}ircServiceL.png{/icon}" alt="" title="{lang}wcf.ircService.title{/lang}" />
		<div class="headlineContainer">
			<h2>{lang}wcf.ircService.title{/lang}</h2>
			<p>{lang}wcf.ircService.title.description{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
    
    <div class="border">
		<div class="layout-2">
			<div class="columnContainer">	
				<div class="container-1 column first">
					<div class="columnInner">
                    	<div class="contentBox">
							<h3 class="subHeadline">{lang}wcf.ircService.general{/lang}</h3>
							<p>{@$ircGeneralMessage}</p>                       
                            <div class="buttonBar">
								<div class="smallButtons">
									<ul><li class="extraButton"><a href="#top" title="{lang}wcf.global.scrollUp{/lang}"><img src="{icon}upS.png{/icon}" alt="{lang}wcf.global.scrollUp{/lang}" /> <span class="hidden">{lang}wcf.global.scrollUp{/lang}</span></a></li></ul>
								</div>
							</div>
						</div>							
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