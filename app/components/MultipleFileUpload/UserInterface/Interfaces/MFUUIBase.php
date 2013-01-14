<?php

/**
 * Description of MFUUIBase
 *
 * @author Honza
 */
abstract class MFUUIBase extends Nette\Object implements MFUUIInterface {

  /**
   * Process single file
   * @param string $token
   * @param HttpUploadedFile $file
   * @return bool
   */
  function processFile($token, $file) {
    // Why not in one condition?
    // @see http://forum.nettephp.com/cs/viewtopic.php?pid=29556#p29556
    if (!$file instanceof Nette\Http\FileUpload) {
      return false;
    }

    /* @var $validateCallback Callback */
    $validateCallback = MultipleFileUpload::$validateFileCallback;

    /* @var $isValid bool */
    $isValid = $validateCallback->invoke($file);

    if ($isValid) {
      MultipleFileUpload::getQueuesModel() // returns: IMFUQueuesModel
        ->getQueue($token) // returns: IMFUQueueModel
        ->addFile($file);
    }
    return $isValid;
  }

  /**
   * @return ITemplate
   */
  protected function createTemplate($file = null) {
    $template = new Nette\Templating\FileTemplate($file);
    //$presenter = Environment::getApplication()->getPresenter();
    $template->onPrepareFilters[] = array($this, 'templatePrepareFilters');

    // default parameters
    //$template->control = $this;
    //$template->presenter = $presenter;
    $template->baseUrl = \Nette\Environment::getHttpRequest()->url->baseUrl;
    $template->basePath = rtrim($template->baseUrl, '/');
    $template->baseModulePath = $template->basePath . '/modules/multipleFileUpload';

    // flash message
    /*if ($presenter !== NULL && $presenter->hasFlashSession()) {
      $id = $this->getParamId('flash');
      $template->flashes = $presenter->getFlashSession()->$id;
    }
    if (!isset($template->flashes) || !is_array($template->flashes)) {
      $template->flashes = array();
    }*/

    $template->registerHelperLoader('Nette\Templating\Helpers::loader');

    return $template;
  }

  /**
   * Descendant can override this method to customize template compile-time filters.
   * @param  Template
   * @return void
   */
  public function templatePrepareFilters($template) {
    // default filters
    $template->registerFilter(new \Nette\Latte\Engine());
  }
}