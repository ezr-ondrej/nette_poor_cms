<?php //netteCache[01]000403a:2:{s:4:"time";s:21:"0.06016700 1349854872";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:81:"/C/Program Files/xampp/htdocs/jampl/app/components/VisualPaginator/template.latte";i:2;i:1247518728;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /C/Program Files/xampp/htdocs/jampl/app/components/VisualPaginator/template.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'xbltepbvv9')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($paginator->pageCount > 1): ?>
<div class="paginator">
<?php if ($paginator->isFirst()): ?>
	<span class="button">« Previous</span>
<?php else: ?>
	<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $paginator->page - 1))) ?>">« Previous</a>
<?php endif ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($steps) as $step): if ($step == $paginator->page): ?>
		<span class="current"><?php echo Nette\Templating\Helpers::escapeHtml($step, ENT_NOQUOTES) ?></span>
<?php else: ?>
		<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $step))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($step, ENT_NOQUOTES) ?></a>
<?php endif ?>
	<?php if ($iterator->nextValue > $step + 1): ?><span>…</span><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

<?php if ($paginator->isLast()): ?>
	<span class="button">Next »</span>
<?php else: ?>
	<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $paginator->page + 1))) ?>">Next »</a>
<?php endif ?>
</div>
<?php endif ;