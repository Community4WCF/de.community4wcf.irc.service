<?xml version="1.0" encoding="{@CHARSET}"?>
<list>
{if $datas|isset}
	{foreach from=$datas item=$data}
	<channel>
		<channelname>{$data['channelname']}</channelname>
		<useronlinelist>
		{foreach from=$data['useronlinelists'] item=$useronlinelist}
			<useronline>
				<nickname>{$useronlinelist['nickname']}</nickname>
				<voice>{$useronlinelist['voice']}</voice>
				<op>{$useronlinelist['op']}</op>
			</useronline>
		{/foreach}
		</useronlinelist>      
	</channel>
	{/foreach}
{/if}
</list>