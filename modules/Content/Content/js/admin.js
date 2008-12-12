function setSelectedTemplate(event) {

	var templates = $$('div.template');
  	templates.each( function(element) {
  		element.setStyle({
			backgroundColor: '#fff'
		});
  	});

	var parent = Event.element(event).up('div.template')
	if (!parent) {
		parent = Event.element(event);
	}
	
	new Effect.Highlight(parent);
	parent.setStyle({
		backgroundColor: '#ddd'
	});
	var template_id = parent.identify();
	
	$('template_id').value = template_id;
	$('template_submit').enable();
}

Event.observe(window, 'load', function() {
	$('template_submit').disable();
  	var templates = $$('div.template');
  	templates.each( function(element) {
  		element.observe('click', setSelectedTemplate);
  	});
});