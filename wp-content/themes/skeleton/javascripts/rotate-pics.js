var rotatePics = {
	delay: 4000,
	init: function(currentPhoto) {
		var numberOfPhotos = $('#photos img').length;
	  currentPhoto = currentPhoto % numberOfPhotos;
		
	  $('#photos img').eq(currentPhoto).fadeOut(function() {
			// re-order the z-index
	    $('#photos img').each(function(i) {
	      $(this).css(
	        'zIndex', ((numberOfPhotos - i) + currentPhoto) % numberOfPhotos
	      );
	    });
	    $(this).show();
	    setTimeout(function() {rotatePics.init(++currentPhoto);}, rotatePics.delay);
	  });
	}
};

rotatePics.init(1);