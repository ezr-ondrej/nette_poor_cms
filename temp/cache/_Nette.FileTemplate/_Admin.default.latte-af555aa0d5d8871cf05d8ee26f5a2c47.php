<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.01016800 1349854890";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"/C/Program Files/xampp/htdocs/jampl/app/templates/Admin/default.latte";i:2;i:1348993557;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/templates/Admin/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'v4x4avwa3p')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb8fc78fdbcd_content')) { function _lb8fc78fdbcd_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Admin</h2>
<div class="art-post-body">
Dobrý den, jste přihlášen jako <?php echo Nette\Templating\Helpers::escapeHtml($username, ENT_NOQUOTES) ?> <br />
Jste oprávněn měnit obsah.<br />
<p>U nastavitelných položek by měly být ovládací prvky, umožňující administraci.
Pokud tomu tak není, kontaktujte prosím kontaktní osobu <a href="http://www.wepla.cz">Wepla webservis</a></p>
</div>

<h2 class="art-postheader">Admin Accounts</h2>
<?php if ($userid==1): ?>
<div class="admin-tool">
	<a class="add" href="<?php echo htmlSpecialChars($_control->link("addmod!")) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/add.png" width="40px" /></a>
</div>
<?php endif ?>
<div class="art-post-body">
<table>
    <tr>
	<th>Username</th><th>Jméno</th><th>Příjmení</th><th>E-mail</th><th></th>
    </tr>
<?php $iterations = 0; foreach ($moderators as $moderator): ?>
    <tr>
	<td><?php echo Nette\Templating\Helpers::escapeHtml($moderator->username, ENT_NOQUOTES) ?></td>
	<td><?php echo Nette\Templating\Helpers::escapeHtml($moderator->name, ENT_NOQUOTES) ?></td>
	<td><?php echo Nette\Templating\Helpers::escapeHtml($moderator->surname, ENT_NOQUOTES) ?></td>
	<td><?php echo Nette\Templating\Helpers::escapeHtml($moderator->mail, ENT_NOQUOTES) ?></td>
	<td><span class="admin-tool-mini">
		<a class="edit" href="<?php echo htmlSpecialChars($_control->link("editpass!", array($moderator->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/miniedit.png" /></a>
		<?php if ($moderator->id!=$userid && $moderator->id!=1): ?><a class="delete" href="<?php echo htmlSpecialChars($_control->link("delmod!", array($moderator->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/minidel.png" /></a><?php endif ?>

	    </span></td>
    </tr>
<?php $iterations++; endforeach ?>
</table>


</div>
<?php
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lb6880aa58f2_admin')) { function _lb6880aa58f2_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb77e5d46ad7_head')) { function _lb77e5d46ad7_head($_l, $_args) { extract($_args)
?><style>
	.admin-tool {
		float: right;
	}
</style>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['admin']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 