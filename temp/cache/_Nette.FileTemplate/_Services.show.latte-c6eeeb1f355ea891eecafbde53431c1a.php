<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.92161600 1349788996";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"C:\Program Files\xampp\htdocs\jampl\app\templates\Services\show.latte";i:2;i:1347911706;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: C:\Program Files\xampp\htdocs\jampl\app\templates\Services\show.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'c0cs62hnpq')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block left
//
if (!function_exists($_l->blocks['left'][] = '_lb7a0078c1c5_left')) { function _lb7a0078c1c5_left($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Zobrazit</h2>
<div class="content-box">
<ul class="art-vmenu">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($services) as $service): ?>
    <li>
        <a href="<?php echo htmlSpecialChars($_presenter->link('show', array($service->id))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($service->title, ENT_NOQUOTES) ?></a>
    </li>
    <?php if (!$iterator->last): ?><hr class="divider" /><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</ul>
</div>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbba23c1a65c_content')) { function _lbba23c1a65c_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader"><?php echo Nette\Templating\Helpers::escapeHtml($item->title, ENT_NOQUOTES) ?></h2>
<div class="art-post-body reference">
    <?php echo Nette\Templating\Helpers::escapeHtml($item->text, ENT_NOQUOTES) ?>

    <h3>Fotodokumentace</h3>
    <div class="galery">
        <a href="<?php echo htmlSpecialChars($basePath) ?>/files/<?php echo htmlSpecialChars($item->foto) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/files/thumb_<?php echo htmlSpecialChars($item->foto) ?>" class="preview" /></a>
<?php if ($item->galery_album): $iterations = 0; foreach ($item->galery_album->related('galery') as $picture): ?>
        <a href="<?php echo htmlSpecialChars($basePath) ?>/files/galery/<?php echo htmlSpecialChars($picture->name) ?>">
            <img src="<?php echo htmlSpecialChars($basePath) ?>/files/galery/thumb_<?php echo htmlSpecialChars($picture->name) ?>
" title="<?php echo htmlSpecialChars($picture->description) ?>" class="preview" />
        </a>
<?php $iterations++; endforeach ;endif ?>
    </div>
</div>
<?php
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lb5d5f26d2ce_admin')) { function _lb5d5f26d2ce_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb29711a2f7b_head')) { function _lb29711a2f7b_head($_l, $_args) { extract($_args)
?><link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/jquery.lightbox-0.5.css" media="screen" />

<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.lightbox-0.5.js"></script>

<link rel="Stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/slideshow/smoothDivScroll.css" />

<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/slideshow/jquery.smoothdivscroll.js"></script>
<script src="<?php echo htmlSpecialChars($basePath) ?>/js/slideshow/jquery.mousewheel.min.js" type="text/javascript"></script>

<script type="text/javascript">
// Initialize the plugin with no custom options
$(function() {
    $('.galery a').lightBox({
        imageLoading: '<?php echo $basePath ?>/images/galery/lightbox-ico-loading.gif',
        imageBtnClose: '<?php echo $basePath ?>/images/galery/lightbox-btn-close.gif',
        imageBtnPrev: '<?php echo $basePath ?>/images/galery/lightbox-btn-prev.gif',
        imageBtnNext: '<?php echo $basePath ?>/images/galery/lightbox-btn-next.gif'
    });
    // I just set some of the options
    $(".galery").smoothDivScroll({
            mousewheelScrolling: true,
            manualContinuousScrolling: true
    });
});

</script>

<style>
    .admin-tool { float: right; }
    .admin-tool img { width: 50px; height: 50px; }
    .reference-top { overflow: auto; }
    .reference-top {
        text-align: center;
        margin: 5px;
        color: #1B47AF;
        font-weight: bold;
        <?php if ($admin): ?>padding-left: 50px;<?php endif ?>

    }
    .reference { overflow: auto; }
    .reference h3 {
        color: #1B47AF;
        margin: 20px 0 0 0;
        text-align: center;
        font-size:larger;
    }
    .reference .galery {
        border: solid 2px #cecece;
        background-color: #dedede;
        width: 99%;
        height: 100px;
        position: relative;
    }
    .reference .galery img.preview {
        width: 100px;
        height: 100px;
        margin: 0 2px;
    }

    .galery div.scrollableArea *
    {
            position: relative;
            float: left;
            margin: 0;
            padding: 0;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            user-select: none;
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['left']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['admin']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 