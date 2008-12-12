<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:03:03
         compiled from admin/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'helpitem', 'admin/menu.tpl', 4, false),array('function', 'ajaxcall', 'admin/menu.tpl', 9, false),)), $this); ?>
<h3>Menu Items</h3>

<div style="float: right;">
		<?php echo smarty_function_helpitem(array('item' => 'addmenuitem'), $this);?>
<a href="/admin/Menu&section=addedit" title="Create New Menu Item">Add Menu Item</a>
	</div>

<p>This interface allows you to manage the menu items available in the left menu.</p>

<?php echo smarty_function_ajaxcall(array('call' => "/admin/Menu&section=menuTable",'target' => 'menu_table'), $this);?>

