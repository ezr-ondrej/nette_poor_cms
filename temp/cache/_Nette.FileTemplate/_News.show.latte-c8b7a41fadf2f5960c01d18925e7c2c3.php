<?php //netteCache[01]000387a:2:{s:4:"time";s:21:"0.39703800 1349789116";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"C:\Program Files\xampp\htdocs\jampl\app\templates\News\show.latte";i:2;i:1348165992;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: C:\Program Files\xampp\htdocs\jampl\app\templates\News\show.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'qxs68dmttn')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba8a73c0142_content')) { function _lba8a73c0142_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader"><?php echo Nette\Templating\Helpers::escapeHtml($item->title, ENT_NOQUOTES) ?></h2>
<div class="art-post-body actuality">
<?php if ($item->img): ?>
	<div class="galery">
        <a href="<?php echo htmlSpecialChars($basePath) ?>/files/<?php echo htmlSpecialChars($item->img) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/files/thumb_<?php echo htmlSpecialChars($item->img) ?>" class="preview" /></a>
    </div>
<?php endif ?>
	<?php echo Nette\Templating\Helpers::escapeHtml($item->text, ENT_NOQUOTES) ?>

</div>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbd88db0db03_head')) { function _lbd88db0db03_head($_l, $_args) { extract($_args)
?><link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/jquery.lightbox-0.5.css" media="screen" />

<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.lightbox-0.5.js"></script>

<script type="text/javascript">
// Initialize the plugin with no custom options
$(function() {
    $('.galery a').lightBox({
        imageLoading: '<?php echo $basePath ?>/images/galery/lightbox-ico-loading.gif',
        imageBtnClose: '<?php echo $basePath ?>/images/galery/lightbox-btn-close.gif',
        imageBtnPrev: '<?php echo $basePath ?>/images/galery/lightbox-btn-prev.gif',
        imageBtnNext: '<?php echo $basePath ?>/images/galery/lightbox-btn-next.gif'
    });
});

</script>

<style>
    .admin-tool { float: right; }
    .admin-tool img { width: 50px; height: 50px; }
	.galery { float: left; }
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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 