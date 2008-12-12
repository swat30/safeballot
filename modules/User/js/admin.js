function submitPermissions(form) {
	$(form);
	return form.request( {
		onSuccess: function(transport) {
			$('permissions').update(transport.responseText);
		}
	}); 
}

function showGroupAddEdit(form) {
	
	if (form != null) {
		$(form);
		return form.request( {
			onSuccess: function(transport) {
				showOverlay(transport);
			}
		}); 
	} else {
		new Ajax.Request('/admin/User', {
			method: 'post',
			parameters: { section:'groupsaddedit' },
			onSuccess: function(transport) {
				showOverlay(transport);
			}
		});
	} 
}


function deleteConfirm(form) {
	if (confirm("Are you sure you want to delete this user? Deleting it will also remove all sub-items")) {
		return $(form).request( {
			onSuccess: function(transport) {
			}
		});
	}
	return true;
}

function updateUserList() {
	return !new Ajax.Request('/admin/User', {
		method: 'post',
		parameters: { section:'userTable'},
		onSuccess: function(transport) {
			$('user_table').update(transport.responseText);
		}
	}); 
}

function showOverlay(transport) {
	var displaybox = $('thickbox'); 
	displaybox.update(transport.responseText);
	
	
	/*
	if (!$(overlay)) {
		var overlay = document.createElement('DIV');
		overlay.setAttribute('id','overlay');

		var objBody = document.getElementsByTagName("body").item(0);
		objBody.insertBefore(overlay, objBody.firstChild);
	}
	overlay.style.display = 'block';
	*/
	new Effect.Appear($('thickbox_wrapper'), {duration: 0.2, fps: 100});
}

function hideOrUpdateOverlay(transport) {
	var displaybox = $('thickbox');
	if (transport.responseText.match(/class="error/)) {
		displaybox.update(transport.responseText);
	} else {
		hideThickBox();
		updateUserList();
	}
	updateUserList();
}

function hideOrUpdateOverlayGroup(transport) {
	var displaybox = $('thickbox');
	if (transport.responseText.match(/class="error/)) {
		displaybox.update(transport.responseText);
	} else {
		hideThickBox();
		updateGroupList();
	}
	updateGroupList();
}

function hideThickBox() {
	var displaybox = $('thickbox_wrapper');
	//var overlay = $('overlay');
	new Effect.Fade(displaybox, {duration: 0.2, fps: 65});
	//overlay.hide();
}

function showAddEdit(form) {
	
	if (form != null) {
		$(form);
		return form.request( {
			onSuccess: function(transport) {
				showOverlay(transport);
			}
		}); 
	} else {
		new Ajax.Request('/admin/User', {
			method: 'post',
			parameters: { section:'addedit' },
			onSuccess: function(transport) {
				showOverlay(transport);
			}
		});
	} 
}

function submitUser(form) {
	$(form);
	return !form.request( {
		onSuccess: function(transport) {
			hideOrUpdateOverlay(transport);
		}
	}); 
}

function submitGroup(form) {
	$(form);
	return !form.request( {
		onSuccess: function(transport) {
			hideOrUpdateOverlayGroup(transport);
		}
	}); 
}

function updateGroupList() {
	return !new Ajax.Request('/admin/User', {
		method: 'post',
		parameters: { section:'groups'},
		onSuccess: function(transport) {
			$('group_table').update(transport.responseText);
		}
	}); 
}

function selectGroup() {
	return !new Ajax.Updater('module_content', '/admin/User', {
		method: 'post',
		parameters: { section: 'permissions',  group_view: $F('group_select')},
		onSuccess: function(transport) {
			$('permissions_table').update(transport.responseText);
		}
	});
}