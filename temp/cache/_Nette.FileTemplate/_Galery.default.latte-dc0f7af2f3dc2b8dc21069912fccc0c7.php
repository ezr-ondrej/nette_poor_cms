<?php //netteCache[01]000392a:2:{s:4:"time";s:21:"0.55935600 1350930717";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:70:"C:\Program Files\xampp\htdocs\jampl\app\templates\Galery\default.latte";i:2;i:1350340247;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: C:\Program Files\xampp\htdocs\jampl\app\templates\Galery\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'xkvgvtadsr')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block left
//
if (!function_exists($_l->blocks['left'][] = '_lb63f24afd5c_left')) { function _lb63f24afd5c_left($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Zobrazit</h2>
<div class="content-box">
<ul class="art-vmenu">
    <li>
        <a href="<?php echo htmlSpecialChars($_control->link("this", array(null))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>Vše</a>
    </li>
<?php $iterations = 0; foreach ($categories as $category): ?>
    <li>
        <a href="<?php echo htmlSpecialChars($_control->link("this", array($category->id))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($category->name, ENT_NOQUOTES) ?></a>
<?php if ($admin and $category->user): ?>
        <div class="admin-tool-mini">
            <a class="delete" href="<?php echo htmlSpecialChars($_control->link("delcat!", array($category->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/minidel.png" /></a>
        </div>
<?php endif ?>
    </li>
<?php $iterations++; endforeach ?>
</ul>
<hr class="divider" />
</div>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbd13e36a006_content')) { function _lbd13e36a006_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Alba</h2>
<div class="content-box">
<div class="gallery-top">
        <?php if ($admin): ?>Varování: Zde se uživateli zobrazují pouze alba, ve kterých jsou obrázky!
    <div class="admin-tool">
        <a href="#" class="admin" title="Přidat album/kategorii"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/add.png" /></a>
    </div>
<?php endif ?>
</div>
<div id="gallery">
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
<ul>
<?php $iterations = 0; foreach ($albaprev as $preview): ?>
        <li>
        <a  href="<?php echo htmlSpecialChars($_control->link("show", array($preview->id))) ?>
">
            <img src="<?php echo htmlSpecialChars($basePath) ?>/
<?php if ($preview['MIN(galery.name)']): ?>
					files/galery/thumb_<?php echo htmlSpecialChars($preview['MIN(galery.name)']) ?>

<?php else: ?>
					images/no_image.png
				<?php endif ?>" 
			class="preview" />
            <br />
            <?php echo Nette\Templating\Helpers::escapeHtml($preview['name'], ENT_NOQUOTES) ?>

<?php if ($admin && $preview->id!=0): ?>
            <div class="admin-tool">
                <a class="delete" href="<?php echo htmlSpecialChars($_control->link("delalb!", array($preview->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/minidel.png" /></a>
            </div>
<?php endif ?>
        </a>
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
if (!function_exists($_l->blocks['admin'][] = '_lbc2b9ce4258_admin')) { function _lbc2b9ce4258_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminAlbumForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb063938d1d1_head')) { function _lb063938d1d1_head($_l, $_args) { extract($_args)
?><link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/paginator.css" media="screen" />

<style type="text/css">
    .gallery-top { overflow: auto; }
    .gallery-top .admin-tool img { width: 50px; height: 50px; }
    
    .admin-tool-mini { position:absolute; top:5px; right:5px; }
    .admin-tool-mini a.ask-del { display: inline !important; }
    
    .admin-tool a.ask-del img { margin: 0 !important; padding: 0 !important; }
    .admin-tool { float: right; margin-right: 5px; }
    a.delete:hover { background: #e51e1e; }
    
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
        text-align: center;
    }
    #gallery ul a {
        color: #1B47AF;
        font-weight: bold;
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