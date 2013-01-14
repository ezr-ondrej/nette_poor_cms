(function($){

    var settings = {
        flash_url : {!=\Nette\Environment::expand("{$baseModulePath}/swf/swfupload/swfupload.swf")|escapeJS},
        flash9_url : {!=\Nette\Environment::expand("{$baseModulePath}/swf/swfupload/swfupload_fp9.swf")|escapeJS},
        upload_url: {!$backLink|escapeJS},
        post_params: {
            token : {!$token|escapeJS},
            sender: "MFU-Swfupload"
        },

        file_size_limit : {!$sizeLimit|escapeJS},
        file_types : "*.*",
        file_types_description : "All Files",
        file_upload_limit : {!$maxFiles|escapeJS},

        custom_settings : {
                progressTarget : "{!$swfuId}progress",
                cancelButtonId : "{!$swfuId}btnCancel"
        },
        debug: true,

        // Button settings
        button_image_url: {!=\Nette\Environment::expand("{$baseModulePath}/images/swfupload/XPButtonUploadText_89x88.png")|escapeJS},
        button_width: "89",
        button_height: "22",
        button_placeholder_id : "{!$swfuId}placeHolder",

        // The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete	// Queue plugin event
    };

//    $("#{!$swfuId}").swfupload(settings);
    var swfu = new SWFUpload(settings);

    return true;

})(jQuery);