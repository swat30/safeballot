<h3 style="float: right;">
{if $step == 1}<a href="#" onclick="return false;">{/if}Enter Meta Info{if $step == 1}</a>{/if} 
:: {if $step == 2}<a href="#" onclick="return false;">{/if}Choose Template{if $step == 2}</a>{/if} 
:: {if $step == 3}<a href="#" onclick="return false;">{/if}Enter Page Content{if $step == 3}</a>{/if}
</h3>

<h3>Page Creation Wizard: Page {$step}</h3>

<p>Choose a template for your page. If you don't like any of the default templates you can always choose "Blank Template" and customize the display of your page to your liking later.</p>
<br />

<h2 style="border: none;">Choose One:</h2>
{foreach from=$templates item=template}
	<div class="template" style="cursor: pointer;" id="{$template->getId()}">
	<img src="/modules/Content/images/{$template->getPreview_image()}" style="float: left; padding-right: 10px;" />
	<h3>{$template->getName()}</h3>
	<p>{$template->getDescription()}</p>

	<div style="clear: both;"></div>

	</div>

	<br />
{/foreach}

<form id="templateid" method="post" action="/admin/Content">
<input id="section" name="section" type="hidden" value="wizard" />
<input id="wizardStep" name="wizardStep" type="hidden" value="2" />
<input type="hidden" id="template_id" name="template_id" value="null" />
<input type="submit" id="template_submit" name="submit" value="Next" />

</form>