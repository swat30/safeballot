var strings = {
		deleteItem: new Template("Are you sure you want to delete this #{type}? Deleting it will also remove all sub-items")
	};

var updateEvents = function() {
	$$('table.adminList tr.row1').invoke('observe', 'click', 
		function(event) { 
			var row = event.element().up('tr');
			new Effect.Highlight(row, {duration:1.5, startcolor: '#ffff99', endcolor: '#FFBF9C', restorecolor: '#ffbf9c'});
		}
	);
	$$('table.adminList tr.row2').invoke('observe', 'click', 
		function(event) { 
			var row = event.element().up('tr');
			new Effect.Highlight(row, {duration:1.5, startcolor: '#ffff99', endcolor: '#FFE1D0', restorecolor: '#FFE1D0'});
		}
	);
			
	$$('div#header ul#primary').invoke('observe', 'click', thickboxAddEdit.bindAsEventListener(thickboxAddEdit));
}

Event.observe(window, 'load', updateEvents);

function updateModuleContent(content) {
	$('module_content').update(content);
	
	updateEvents();
}

function deleteConfirm(form, itemType) {
	if (confirm(strings.deleteItem.evaluate({type: itemType}))) {
		new Effect.Fade(form.up('tr'), {
			duration: 0.5
		});
		return $(form).request();
	}
	return true;
}

function formSubmit(form) {
	return $(form).request( {
		onSuccess: function(transport) {
			if (transport.responseText.match(/class="error/)) {
				var displaybox = $('facebox'); 
				displaybox.update(transport.responseText);
				var form = displaybox.down('form');
				$(form).observe('submit', function(event){
			  		formSubmit(form);
			  		Event.stop(event);
			 	});
			} else {
				updateModuleContent(transport.responseText);
			}
		},
		onComplete: function(transport) {
			if (!transport.responseText.match(/class="error/)) {
				new Effect.Fade($('facebox'), {duration: 0.2, fps: 100});
			}
		}
	});
	
	return true;
}

var thickboxAddEdit = function(element) {
	if (!element.nodeType) {
		Event.stop(element);
		// Element is bound event listener to an <a href> link
		return new Ajax.Request(Event.element(element).href, {
			method: 'get',
			onSuccess: function(transport) {
				showThickBox(transport);
			}, 
			onComplete: function(transport) {
				
			}
		});
	} else {
		// Element is DOM form object
		return $(element).request({
			onSuccess: function(transport) {
				showThickBox(transport);
			}
		});
	}
}

function showThickBox(transport) {

	facebox.loading();
	facebox.reveal(transport.responseText);
	new Effect.Appear($('facebox'), {duration: 0.2, fps: 100});
	//$('facebox').show();
	
	if (form = $('facebox').down('form')) {
		Event.observe(form, 'submit', function(event) {
	  		formSubmit(form);
	  		Event.stop(event);
	 	});
 	}
	
}

function hideThickBox() {
	new Effect.Fade($('facebox'), {duration: 0.2, fps: 100});
	return true;
}

function initRTE(mode, theme, name, stylesheet, bodyId, bodyClass) {
	
	tinyMCE.init({
		mode : mode,
		theme : theme,
		elements : name,
		plugins : "safari,spellchecker,style,table,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,fullscreen,visualchars",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "iespell,media,advhr,separator,print,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		dialog_type : "modal",
		relative_urls : false,
		button_tile_map : true,
		theme_advanced_statusbar_location : "bottom",
		content_css : stylesheet,
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    body_id : bodyId,
	    body_class : bodyClass,
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		file_browser_callback : "norexFileBrowser",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true,
		apply_source_formatting : true,
		spellchecker_languages : "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv",
		oninit: "resizeFacebox"
	});
	
	
	return;
}

function resizeFacebox() {
	if ($('facebox')) {
		var pageScroll = document.viewport.getScrollOffsets();
		$('facebox').setStyle({
			'top': pageScroll.top + (document.viewport.getHeight() / 8) + 'px',
			'left': pageScroll.left + ((document.viewport.getWidth() - $('facebox').getWidth()) / 2) + 'px'
		});
	}
}

function norexFileBrowser (field_name, url, type, win) {

    // alert("Field_Name: " + field_name + "\nURL: " + url + "\nType: " + type + "\nWin: " + win); // debug/testing

    /* If you work with sessions in PHP and your client doesn't accept cookies you might need to carry
       the session name and session ID in the request string (can look like this: "?PHPSESSID=88p0n70s9dsknra96qhuk6etm5").
       These lines of code extract the necessary parameters and add them back to the filebrowser URL again. */

    var cmsURL = '/core/DataStorage.php?browser=true';    // script URL - use an absolute path!
    if (cmsURL.indexOf("?") < 0) {
        //add the type as the only query parameter
        cmsURL = cmsURL + "&type=" + type;
    }
    else {
        //add the type as an additional query parameter
        // (PHP session ID is now included if there is one at all)
        cmsURL = cmsURL + "&type=" + type;
    }

    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Norex File Browser',
        width : 750,  // Your dimensions may differ - toy around with them!
        height : 500,
        resizable : "yes",
        inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous : "no"
    }, {
        window : win,
        input : field_name
    });
    return false;
  }
