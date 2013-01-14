<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.88470500 1350341944";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"/C/Program Files/xampp/htdocs/jampl/app/templates/About/default.latte";i:2;i:1350341915;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/templates/About/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'nkdgbq99sj')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block left
//
if (!function_exists($_l->blocks['left'][] = '_lbfad93df178_left')) { function _lbfad93df178_left($_l, $_args) { extract($_args)
?><ul class="art-vmenu">
    <li>
        <a href="<?php echo htmlSpecialChars($_control->link("About:")) ?>"<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent('About:') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>Naše firma</a>
    </li>
    <li>
        <a href="<?php echo htmlSpecialChars($_control->link("About:iso")) ?>"<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent('About:iso') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>Certifikace ISO</a>
    </li>
</ul>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb0eddeb8bad_content')) { function _lb0eddeb8bad_content($_l, $_args) { extract($_args)
;$_ctrl = $_control->getComponent("page"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbd7728b48ed_head')) { function _lbd7728b48ed_head($_l, $_args) { extract($_args)
?><style>
    .our-blue { color: #1D319F; }
    a.our-blue:active { color: #1D319F; }
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['left']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 