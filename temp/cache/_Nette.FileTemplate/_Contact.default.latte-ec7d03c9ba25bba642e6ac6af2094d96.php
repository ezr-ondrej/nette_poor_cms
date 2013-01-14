<?php //netteCache[01]000393a:2:{s:4:"time";s:21:"0.73320100 1349789126";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:71:"C:\Program Files\xampp\htdocs\jampl\app\templates\Contact\default.latte";i:2;i:1348160807;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: C:\Program Files\xampp\htdocs\jampl\app\templates\Contact\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ry5e1fs9xk')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbec82c11bd3_content')) { function _lbec82c11bd3_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Kontakty</h2>
<?php $iterations = 0; foreach ($contact_groups as $group): ?>
<div class="content-top">
	<div class="art-bar art-blockheader">
		<h3><?php echo Nette\Templating\Helpers::escapeHtml($group->name, ENT_NOQUOTES) ?></h3>
	</div>

	<div class="admin-tool">
	<?php if ($admin): ?><a title="Přidat kontakt" href="<?php echo htmlSpecialChars($_control->link("addContact!", array($group->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/add.png" /></a><?php endif ?>

	</div>
</div>
<table class="contacts">
<?php $iterations = 0; foreach ($group->related('contact') as $contact): ?>
    <tr>
        <td class="contact-function"><?php echo Nette\Templating\Helpers::escapeHtml($contact->function, ENT_NOQUOTES) ?></td>
        <td class="contact-name"><?php echo Nette\Templating\Helpers::escapeHtml($contact->name, ENT_NOQUOTES) ?></td>
        <td class="contact-number"><?php echo Nette\Templating\Helpers::escapeHtml($contact->phone, ENT_NOQUOTES) ?></td>
        <td class="contact-mail"><a href="mailto:<?php echo htmlSpecialChars($contact->mail) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($contact->mail, ENT_NOQUOTES) ?></a></td>
<?php if ($admin): ?>
		<td><span class="admin-tool-mini">
			<a class="edit" href="<?php echo htmlSpecialChars($_control->link("editcont!", array($contact->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/miniedit.png" /></a>
			<a class="delete" href="<?php echo htmlSpecialChars($_control->link("delcont!", array($contact->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/minidel.png" /></a>
		</span></td>
<?php endif ?>
    </tr>
<?php $iterations++; endforeach ?>
</table>
<?php $iterations++; endforeach ;
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lbd7a56b5c9f_admin')) { function _lbd7a56b5c9f_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb5214da507c_head')) { function _lb5214da507c_head($_l, $_args) { extract($_args)
?><style>
	.admin-tool-mini img { margin: 0; }
	.contacts {
		margin-bottom: 30px !important;
		background-color: #EDF1F2;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
	.contacts tr {
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
	.contacts tr:hover {
		background-color: #C1CFD1;
	}
    .contacts td { padding: 5px 10px; }
	.contacts td,
	.contacts th {
		border: none;
	}
	.admin-tool img {
		float: right;
		width: 40px;
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