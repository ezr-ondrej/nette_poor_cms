<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.99934900 1349854871";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"/C/Program Files/xampp/htdocs/jampl/app/templates/Reference/default.latte";i:2;i:1349789057;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/templates/Reference/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'gj0ildan1e')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block left
//
if (!function_exists($_l->blocks['left'][] = '_lbbaedec2e21_left')) { function _lbbaedec2e21_left($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Zobrazit</h2>
<div class="content-box">
<ul class="art-vmenu">
    <li>
        <a href="<?php echo htmlSpecialChars($_presenter->link('this', array(null))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>Vše</a>
    </li>
<?php $iterations = 0; foreach ($reference_years as $year=>$link): ?>
    <li>
        <a href="<?php echo htmlSpecialChars($_presenter->link('this', array($year))) ?>
"<?php if ($_l->tmp = array_filter(array($presenter->linkCurrent ? 'active':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php echo Nette\Templating\Helpers::escapeHtml($year, ENT_NOQUOTES) ?></a>
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
if (!function_exists($_l->blocks['content'][] = '_lb5eb72d9849_content')) { function _lb5eb72d9849_content($_l, $_args) { extract($_args)
?><h2 class="art-postheader">Reference</h2>
<div class="art-post-body">
    <div class="reference-top">
        <div class="art-bar art-blockheader">
            <h3 class="t"><?php echo Nette\Templating\Helpers::escapeHtml($active_year, ENT_NOQUOTES) ?></h3>
        </div>
        
        <div class="admin-tool">
        <?php if ($admin): ?><a href="#" class="admin" title="Přidat referenci"><img src="<?php echo htmlSpecialChars($basePath) ?>
/images/buttons/add.png" /></a><?php endif ?>

        </div>
    </div>
    <div class="art-content-layout aktuality">
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$iterations = 0; foreach ($reference as $ref): ?>
    <div class="reference art-content-layout-row">
        <div class="art-layout-cell layout-item-0" style="width: 100%;">
<?php if ($admin): ?>
            <div class="admin-tool">
                <a class="edit" href="<?php echo htmlSpecialChars($_control->link("edit!", array($ref->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/edit.png" /></a>
                <a class="delete" href="<?php echo htmlSpecialChars($_control->link("delete!", array($ref->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/del.png" /></a>
            </div>
<?php endif ?>
            
            <a href="<?php echo htmlSpecialChars($_control->link("show", array($ref->id))) ?>
"><h3><?php echo Nette\Templating\Helpers::escapeHtml($ref->title, ENT_NOQUOTES) ?></h3></a>
            <blockquote style="margin: 10px 0">
                <a href="<?php echo htmlSpecialChars($basePath) ?>/files/<?php echo htmlSpecialChars($ref->foto) ?>
" class="galery-<?php echo htmlSpecialChars($ref->id) ?>">
                <img src="<?php echo htmlSpecialChars($basePath) ?>/files/thumb_<?php echo htmlSpecialChars($ref->foto) ?>" class="preview" />
                </a>
<?php if ($ref->galery_album_id): $iterations = 0; foreach ($ref->galery_album->related('galery') as $galery): ?>
                    <a href="<?php echo htmlSpecialChars($basePath) ?>/files/galery/<?php echo htmlSpecialChars($galery->name) ?>
" class="galery-<?php echo htmlSpecialChars($ref->id) ?>"></a>
<?php $iterations++; endforeach ;endif ?>
                <p><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($ref->text, 300), ENT_NOQUOTES) ?></p>
            </blockquote>
        </div>
    </div>

        <script>
    $(function() {
        $('a.galery-<?php echo Nette\Templating\Helpers::escapeJs($ref->id) ?>').lightBox({
            imageLoading: '<?php echo $basePath ?>/images/galery/lightbox-ico-loading.gif',
            imageBtnClose: '<?php echo $basePath ?>/images/galery/lightbox-btn-close.gif',
            imageBtnPrev: '<?php echo $basePath ?>/images/galery/lightbox-btn-prev.gif',
            imageBtnNext: '<?php echo $basePath ?>/images/galery/lightbox-btn-next.gif'
        });
    });
    </script>
<?php $iterations++; endforeach ?>
    </div>
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>

<script>
$(document).ready(function () {
    $("input.date").each(function () { // input[type=date] does not work in IE
        var el = $(this);
        var value = el.val();
        var date = (value ? $.datepicker.parseDate($.datepicker.W3C, value) : null);

        var minDate = el.attr("min") || null;
        if (minDate) minDate = $.datepicker.parseDate($.datepicker.W3C, minDate);
        var maxDate = el.attr("max") || null;
        if (maxDate) maxDate = $.datepicker.parseDate($.datepicker.W3C, maxDate);

        // input.attr("type", "text") throws exception
        if (el.attr("type") == "date") {
            var tmp = $("<input/>");
            $.each("class,disabled,id,maxlength,name,readonly,required,size,style,tabindex,title,value".split(","), function(i, attr)  {
                tmp.attr(attr, el.attr(attr));
            });
            el.replaceWith(tmp);
            el = tmp;
        }
        el.datepicker({
            minDate: minDate,
            maxDate: maxDate
        });
        el.val($.datepicker.formatDate(el.datepicker("option", "dateFormat"), date));
    });
    $("input.date.showyear")
        .datepicker("option", "changeMonth", true)
        .datepicker("option", "changeYear", true);
});
</script>

<?php
}}

//
// block admin
//
if (!function_exists($_l->blocks['admin'][] = '_lbe0e621bd7c_admin')) { function _lbe0e621bd7c_admin($_l, $_args) { extract($_args)
;if ($admin): $_ctrl = $_control->getComponent("adminForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb99972d4756_head')) { function _lb99972d4756_head($_l, $_args) { extract($_args)
?><link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/paginator.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/jquery.lightbox-0.5.css" media="screen" />

<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.lightbox-0.5.js"></script>

<style>
    .admin-tool { float: right; }
    .admin-tool img { width: 40px; height: 40px; }
    .reference-top { overflow: auto; }
    .reference-top {
        text-align: center;
        margin: 5px;
        color: #1B47AF;
        font-size: 20px;
        font-weight: bold;
    }
    .reference {
        padding-top: 20px;
    }
    .reference blockquote {
        overflow: auto;
        padding-left: 10px;
        background-image: none;
    }
    .reference h3 {
        color: #1D319F;
    }
    .reference a {
        text-decoration: none;
    }
    .reference a:hover h3,
    .reference a:active h3{
        text-decoration: underline;
    }
    img.preview {
        width: 80px;
        height: 80px;
        float: left;
        margin-right: 10px;
    }
</style>
<script>
/* Czech initialisation for the jQuery UI date picker plugin. */
/* Written by Tomas Muller (tomas@tomas-muller.net). */
jQuery(function($) {
    $.datepicker.regional['cs'] = {
        closeText: 'Zavřít',
        prevText: '&#x3c;Dříve',
        nextText: 'Později&#x3e;',
        currentText: 'Nyní',
        monthNames: ['leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen',
            'září', 'říjen', 'listopad', 'prosinec'],
        monthNamesShort: ['led', 'úno', 'bře', 'dub', 'kvě', 'čer', 'čvc', 'srp', 'zář', 'říj', 'lis', 'pro'],
        dayNames: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
        dayNamesShort: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
        dayNamesMin: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
        weekHeader: 'Týd',
        dateFormat: 'dd. mm. yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['cs']);
});
</script>
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