function getHelp(helpid) {
	new Ajax.Request('/core/Help.php', {
		method: 'get',
		parameters: { helpid: helpid },
		onSuccess: function(transport) {
			$('help').update(transport.responseText);
		}
	});
}

function showMovie(url) {
	facebox.loading();
	facebox.reveal('<p style="visibility: visible;" id="flashVideo"><object data="/include/mediaplayer.swf" type="application/x-shockwave-flash" height="480" width="720"><param value="#FFFFFF" name="bgcolor"><param value="file=' + url + '&autostart=true&allowfullscreen=true" name="flashvars"></object></p>');
	new Effect.Appear($('facebox'), {duration: 0.2, fps: 100});

	return false;
}

