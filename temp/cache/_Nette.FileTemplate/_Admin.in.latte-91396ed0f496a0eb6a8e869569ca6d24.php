<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.96844000 1349788192";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"C:\Program Files\xampp\htdocs\jampl\app\templates\Admin\in.latte";i:2;i:1347499098;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: C:\Program Files\xampp\htdocs\jampl\app\templates\Admin\in.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'yww8qda9zz')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4ee815a558_content')) { function _lb4ee815a558_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
<div class="content-box">
<?php $_ctrl = $_control->getComponent("signInForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb9b8623b233_title')) { function _lb9b8623b233_title($_l, $_args) { extract($_args)
?><h2>Sign in</h2>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbe2b1613f46_head')) { function _lbe2b1613f46_head($_l, $_args) { extract($_args)
?><style>
    table {
        margin: 0 auto;
        padding: 10px;
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
$robots = 'noindex' ?>


<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 