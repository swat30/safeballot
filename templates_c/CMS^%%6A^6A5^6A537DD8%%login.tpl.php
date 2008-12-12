<?php /* Smarty version 2.6.21-dev, created on 2008-11-28 14:35:01
         compiled from login.tpl */ ?>
<h1>Company Login</h1>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>
" id="loginForm">
<fieldset class="hidden">
<ol>

<li><label for="username" class="element">Username:</label><div class="element"><input type="text" id="username" name="username" <?php if ($_POST['username']): ?>value="<?php echo $_POST['username']; ?>
" <?php endif; ?>/></div></li>
<li><label for="password" class="element">Password:</label><div class="element"><input type="password" id="password" name="password" <?php if ($_POST['password']): ?>value="<?php echo $_POST['password']; ?>
" <?php endif; ?>/></div></li>
<li><label for="submit" class="element">&nbsp;</label><div class="element"><input value="Login" id="doLogin" name="doLogin" type="submit" /></div></li>

</ol>
</fieldset>
</form>