<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:05:39
         compiled from admin/templates.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/templates.tpl', 27, false),)), $this); ?>
<div class="notice">Please be careful with changing the contents of the code below. Improper editing of the site template 
could cause your website to not display, or cause it to not look as you'd like it to.</div>


<script language="javascript" type="text/javascript" src="/modules/Templater/js/edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
<?php echo '
editAreaLoader.init({
	id : "editor"		// textarea id
	,syntax: "html"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
	,font_size: 9
});
'; ?>

</script>

<form action="/admin/Templater" method="post">
<div class="editor_details">
<input type="hidden" name="template_id" value="<?php echo $this->_tpl_vars['curtemplate']->getId(); ?>
" /> 
<input type="submit" name="save" value="Save" />
<br /><br />

<h1>Details</h1>
<p>
<strong>Module:</strong> <?php echo $this->_tpl_vars['curtemplate']->getModuleName(); ?>
<br />
<strong>Path:</strong> <?php echo $this->_tpl_vars['curtemplate']->getPath(); ?>
<br />
<strong>Last Modified:</strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['curtemplate']->getTimestamp())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D %l:%M %p") : smarty_modifier_date_format($_tmp, "%D %l:%M %p")); ?>


<h3>Revisions</h3>
<select name="revision" id="revision">
<?php $_from = $this->_tpl_vars['curtemplate']->getRevisions(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['template']):
?>
	<option value="<?php echo $this->_tpl_vars['template']->getId(); ?>
"<?php if ($this->_tpl_vars['template']->getId() == $this->_tpl_vars['curtemplate']->getId()): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['template']->getId(); ?>
: <?php echo $this->_tpl_vars['template']->getTimestamp(); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<input type="submit" name="switch_revision" value="Edit This Revision" />
</p>

<br /><br /><hr /><br />

<select name="template" id="template">
<?php $_from = $this->_tpl_vars['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['template']):
?>
	<option value="<?php echo $this->_tpl_vars['template']->getId(); ?>
"<?php if ($this->_tpl_vars['template']->getId() == $this->_tpl_vars['curtemplate']->getId()): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['template']->getModuleName(); ?>
: <?php echo $this->_tpl_vars['template']->getPath(); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<input type="submit" name="switch_template" value="Edit This Template" />
</div>

<textarea class="editor" id="editor" name="editor">
<?php echo $this->_tpl_vars['curtemplate']->getData(); ?>

</textarea>

</form>