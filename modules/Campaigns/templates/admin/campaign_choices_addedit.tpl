<h3>Managing <i>{$campaign->getName()}</i> Voting Choices</h3>
<form id="campaign_choices" action="/admin/Campaigns" method="POST">
	<ul class="choice_holder">
		{assign var=choiceNum value=0}
		{foreach from=$campaign->getChoices() item=choice}
			{assign var=choiceNum value=$choiceNum+1}
			<li>
				<label for="choice[{$choice->getId()}][main]">Category {$choiceNum}:</label> 
				<input type="text" name="choice[{$choice->getId()}][main]" value="{$choice->getChoice()}" />
				<a href="#" onclick="return !choiceDelete(this);"><image src="/images/admin/cancel.png" /></a>
				<ul class="option_holder">
				{assign var=optNum value=0}
				{foreach from=$campaign->getChoices($choice->getId()) item=option}
					{assign var=optNum value=$optNum+1}
					<li class="option">
						<label for="choice[{$choice->getId()}][exist][{$option->getId()}]">Choice {$optNum}:</label> 
						<input type="text" name="choice[{$choice->getId()}][exist][{$option->getId()}]" value="{$option->getChoice()}" class="option" />
						<a href="#" onclick="return !optionDelete(this);"><image src="/images/admin/cancel.png" /></a>
					</li>
				{/foreach}
					<li>
						<div style="padding-bottom: 10px;"><a href="#" onclick="return !addOption(this);">Add New Choice</a></div>
					</li>
				</ul>
			</li>
		{/foreach}
		
	</ul>
	<div style="padding-top: 10px;"><a href="#" onclick="return !addChoice(this);">Add New Category</a></div>
	<input type="hidden" name="section" value="questionedit" />
	<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
	<input type="submit" name="choices_submit" value="Update" />
</form>
