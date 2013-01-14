<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.35025700 1350339509";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"/C/Program Files/xampp/htdocs/jampl/app/components/Page/page.latte";i:2;i:1350339507;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/components/Page/page.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '4txlvsodkr')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<h2 class="art-postheader"><?php echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?></h2>

<?php if ($admin): ?>
<div class="admin-tool">
<a class="edit" href="<?php echo htmlSpecialChars($_control->link("edit!")) ?>"><img src="<?php echo htmlSpecialChars($basePath) ?>/images/buttons/edit.png" /></a>
</div>
<?php endif ?>

<div class="art-post-body">
<?php echo $content ?>

</div>

<?php if ($admin): ?>
<div style="visibility:hidden;">
<div class="admin-form-div">
<?php $_ctrl = $_control->getComponent("adminForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>
</div>
<script>
$(document).ready(function() {
	$("body").append($(".admin-form-div"));
	
	$(".mceEditor").tinymce({
		// Location of TinyMCE script
		script_url : '<?php echo $basePath ?>/js/tiny_mce/tiny_mce.js',

		// General options
		theme : "advanced"

	});
});
</script>
<style>
	#admin-data-box {
		width: 750px;
	}
</style>
<?php endif ;