<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:11:01
         compiled from admin/menu_addedit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajaxcall', 'admin/menu_addedit.tpl', 2, false),)), $this); ?>

<?php echo smarty_function_ajaxcall(array('stubs' => 'all','loadJS' => 'true'), $this);?>

<script src="/js/menuhandler.js"></script>

<?php echo $this->_tpl_vars['form']->display(); ?>


<?php echo '<script>
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
</script>'; ?>

