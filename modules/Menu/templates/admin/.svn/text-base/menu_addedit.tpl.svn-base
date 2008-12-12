
{ajaxcall stubs="all" loadJS="true"}
<script src="/js/menuhandler.js"></script>

{$form->display()}

{literal}<script>
var callbacks = {
   getLinkables: function(result) {
	   _fillInMenu("link", result);
   }
}

var remote = new Menu(callbacks);

function linkMenuHandler() {
   var linktype = _getMenuCurValue("linktype");
   remote.getLinkables(linktype);
}

_setMenuChangeHandler("linktype", linkMenuHandler);
//remote.getLinkables(_getMenuCurValue("linktype"));
</script>{/literal}

