<?php //netteCache[01]000385a:2:{s:4:"time";s:21:"0.15477600 1350341299";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:63:"/C/Program Files/xampp/htdocs/jampl/app/templates/@layout.latte";i:2;i:1350341296;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'rixkdudzz6')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb788ae233ff_title')) { function _lb788ae233ff_title($_l, $_args) { extract($_args)
?>Jampl<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb2094db7968_head')) { function _lb2094db7968_head($_l, $_args) { extract($_args)
;
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lbd392531f0e_admin')) { function _lbd392531f0e_admin($_l, $_args) { extract($_args)
;
}}

//
// block left
//
if (!function_exists($_l->blocks['left'][] = '_lbe1195a74a1_left')) { function _lbe1195a74a1_left($_l, $_args) { extract($_args)
;
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
<!DOCTYPE html>
<html>
<head>
    <!--
    Created by Artisteer v3.1.0.48375
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="description" content="Jampl-PSV s.r.o. Pomocná stavební výroba" />
<?php if (isset($robots)): ?>    <meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->striptags(ob_get_clean())  ?></title>

	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/actual.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/style.ie7.css" type="text/css" media="screen" /><![endif]-->

    
   <style type="text/css">
    .art-post .layout-item-0 { padding-right: 10px;padding-left: 10px; }
   .ie7 .art-post .art-layout-cell { border:none !important; padding:0 !important; }
   .ie6 .art-post .art-layout-cell { border:none !important; padding:0 !important; }
   </style>
	

	

        
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" type="image/x-icon" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<link rel="stylesheet" media="screen,projection,tv" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
    
<?php if (isset($editor)): ?>
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/tiny_mce/jquery.tinymce.js"></script>
<?php endif ?>
	
	<script type='text/javascript' src='<?php echo htmlSpecialChars($basePath, ENT_QUOTES) ?>/js/scroll/jquery.scrollTo-1.4.3.1-min.js'></script>
	<script type='text/javascript' src='<?php echo htmlSpecialChars($basePath, ENT_QUOTES) ?>/js/scroll/jquery.serialScroll-1.2.2-min.js'></script>
        
	<script>
	$(function(){
		$('#header').serialScroll({
			items:'li',
			duration:4000,
			force:true,
			axis:'x',
			easing:'linear',
			lazy:false,// NOTE: it's set to true, meaning you can add/remove/reorder items and the changes are taken into account.
			interval:1, // yeah! I now added auto-scrolling
			step:1 // scroll 2 each time
		});
	});
	</script>
<?php if ($admin): ?>
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/adminform.css" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/adminform.js"></script>
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.confirm-1.3.js"></script>

	<script type="text/javascript">
	$(function() {
		<?php if (isset($activate_admin)): ?>$().adminform('show');<?php endif ?>

		$("a.admin").adminform();
		$('a.delete').confirm({
			msg:'',
			buttons:{ ok:"<img src='<?php echo $basePath ?>/images/confirm2.png'>", cancel:"<img src='<?php echo $basePath ?>/images/cancel2.png'>", separator:'', wrapper:'<a href="#" class="ask-del"></a>' }
		});
	});
	</script>
<?php endif ?>
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>
<body>
<?php call_user_func(reset($_l->blocks['admin']), $_l, get_defined_vars())  ?>

<div id="art-page-background-glare-wrapper">
    <div id="art-page-background-glare"></div>
</div>
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div class="art-header">
        <div class="art-header-position">
            <div class="art-header-wrapper">
                <div id="header">
		    <div class="header-left">
			<img src="<?php echo htmlSpecialChars($basePath) ?>/images/header-left.png" alt="Error" />
		    </div>
		    <div class="header-right">
			<img src="<?php echo htmlSpecialChars($basePath) ?>/images/header-right.png" alt="Error" />
		    </div>
                    <div class="scroll-container">
                    <ul>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($presentation) as $pic): ?>
						<li>
							<img src="<?php echo htmlSpecialChars($basePath) ?>/files/galery/<?php echo htmlSpecialChars($pic->name) ?>
" alt="Error" <?php if ($_l->tmp = array_filter(array($iterator->first?'first':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>/>
<?php if (!$iterator->last): ?>
							<img src="<?php echo htmlSpecialChars($basePath) ?>/images/line_header.png" style="width:1px; height:100%;" alt="Error" />
<?php endif ?>
						</li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
						                    </ul>
                    </div>
                </div>
                <div class="cleared reset-box"></div>
                <div class="art-header-inner">
                <div class="art-logo">
		    <h1 class="art-logo-name"><a href="<?php echo htmlSpecialChars($_control->link("About:")) ?>
">Jampl PSV</a></h1>
		    <h2 class="art-logo-text">pomocná stavební výroba</h2>
		</div>
                </div>
                <?php if ($admin): ?><div class="admin-tool admin-panel"><a href="<?php echo htmlSpecialChars($_control->link("Admin:")) ?>
">Administrace</a> / <a href="<?php echo htmlSpecialChars($_control->link("logout!")) ?>
">Odhlášení</a></div><?php endif ?>

            </div>
            
        </div>
        
    </div>
    <div class="cleared reset-box"></div>
<div class="art-bar art-nav">
<div class="art-nav-outer">
<div class="art-nav-wrapper">
<div class="art-nav-inner">
    <ul class="art-hmenu">
<?php $iterations = 0; foreach ($mainmenu as $name=>$link): ?>
        <li>
            <a href="<?php echo htmlSpecialChars($_control->link("{$link}")) ?>"<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent($link.'*') ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($name, ENT_NOQUOTES) ?></a>
<?php if (isset($submenu[$name])): ?>
            <ul>
<?php $iterations = 0; foreach ($submenu[$name] as $subname=>$sublink): ?>
                <li>
<?php if (strstr($sublink, '/')===false): ?>
                    <a href="<?php echo htmlSpecialChars($_control->link("{$link}{$sublink}")) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent($link.$sublink) ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($subname, ENT_NOQUOTES) ?></a>
<?php else: ?>
		    <a href="<?php echo htmlSpecialChars($sublink) ?>"<?php if ($_l->tmp = array_filter(array($presenter->isLinkCurrent($sublink) ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($subname, ENT_NOQUOTES) ?></a>
<?php endif ?>
                </li>
<?php $iterations++; endforeach ?>
            </ul>
<?php endif ?>
        </li>
<?php $iterations++; endforeach ?>
    </ul>
</div>
</div>
</div>
</div>

<div class="cleared reset-box"></div>

<div class="art-box art-sheet">
<div class="art-box-body art-sheet-body">
<div class="art-layout-wrapper">
    <div class="art-content-layout">
        <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1">
<?php call_user_func(reset($_l->blocks['left']), $_l, get_defined_vars()) ?>
                 
                				<div class="actual">
				<h2 class="art-postheader">Aktuálně</h2>
<?php $iterations = 0; foreach ($news as $new): ?>
				<div class="art-box art-block" style="overflow: auto;">
					<div class="art-bar art-blockheader">
						<a style="text-decoration: none;" href="<?php echo htmlSpecialChars($_control->link("News:show", array($new->id))) ?>
">
							<h3 class="t" style="color: #84A0A4;"><?php echo Nette\Templating\Helpers::escapeHtml($new->title, ENT_NOQUOTES) ?></h3>
						</a>
					</div>
					<div class="art-box-body art-blockcontent-body">
						<p><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($new->text, 50), ENT_NOQUOTES) ?></p>
						<span class="more" style="float: right;">
							<a href="<?php echo htmlSpecialChars($_control->link("News:show", array($new->id))) ?>
">Zobrazit více</a>
						</span>
					</div>
				</div>
<?php $iterations++; endforeach ?>
				</div>
                <div class="cleared"></div>
            </div>
                        <div class="art-layout-cell art-content">
                <div class="art-box art-post">
                <div class="art-post-inner art-article">
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="cleared" style="height: 70px;"></div>

    <div class="art-footer">
        <div class="art-footer-body">
            <div class="art-footer-center">
                <div class="art-footer-wrapper">
                    <div class="art-footer-text">
                        <a href="#" class="art-rss-tag-icon" title="RSS"></a>
                        <p><?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($mainmenu) as $name=>$link): ?>
<a href="<?php echo htmlSpecialChars($_control->link($link)) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($name, ENT_NOQUOTES) ?>
</a><?php if (!$iterator->last): ?> | <?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?></p>
                        <p>Copyright © 2012. All Rights Reserved.</p>
                        <div class="cleared"></div>
                        <p class="art-page-footer"><a href="http://www.wepla.cz" target="_blank">Webdesign</a> created by Wepla.</p>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
        </div>
    </div>
    <div class="cleared"></div>
    
</div>
</body>
</html>
