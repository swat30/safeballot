{literal}
<script language="text/javascript">
var updateEndDate = function(element) {
	$(element);
	var startEl = element.getElementsBySelector('option');
	var num;
	var elPart = element.readAttribute('name').sub("start_date", "");
	var endEl = $$('[name="end_date'+elPart+'"]')['0'].getElementsBySelector('option');

	startEl.each(function(el) {
		if (el.selected) {
			num = el.value;
		}
	});

	endEl.each(function(el) {
		if (el.readAttribute('value') == num){
			el.selected=true;
		} else if (el.selected) {
			el.selected=false;
		}
	});
}
</script>
{/literal}

<h3>{if $status}Editing{else}Adding new{/if} campaign for <i>{$company}</i> (<a href="/admin/Campaigns" title="Back">Go Back</a>)</h3>

{$form->display()}