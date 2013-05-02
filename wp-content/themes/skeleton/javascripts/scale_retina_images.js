(function($){
	$('.makeretina').on('click touch',function(){
		if ($(this).width() !== 320) {
			$(this).animate({'width':'320px'});
		} else {
			$(this).animate({'width':'640px'});
		}

	});
})(jQuery);
