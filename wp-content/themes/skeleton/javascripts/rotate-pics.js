var rotatePics = {
	delay: 4000,
	init: function(currentPhoto) {
		var numberOfPhotos = jQuery('#photos img').length;
	  currentPhoto = currentPhoto % numberOfPhotos;
		
	  jQuery('#photos img').eq(currentPhoto).fadeOut(function() {
			// re-order the z-index
	    jQuery('#photos img').each(function(i) {
	      jQuery(this).css(
	        'zIndex', ((numberOfPhotos - i) + currentPhoto) % numberOfPhotos
	      );
	    });
	    jQuery(this).show();
	    setTimeout(function() {rotatePics.init(++currentPhoto);}, rotatePics.delay);
	  });
	}
};

rotatePics.init(1);