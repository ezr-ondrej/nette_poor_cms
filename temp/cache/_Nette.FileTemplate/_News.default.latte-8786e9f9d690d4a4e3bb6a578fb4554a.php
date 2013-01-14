<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.08379600 1349788811";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"C:\Program Files\xampp\htdocs\jampl\app\templates\News\default.latte";i:2;i:1347832789;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: C:\Program Files\xampp\htdocs\jampl\app\templates\News\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'zexcvkq0vw')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb12a6a01f3f_content')) { function _lb12a6a01f3f_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Aktuality</h2>
<div class="art-post-body">
<?php if ($admin): ?>
    <div class="actuality-top">
    <div class="admin-tool">
        <a href="#" class="admin" title="Přidat aktualitu"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/add.png" /></a>
    </div>
    </div>
<?php endif ?>
    <div class="art-content-layout actuality">
<?php $iterations = 0; foreach ($news as $actuality): ?>
    <div class="art-content-layout-row">
<?php if ($admin): ?>
        <div class="admin-tool">
            <a class="edit" href="<?php echo htmlSpecialChars($_control->link("edit!", array($actuality->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/edit.png" /></a>
            <a class="delete" href="<?php echo htmlSpecialChars($_control->link("delete!", array($actuality->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/del.png" /></a>
        </div>
<?php endif ?>
        <h3><?php echo Nette\Templating\Helpers::escapeHtml($actuality->title, ENT_NOQUOTES) ?></h3>
        <blockquote style="margin: 10px 0">
            <?php if ($actuality->img): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/files/thumb_<?php echo htmlSpecialChars($actuality->img) ?>" class="preview" /><?php endif ?>

            <?php echo Nette\Templating\Helpers::escapeHtml($actuality->text, ENT_NOQUOTES) ?>

        </blockquote>
    </div>
        
<?php $iterations++; endforeach ?>
    </div>
</div>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb672ed041e1_head')) { function _lb672ed041e1_head($_l, $_args) { extract($_args)
?><style>
    h3 {
        text-align: left !important;
    }
    .admin-tool { float: right; }
    .admin-tool img { width: 40px; height: 40px; }
    .actuality-top { overflow: auto; }
    .actuality h3 {
        color: #1D319F;
    }
    img.preview {
        width: 80px;
        height: 80px;
        float: left;
        margin-right: 10px;
    }
</style>
<?php
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lbe911f5c95c_admin')) { function _lbe911f5c95c_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
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


<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['admin']), $_l, get_defined_vars()) ; 