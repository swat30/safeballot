<h3>Viewing <i>{$campaign->getName()}</i> results (<a href="/admin/Campaigns" title="Back">Back</a>)</h3>

<ul id="resultsList">
{foreach from=$campaign->sortVotes() item=choice}
	<li class="choiceResult">{$choice->getChoice()}</li>
	<li>
		<ul id="resultsSubList">
		{foreach from=$campaign->sortVotes($choice->getId()) item=option}
			<li class="optionResult">{$option->getChoice()}: {math equation="(x / y)*100" x=$option->getVotes() y=$campaign->getVoteCount()}%</li>
		{/foreach}
		</ul>
	</li>
	<br />
{/foreach}
</ul>