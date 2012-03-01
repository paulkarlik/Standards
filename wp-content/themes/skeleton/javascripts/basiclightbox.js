var Lightbox = {
	init : function() {
		jQuery('a.lightbox').click(function(e) {
			// hide scrollbars!
			jQuery('body').css('overflow-y', 'hidden');
			
			jQuery('<div id="overlay"></div>')
				.css('top', jQuery(document).scrollTop())
				.css('opacity', '0')
				.animate({'opacity': '0.5'}, 'slow')
				.appendTo('body');
			jQuery('<div id="lightbox"></div>')
				.hide()
				.appendTo('body');
			jQuery('<img />', {
					src: jQuery(this).attr('href'),
					load: function() {
					Lightbox.positionLightboxImage();
				},
					click: function() {
					Lightbox.removeLightbox();
				}
			}).appendTo('#lightbox');
		
			return false;
		});
	},
	
	positionLightboxImage : function() {
		var top = (jQuery(window).height() - jQuery('#lightbox').height()) / 2;
	  var left = (jQuery(window).width() - jQuery('#lightbox').width()) / 2;
	  jQuery('#lightbox')
	    .css({
	      'top': top + jQuery(document).scrollTop(),
	      'left': left
	    })
	    .fadeIn();
	},
	
	removeLightbox : function () {
		jQuery('#overlay, #lightbox')
	    .fadeOut('slow', function() {
	      jQuery(this).remove();
	      jQuery('body').css('overflow-y', 'auto'); // show scrollbars!
	    });
	}
};

Lightbox.init();