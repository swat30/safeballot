function _emptyMenuItems(menu)
{
	if( typeof(menu) != "object" )
	{
		menu = document.getElementById(menu);
	}

	if( typeof(menu) == "object" )
	{
		for( var key in menu.options )
		{
			menu.options[key] = null;
			menu.remove(key);
		}
	}
}

function _setMenuItems(menu, items, selected_item_id)
{
	var opt;

	if( typeof(menu) != "object" )
	{
		menu = document.getElementById(menu);
	}

	if( typeof(menu) == "object"  ) // && typeof(items) == "object"
	{
		var i = 0;
		for( var key in items )
		{

			opt = new Option(items[key], key);
			menu.options[i] = opt;
			if(key == selected_item_id) {
			opt.selected = true;
			}

			i++;
			if(i>=items.length){
				break;//Deal with associative array incorrect length
			}
		}
	}
}

function _fillInMenu(menu_id, values, selected_item_id)
{
	var menu = document.getElementById(menu_id);

	if( typeof(menu) == "object" )
	{
		_emptyMenuItems(menu);
		_setMenuItems(menu, values, selected_item_id);
	}
}

function _setMenuChangeHandler(menu_id, handler)
{
	var menu = document.getElementById(menu_id);

	if( typeof(menu) == "object" )
	{
		menu.onchange = handler;
	}
}

function _getMenuCurValue(menu_id)
{
	var menu;

	if( typeof(menu_id) == "object" )
	{
		menu = menu_id;
	}
	else
	{
		menu = document.getElementById(menu_id);
	}

	return menu.options[menu.selectedIndex].value;
}