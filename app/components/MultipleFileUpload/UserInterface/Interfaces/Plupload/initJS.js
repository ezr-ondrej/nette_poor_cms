var fallbackController = this;
(function($){
	// API: http://www.plupload.com/plupload/docs/api/index.html

	// Convert divs to queue widgets when the DOM is ready
	$(function(){
		var uploader = $("#"+{!$id|escapeJs}).pluploadQueue({
			// General settings
			runtimes : 'gears,html5,browserplus,flash,silverlight,html4',
			url : {!$backLink|escapeJs},
			max_file_size : {!$sizeLimit},
			chunk_size : '1mb',
//            unique_names : true,
            multiple_queues:true,
                
			headers: {
				"X-Uploader": "plupload",
				"token"     : {!$token|escapeJs}
			},

			// Flash settings
			flash_swf_url : {!$baseModulePath|escapeJs}+'/swf/plupload/plupload.flash.swf',

			// Silverlight settings
			silverlight_xap_url : {!$baseModulePath|escapeJs}+'/xap/plupload/plupload.silverlight.xap',
            
            // PreInit events, bound before any internal events
            preinit : {
                Init: function(up, info) {
//                    log('[Init]', 'Info:', info, 'Features:', up.features);
                },
                // You can override settings before the file is uploaded
                UploadFile: function(up, file) {
                    // HTML4 Fallback, @see MFUUIHTML4SingleUpload::handleUploads for payload structure details
                    if (up.runtime === 'html4') {
                        up.settings.file_data_name = "{$mfu->htmlName}[files][]";
                        up.settings.multipart_params = { 
                            "{$mfu->htmlName}[token]": {!$token|escapeJs},
                        };
                    }
                }
            }
		});
        
		uploader.bind('Error', function(up, args){
			fallbackController.fallback();
		})
	});

	return true; // OK

})(jQuery);