Event.observe(window, 'load', function(event){
	var interval = 60;
	var refresher = function() {
		new Ajax.PeriodicalUpdater('module_content', '/admin/Campaigns', {
			method: 'post',
			frequency: interval,
			decay: 1
		});
	}
	
	refresher();
});
