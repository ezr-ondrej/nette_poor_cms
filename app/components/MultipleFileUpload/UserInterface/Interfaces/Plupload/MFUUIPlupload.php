<?php

/**
 * Description of MFUUIPlupload
 *
 * @author Jan Kuchař
 */
class MFUUIPlupload extends MFUUIBase {

  /**
   * Is this upload your upload? (upload from this interface)
   */
  public function isThisYourUpload() {
    return (
      \Nette\Environment::getHttpRequest()->getHeader("X-Uploader") == "plupload"
    );
  }

  /**
   * Handles uploaded files
   * forwards it to model
   */
  public function handleUploads() {
    /* @var $token string */
    $token =\Nette\Environment::getHttpRequest()->getHeader("token");
    if (empty($token)) {
      return;
    }

    // HTTP headers for no cache etc
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    // Settings
    $queueModel = MultipleFileUpload::getQueuesModel() // returns: IMFUQueuesModel
      ->getQueue($token);
    $targetDir =  $queueModel->getUploadedFilesTemporaryPath();
    $cleanupTargetDir = false; // Remove old files
    $maxFileAge = 60 * 60; // Temp file age in seconds
    // 5 minutes execution time
    @set_time_limit(5 * 60);

    // Uncomment this one to fake upload time
    // usleep(5000);
    // Get parameters
    $chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
    $chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
    $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
    $fileNameOriginal = $fileName;
    $fileName = sha1($token.$chunks.$fileNameOriginal);
    $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

    // Clean the fileName for security reasons
    $fileName = preg_replace('/[^\w\._]+/', '', $fileName);

    // Make sure the fileName is unique but only if chunking is disabled
    if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
      $ext = strrpos($fileName, '.');
      $fileName_a = substr($fileName, 0, $ext);
      $fileName_b = substr($fileName, $ext);

      $count = 1;
      while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
        $count++;
      $fileName = $fileName_a . '_' . $count . $fileName_b;
	}

    // Create target dir
    if (!file_exists($targetDir))
      @mkdir($targetDir);

    // Remove old temp files
    if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
      while (($file = readdir($dir)) !== false) {
        $filePathTemp = $targetDir . DIRECTORY_SEPARATOR . $file;

        // Remove temp files if they are older than the max age
        if (preg_match('/\\.tmp$/', $file) && (filemtime($filePathTemp) < time() - $maxFileAge))
          @unlink($filePathTemp);
        }
        closedir($dir);
      }
      else
        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');

      // Look for the content type header
      if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
        $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

      if (isset($_SERVER["CONTENT_TYPE"]))
        $contentType = $_SERVER["CONTENT_TYPE"];

      // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
      if (strpos($contentType, "multipart") !== false) {
        if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
          $tmpPath = $filePath."-uploadTmp";
          move_uploaded_file($_FILES['file']['tmp_name'], $tmpPath); // Open base restriction bugfix
          // Open temp file
          $out = fopen($filePath, $chunk == 0 ? "wb" : "ab");
          if ($out) {
            // Read binary input stream and append it to temp file
            $in = fopen($tmpPath, "rb");

            if ($in) {
              while ($buff = fread($in, 4096))
              fwrite($out, $buff);
            }
            else
              die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            fclose($in);
            fclose($out);
            @unlink($tmpPath);
          }
          else
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }
        else
          die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
      }
      else {
        // Open temp file
        $out = fopen($filePath, $chunk == 0 ? "wb" : "ab");
        if ($out) {
          // Read binary input stream and append it to temp file
          $in = fopen("php://input", "rb");

          if ($in) {
            while ($buff = fread($in, 4096))
              fwrite($out, $buff);
          }
          else
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

          fclose($in);
          fclose($out);
        }
        else
          die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
      }

      if($chunk == 0) {
        $queueModel->addFileManually($fileName, 1, $chunks == 0 ? 1 : $chunks);
      }
      $file = null;
      if(($chunk+1) == $chunks || $chunks==0) {
        // Hotovo
        $file = new \Nette\Http\FileUpload(array(
          'name' => $fileNameOriginal,
          'type' => "",
          'size' => filesize($filePath),
          'tmp_name' => $filePath,
          'error' => UPLOAD_ERR_OK,
        ));
      }
      if($file OR $chunk>0) {
        $queueModel->updateFile($fileName, $chunk+1, $file);
      }

      // Return JSON-RPC response
      die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
  }

  function getHtmlIdFlashCompatible(MultipleFileUpload $upload) {
    return str_replace("-","_",$upload->getHtmlId() . "-box");
  }

  /**
   * Renders interface to <div>
   */
  public function render(MultipleFileUpload $upload) {
    $template = $this->createTemplate(dirname(__FILE__) . "/html.latte");
    $template->id = $this->getHtmlIdFlashCompatible($upload);
    return $template->__toString(TRUE);
  }

  /**
   * Renders JavaScript body of function.
   */
  public function renderInitJavaScript(MultipleFileUpload $upload) {
    $tpl = $this->createTemplate(dirname(__FILE__) . "/initJS.js");
    $tpl->token = $upload->getToken();
    $tpl->sizeLimit = $upload->maxFileSize;
    $tpl->maxFiles = $upload->maxFiles;
    $tpl->backLink = (string) $upload->form->action;
    $tpl->mfu = $upload;
    $tpl->id = $this->getHtmlIdFlashCompatible($upload);
    return $tpl->__toString(TRUE);
  }

  /**
   * Renders JavaScript body of function.
   */
  public function renderDestructJavaScript(MultipleFileUpload $upload) {
    return $this->createTemplate(dirname(__FILE__) . "/destructJS.js")->__toString(TRUE);
  }

  /**
   * Renders set-up tags to <head> attribute
   */
  public function renderHeadSection() {
    return $this->createTemplate(dirname(__FILE__) . "/head.latte")->__toString(TRUE);
  }
}