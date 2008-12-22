var cur = 0;

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
	var label = Builder.node('label', { htmlFor: 'nChoice['+(cur)+']'}, 'Category '+(pchoiceNum)+": ");
	var subUl = Builder.node('ul');
	subUl.addClassName('option_holder');
	var subLi = Builder.node('li');
	var subDiv = Builder.node('div', {style: 'padding-bottom: 10px;'});
	var subHref = Builder.node('a', {href: '#', onclick: 'return !addOption(this);'}, 'Add New Choice');
	subDiv.appendChild(subHref);
	subLi.appendChild(subDiv);
	subUl.appendChild(subLi);
	var newLi = Builder.node('li', [label, input, subUl]);
	ul.appendChild(newLi);
	
	alert('sdafsadf');

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