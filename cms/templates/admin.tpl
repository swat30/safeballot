<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{assign var=cms value=$config->getModuleOptions()}
<title>{$cms.name} - {if $isAdmin}Website{else}Campaign{/if} Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" href="/css/admin.css,/css/admin_menu.css,/css/admin_tabs.css,/css/tablesorter.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css"/>

<script type="text/javascript" src="/js/prototype.js,/js/scriptaculous.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>
<script type="text/javascript" src="/core/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">
var addChoice = function(link) {
	var ul = $(link).up('form').down('ul.choice_holder');
	var pchoiceNum;
	
	if(ul.select('li').size() > 0){
		var lastLabel = ul.immediateDescendants('li').last().down('label');
		lastLabel.innerHTML.scan(/[0-9]+/, function(match){ pchoiceNum = (parseInt(match[0]) + 1)});
	} else {
		pchoiceNum = 1;
	}
	cur++;
	
	var input = Builder.node('input', { type: 'text', name: 'nChoice['+(cur)+'][main]', style: 'background-color: yellow;' });
	var test = 'sdf';
	var label = Builder.node('label', { htmlFor: 'nChoice['+(cur)+']'}, 'Category '+(pchoiceNum)+": ");
	var subUl = Builder.node('ul', {class: 'option_holder'});
	var subLi = Builder.node('li');
	var subDiv = Builder.node('div', {style: 'padding-bottom: 10px;'});
	var subHref = Builder.node('a', {href: '#', onclick: 'return !addOption(this);'}, 'Add New Choice');
	subDiv.appendChild(subHref);
	subLi.appendChild(subDiv);
	subUl.appendChild(subLi);
	var newLi = Builder.node('li', [label, input, subUl]);
	ul.appendChild(newLi);

	return true;
}

var addOption = function(link) {
	var ul = $(link).up('ul.option_holder');
	var bottomHolder = ul.immediateDescendants('li').last();
	var poptionNum, parent;
	
	parent = ul.previous('input').readAttribute('name').sub(/\[main\]/, '');
	
	if(ul.select('li').size()-1 > 0){
		var lastLabel = ul.immediateDescendants('li').last().previous().down('label');
		lastLabel.innerHTML.scan(/[0-9]+/, function(match){ poptionNum = (parseInt(match[0]) + 1)});
	} else {
		poptionNum = 1;
	}
	cur++;
	
	var input = Builder.node('input', { type: 'text', name: (parent)+'[new]['+(cur)+']', style: 'background-color: yellow;' });
	input.addClassName('option');
	var label = Builder.node('label', { htmlFor: (parent)+'[new]['+(cur)+']'}, 'Choice '+(poptionNum)+": ");
	var newLi = Builder.node('li', [label,input]);
	ul.insertBefore(newLi, bottomHolder);
	
	return true;
}

var choiceDelete = function(element) {
	var disInput = element.up('li').down('input');
	var disLabel = element.up('li').down('label');
	var choiceNum;
	disLabel.innerHTML.scan(/[0-9]+/, function(match){ choiceNum = match[0] });
	var desc = element.up('ul').childElements();
	
	element.up('li').toggle();
	disInput.value = null;
	choiceNum = 1;
	desc.each(function(item) {
		if(item.getStyle('display') != 'none'){
			item.down('label').innerHTML = 'Category '+choiceNum+': ';
			choiceNum++;
		}
	});
}

var optionDelete = function(element) {
	var disInput = element.up('li').down('input');
	var disLabel = element.up('li').down('label');
	var choiceNum;
	disLabel.innerHTML.scan(/[0-9]+/, function(match){ optionNum = match[0] });
	var desc = element.up('ul').childElements();
	
	element.up('li').toggle();
	disInput.value = null;
	optionNum = 1;
	desc.without(desc.last()).each(function(item) {
		if(item.getStyle('display') != 'none'){
			item.down('label').innerHTML = 'Choice '+optionNum+': ';
			optionNum++;
		}
	});
}

var updateEndDate = function(element) {
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

</head>
<body>

<div id="sitewrap">
	
	<div id="headerHolder">
		<div id="headerTitle"><a href="/admin/"><img src="/images/admin/norex_logo.png" alt="Norex" title="Norex" /></a></div>
		<div id="logout"><a href="/user/logout">LOGOUT</a> | <a href="/" title="Return to Public Site">BACK TO SITE</a></div>
		<div id="nav">{menu admin=true}</div>
	</div>

	<div id="content">
		<div id="contentTopTd"></div>
		<div id="contentTd">
			<h2><span style="color:#000;">norex://safeballot/</span> {$module_title}</h2>
			<div id="messages"></div>
			<div id="module_content">{module class=$module admin=true}</div>
		</div>
		<div id="contentBottomTd"></div>
	</div>
	
	<div id="footer">
		<p>&copy; 2008 by <a href="http://www.norex.ca" title="Norex Core Web Development">Norex Core Web Development</a></p>
	</div>

</div>

</body>
</html>
