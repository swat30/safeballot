<h3>Checking user voting status on <i>{$campaignName}</i></h3>

<div style="font-weight: bold;">Users who have voted</div>
<ul class="userVoteList">
	{foreach from=$votedlist item=voter}
	<li>{$voter->getName()}</li>
	{foreachelse}
	<li>None</li>
	{/foreach}
</ul>
<div style="font-weight: bold; padding-top: 5px;">Users who have NOT voted</div>
<ul class="userVoteList">
	{foreach from=$notvotedlist item=voter}
	<li>{$voter->getName()}</li>
	{foreachelse}
	<li>None</li>
	{/foreach}
</ul>
