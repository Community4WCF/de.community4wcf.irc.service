{include file='header'}
<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/MultiPagesLinks.class.js"></script>

<div class="mainHeadline">
	<img src="{@RELATIVE_WCF_DIR}icon/ircServiceEggdropL.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wcf.acp.ircServiceEggdrop.list{/lang}</h2>
	</div>
</div>

{if $deleteedeggdropID}
	<p class="success">{lang}wcf.acp.ircServiceEggdrop.delete.success{/lang}</p>	
{/if}

<div class="contentHeader">
	{pages print=true assign=pagesLinks link="index.php?page=IRCServiceEggdropList&pageNo=%d&sortField=$sortField&sortOrder=$sortOrder&packageID="|concat:PACKAGE_ID:SID_ARG_2ND_NOT_ENCODED}
	
	{if $this->user->getPermission('admin.ircservice.canAddEggdrop')}
		<div class="largeButtons">
			<ul><li><a href="index.php?form=IRCServiceEggdropAdd&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/ircServiceEggdropAddM.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.add{/lang}" /> <span>{lang}wcf.acp.ircServiceEggdrop.add{/lang}</span></a></li></ul>
		</div>
	{/if}
</div>

{if $eggdropsList|count}
	<div class="border titleBarPanel">
		<div class="containerHead"><h3>{lang}wcf.acp.ircServiceEggdrop{/lang}</h3></div>
	</div>
	<div class="border borderMarginRemove">
		<table class="tableList">
			<thead>
				<tr class="tableHead">
					<th class="columneggdropID{if $sortField == 'eggdropID'} active{/if}" colspan="2"><div><a href="index.php?page=IRCServiceEggdropList&amp;pageNo={@$pageNo}&amp;sortField=eggdropID&amp;sortOrder={if $sortField == 'eggdropID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.ircServiceEggdrop.eggdropID{/lang}{if $sortField == 'eggdropID'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					<th class="columneggdropName{if $sortField == 'eggdropName'} active{/if}"><div><a href="index.php?page=IRCServiceEggdropList&amp;pageNo={@$pageNo}&amp;sortField=eggdropName&amp;sortOrder={if $sortField == 'eggdropName' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.ircServiceEggdrop.eggdropName{/lang}{if $sortField == 'eggdropName'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					<th class="columnhost{if $sortField == 'host'} active{/if}"><div><a href="index.php?page=IRCServiceEggdropList&amp;pageNo={@$pageNo}&amp;sortField=host&amp;sortOrder={if $sortField == 'host' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.ircServiceEggdrop.host{/lang}{if $sortField == 'host'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					<th class="columnhost{if $sortField == 'port'} active{/if}"><div><a href="index.php?page=IRCServiceEggdropList&amp;pageNo={@$pageNo}&amp;sortField=port&amp;sortOrder={if $sortField == 'port' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.ircServiceEggdrop.port{/lang}{if $sortField == 'port'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					
					{if $additionalColumns|isset}{@$additionalColumns}{/if}
				</tr>
			</thead>
			<tbody>
			{foreach from=$eggdropsList item=eggdropList}
				<tr class="{cycle values="container-1,container-2"}">
					<td class="columnIcon">
						{if $this->user->getPermission('admin.ircservice.canEditEggdrop')}
							<a href="index.php?form=IRCServiceEggdropEdit&amp;eggdropID={@$eggdropList->eggdropID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/editS.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.edit{/lang}" /></a>
						{else}
							<img src="{@RELATIVE_WCF_DIR}icon/editDisabledS.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.edit{/lang}" />
						{/if}
						{if $this->user->getPermission('admin.ircservice.canDeleteEggdrop')}
							<a onclick="return confirm('{lang}wcf.acp.ircServiceEggdrop.delete.sure{/lang}')" href="index.php?action=IRCServiceEggdropDelete&amp;eggdropID={@$eggdropList->eggdropID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/deleteS.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.delete{/lang}" /></a>
						{else}
							<img src="{@RELATIVE_WCF_DIR}icon/deleteDisabledS.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.delete{/lang}" />
						{/if}
						
						{if $eggdropList->additionalButtons|isset}{@$eggdropList->additionalButtons}{/if}
					</td>
					<td class="columneggdropID columnID">{@$eggdropList->eggdropID}</td>
					<td class="columneggdropName columnText">
						{if $this->user->getPermission('admin.ircservice.canEditEggdrop')}
							<a href="index.php?form=IRCServiceEggdropEdit&amp;eggdropID={@$eggdropList->eggdropID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{$eggdropList->eggdropName}</a>
						{else}
							{$eggdropList->eggdropName}
						{/if}
					</td>
					<td class="columnhost columnText">{$eggdropList->host}</td>
					<td class="columnport columnText">{$eggdropList->port}</td>
					
					{if $eggdropList->additionalColumns|isset}{@$eggdropList->additionalColumns}{/if}
				</tr>
			{/foreach}
			</tbody>
		</table>
	</div>

	<div class="contentFooter">
		{@$pagesLinks}
		
		{if $this->user->getPermission('admin.ircservice.canAddEggdrop')}
			<div class="largeButtons">
				<ul><li><a href="index.php?form=IRCServiceEggdropAdd&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/ircServiceEggdropAddM.png" alt="" title="{lang}wcf.acp.ircServiceEggdrop.add{/lang}" /> <span>{lang}wcf.acp.ircServiceEggdrop.add{/lang}</span></a></li></ul>
			</div>
		{/if}
	</div>
{else}
	{lang}wcf.acp.ircServiceEggdrop.empty{/lang}
{/if}

{include file='footer'}