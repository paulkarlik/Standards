var Lightbox = {
	init : function() {
		$('a.lightbox').click(function(e) {
			// hide scrollbars!
			$('body').css('overflow-y', 'hidden');
			
			$('<div id="overlay"></div>')
				.css('top', $(document).scrollTop())
				.css('opacity', '0')
				.animate({'opacity': '0.5'}, 'slow')
				.appendTo('body');
			$('<div id="lightbox"></div>')
				.hide()
				.appendTo('body');
			$('<img />', {
					src: $(this).attr('href'),
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
		var top = ($(window).height() - $('#lightbox').height()) / 2;
	  var left = ($(window).width() - $('#lightbox').width()) / 2;
	  $('#lightbox')
	    .css({
	      'top': top + $(document).scrollTop(),
	      'left': left
	    })
	    .fadeIn();
	},
	
	removeLightbox : function () {
		$('#overlay, #lightbox')
	    .fadeOut('slow', function() {
	      $(this).remove();
	      $('body').css('overflow-y', 'auto'); // show scrollbars!
	    });
	}
};