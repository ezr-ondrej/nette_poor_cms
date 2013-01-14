<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.07413900 1349854890";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"/C/Program Files/xampp/htdocs/jampl/app/components/AdminForm.latte";i:2;i:1347479556;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/components/AdminForm.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'grpt3j79wh')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block _
//
if (!function_exists($_l->blocks['_'][] = '_lbebc036e339__')) { function _lbebc036e339__($_l, $_args) { extract($_args); $_control->validateControl(false)
;$iterations = 0; foreach ($control->components as $component): ?>
    <div class="admin-data">
    <h3><?php echo Nette\Templating\Helpers::escapeHtml($component->name, ENT_NOQUOTES) ?></h3>
<?php if (is_object($component)) $_ctrl = $component; else $_ctrl = $_control->getComponent($component); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
    </div>
<?php $iterations++; endforeach ;
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

<div id="admin-overlay"></div>
<div id="admin-box">
<div id="admin-data-box">
<div id="admin-secNav">
    <a href="#" id="admin-btnClose">
    <img src="<?php echo htmlSpecialChars($basePath) ?>/images/btn-close.gif" />
    </a>
</div>
<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>
<div id="<?php echo $_control->getSnippetId('') ?>"><?php call_user_func(reset($_l->blocks['_']), $_l, $template->getParameters()) ?>
</div></div>
</div>