{assign var=blockcount value=0}
{foreach from=$blocks item=block}
	{assign var=blockcount value=$blockcount+1}
	{$block->getContent()}
	{if $blockcount < $blocks|@count}
		<div class="hr">&nbsp;</div>
	{/if}
{/foreach}
