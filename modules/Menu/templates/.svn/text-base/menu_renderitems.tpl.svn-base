<li class="child{$depth}"><a href="{$item->link}" {if $item->target == "new"} target="_blank"{/if}>{$item->display}</a>
{if $item->children}
<ul>
{foreach from=$item->children item=item}
	{include file=menu_renderitems.tpl menu=item depth=$depth+1}
{/foreach}
</ul>
{/if}
</li>