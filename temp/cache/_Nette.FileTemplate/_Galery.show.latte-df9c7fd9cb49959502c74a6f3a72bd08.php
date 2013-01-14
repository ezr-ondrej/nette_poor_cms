<?php //netteCache[01]000389a:2:{s:4:"time";s:21:"0.49846900 1349862091";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:67:"/C/Program Files/xampp/htdocs/jampl/app/templates/Galery/show.latte";i:2;i:1349862089;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/templates/Galery/show.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'xdntyr9yvf')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block left
//
if (!function_exists($_l->blocks['left'][] = '_lb13e91bccaa_left')) { function _lb13e91bccaa_left($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Kategorie</h2>
<div class="content-box">
<ul class="art-vmenu">
    <li>
        <a href="<?php echo htmlSpecialChars($_control->link("default", array(null))) ?>
"<?php if ($_l->tmp = array_filter(array($album_des->galery_cat_id==null ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>Vše</a>
    </li>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($categories) as $category): ?>
    <?php if ($iterator->first): ?><hr class="divider" /><?php endif ?>

    <li>
        <a href="<?php echo htmlSpecialChars($_control->link("default", array($category->id))) ?>
"<?php if ($_l->tmp = array_filter(array($album_des->galery_cat_id==$category->id ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($category->name, ENT_NOQUOTES) ?></a>
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
if (!function_exists($_l->blocks['content'][] = '_lbbeff0bd5ee_content')) { function _lbbeff0bd5ee_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Album</h2>
<div class="art-post-body">
    <div class="gallery-top art-blockheader">
        <h3 class="t"><?php echo Nette\Templating\Helpers::escapeHtml($album_des->name, ENT_NOQUOTES) ?></h3>
        <div class="admin-tool">
        <?php if ($admin): ?><a href="#" class="admin" title="Přidat fotografii"><img src="<?php echo htmlSpecialChars($basePath) ?>
/images/buttons/add.png" /></a><?php endif ?>

        </div>
    </div>
    <div id="gallery" >
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
        <ul>
<?php $iterations = 0; foreach ($picts as $pict): ?>
            <li>
                <a href="<?php echo htmlSpecialChars($basePath) ?>/files/galery/<?php echo htmlSpecialChars($pict->name) ?>
" class="galery-link" title="<?php echo htmlSpecialChars($pict->description) ?>">
                    <img src="<?php echo htmlSpecialChars($basePath) ?>/files/galery/thumb_<?php echo htmlSpecialChars($pict->name) ?>" width="100" height="100" alt="" />
                </a>
<?php if ($admin): ?>
                <br />
                <span class="admin-tool">
                    <a class="edit" href="<?php echo htmlSpecialChars($_control->link("editpic!", array($pict->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/miniedit.png" /></a>
                    <a class="delete" href="<?php echo htmlSpecialChars($_control->link("delpic!", array($pict->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/minidel.png" /></a>
                </span>
<?php endif ?>
            </li>
<?php $iterations++; endforeach ?>
        </ul>
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
    </div>
</div>
<?php
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lbdeda6b9447_admin')) { function _lbdeda6b9447_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminFotoForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb148aefd596_head')) { function _lb148aefd596_head($_l, $_args) { extract($_args)
?><link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/paginator.css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/jquery.lightbox-0.5.css" media="screen" />

<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.lightbox-0.5.js"></script>

<!-- Ativando o jQuery lightBox plugin -->
<script type="text/javascript">
$(function() {
    $('a.galery-link').lightBox({
        imageLoading: '<?php echo $basePath ?>/images/galery/lightbox-ico-loading.gif',
	imageBtnClose: '<?php echo $basePath ?>/images/galery/lightbox-btn-close.gif',
	imageBtnPrev: '<?php echo $basePath ?>/images/galery/lightbox-btn-prev.gif',
	imageBtnNext: '<?php echo $basePath ?>/images/galery/lightbox-btn-next.gif'
    });
});
</script>
<style type="text/css">
    .seznam li { overflow: auto; }
    .seznam li a { font-size: 15px; }
    .gallery-top { overflow: auto; }
    .gallery-top .admin-tool img { width: 50px; height: 50px; }
    .admin-tool { float: right; margin-right: 5px; }
    .admin-tool a.edit:hover { background: #2a38e9; }
    .admin-tool a.delete:hover { background: #e51e1e; }
    /* jQuery lightBox plugin - Gallery style */
    #gallery {
        /*background-color: #444;*/
        padding: 10px;
        width: 90%;
    }
    #gallery img.preview {
        width: 100px;
        height: 80px;
    }
    #gallery ul { list-style: none; overflow: auto; }
    #gallery ul li {
        display: block;
        float:left;
        /*background: #3e3e3e;*/
        margin: 5px;
        padding: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
    #gallery ul a {
        text-decoration: none;
    }
    #gallery ul li:hover { background: #bbd8f0; }
</style>
</head>
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