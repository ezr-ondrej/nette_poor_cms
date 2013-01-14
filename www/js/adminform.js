/**
 * jQuery adminform plugin
 * @name adminform.css
 * @author Ondřej Ezr
 * @version 0.1
 * @date September 9, 2012
 * @category jQuery plugin
 * @copyright (c) 2012 Ondřej Ezr (grafar.com)
 */
(function($) {
  $.fn.adminform = function( method ) {
    
  var methods = {
    show : function( ) {
      _set_interface();
    },
    hide : function( ) { 
      _finish();
    }
  };
    
    // Method calling logic
    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    }
    
    function _initialize() {
      _start(this); // This, in this context, refer to object (link) which the user have clicked
      return false; // Avoid the browser following the link
    }
    
    function _start(objClicked) {
			// Hime some elements to avoid conflict with overlay in IE. These elements appear above the overlay.
			$('embed, object').css({ 'visibility' : 'hidden' });
			
      // Call the function to create the markup structure; style some elements; assign events in some elements.
			_set_interface();
		}
		
		function _set_interface() {
			// Get page sizes
			var arrPageSizes = ___getPageSize();
			// Style overlay and show it
			$('#admin-overlay').css({
                                visibility:			'visible',
				width:				arrPageSizes[0],
				height:				arrPageSizes[1]
			}).fadeIn();
			// Get page scroll
			var arrPageScroll = ___getPageScroll();
			// Calculate top and left offset for the jquery-lightbox div object and show it
			$('#admin-box').css({
                            	visibility:			'visible',
				top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
				left:	arrPageScroll[0]
			}).show();
			// Assigning click events in elements to close overlay
			$('#admin-overlay').click(function() {
				_finish();									
			});
			// Assign the _finish function to lightbox-loading-link and lightbox-secNav-btnClose objects
			$('#admin-loading-link,#admin-btnClose').click(function() {
				_finish();
				return false;
			});
			// If window was resized, calculate the new overlay dimensions
			$(window).resize(function() {
				// Get page sizes
				var arrPageSizes = ___getPageSize();
				// Style overlay and show it
				$('#admin-overlay').css({
					width:		arrPageSizes[0],
					height:		arrPageSizes[1]
				});
				// Get page scroll
				var arrPageScroll = ___getPageScroll();
				// Calculate top and left offset for the jquery-lightbox div object and show it
				$('#admin-box').css({
					top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
					left:	arrPageScroll[0]
				});
			});
		}
		
		/**
		 * Remove jQuery lightBox plugin HTML markup
		 *
		 */
		function _finish() {
		  $('#admin-overlay').fadeOut();
			$('#admin-box,#admin-overlay').fadeOut( function() {$('#admin-box,#admin-overlay').css({ 'visibility' : 'hidden' }) });
			// Show some elements to avoid conflict with overlay in IE. These elements appear above the overlay.
			$('embed, object').css({ 'visibility' : 'visible' });
		}
        
                /**
		 / THIRD FUNCTION
		 * getPageSize() by quirksmode.com
		 *
		 * @return Array Return an array with page width, height and window width, height
		 */
		function ___getPageSize() {
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {	
				xScroll = window.innerWidth + window.scrollMaxX;
				yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
				xScroll = document.body.scrollWidth;
				yScroll = document.body.scrollHeight;
			} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
				xScroll = document.body.offsetWidth;
				yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) {	// all except Explorer
				if(document.documentElement.clientWidth){
					windowWidth = document.documentElement.clientWidth; 
				} else {
					windowWidth = self.innerWidth;
				}
				windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
				windowWidth = document.documentElement.clientWidth;
				windowHeight = document.documentElement.clientHeight;
			} else if (document.body) { // other Explorers
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}	
			// for small pages with total height less then height of the viewport
			if(yScroll < windowHeight){
				pageHeight = windowHeight;
			} else { 
				pageHeight = yScroll;
			}
			// for small pages with total width less then width of the viewport
			if(xScroll < windowWidth){	
				pageWidth = xScroll;		
			} else {
				pageWidth = windowWidth;
			}
			arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
			return arrayPageSize;
		};
		/**
		 / THIRD FUNCTION
		 * getPageScroll() by quirksmode.com
		 *
		 * @return Array Return an array with x,y page scroll values.
		 */
		function ___getPageScroll() {
			var xScroll, yScroll;
			if (self.pageYOffset) {
				yScroll = self.pageYOffset;
				xScroll = self.pageXOffset;
			} else if (document.documentElement && document.documentElement.scrollTop) {	 // Explorer 6 Strict
				yScroll = document.documentElement.scrollTop;
				xScroll = document.documentElement.scrollLeft;
			} else if (document.body) {// all other Explorers
				yScroll = document.body.scrollTop;
				xScroll = document.body.scrollLeft;	
			}
			arrayPageScroll = new Array(xScroll,yScroll);
			return arrayPageScroll;
		};
    return this.unbind('click').click(_initialize);
  };
})(jQuery);