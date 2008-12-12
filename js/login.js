function loginSubmit(form) {
	return new Ajax.Request('/user/login', {
		method: 'post',
		parameters: { username:form.username.value, password:form.password.value },
		onSuccess: function(transport) {
			$('loginBlock').update(transport.responseText);
		}
	}); 
}

function logoutSubmit(form) {
	return new Ajax.Request('/user/logout', {
		method: 'post',
		parameters: { logout:true},
		onSuccess: function(transport) {
			$('loginBlock').update(transport.responseText);
		}
	});
}

Event.observe(window, 'load', function() {
	var loginElements = $('loginForm').getElements();
	loginElements.pop();
	loginElements.invoke('observe', 'focus', function(event) {
		var el = Event.element(event);
		el.setStyle({backgroundColor: '#FFFF99'});
	});
	loginElements.invoke('observe', 'blur', function(event) {
		var el = Event.element(event);
		el.setStyle({backgroundColor: 'white'});
	});
	
	if($('username').value == ''){
		$('username').focus();
	} else if($('password').value == ''){
		$('password').focus();
	} else {
		$('doLogin').focus();
	}
});
