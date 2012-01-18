<?php

$paths = array(
    "../../..",
    "../../../..",
    "../../../../..",
    "../../../../../..",
    "../../../../../../..",
    "../../../../../../../..",
    "../../../../../../../../..",
    "../../../../../../../../../..",
    "../../../../../../../../../../..",
    "../../../../../../../../../../../..",
    "../../../../../../../../../../../../.."
);

/* include wordpress, make sure its available in one of the higher folders */
foreach( $paths as $path ) {
   if( @include_once( $path . '/wp-load.php' ) ) break;
}

$pattern = get_theme_mod( 'background_pattern' );
$patternpage = get_theme_mod( 'background_pattern_page' );

?><!DOCTYPE html>
<html>
<head>
<style>
#patterns {
	overflow: hidden;
}
.patternpreview {
	width: 290px; height: 145px;
	float: left;
	margin: 10px 20px 10px 0;
	cursor: pointer;
}
.selected {
	outline: 5px solid rgb(0,200,255);
}
#pagination {
	overflow: hidden;
}
.pagination {
	display: block;
	float: left;
	padding: 3px 7px;
	border: 1px solid rgb(0,200,255);
	text-decoration: none;
	margin-right: 5px;
}
.pagination.current {
	background: rgb(0,200,255);
	color: #fff !IMPORTANT;
	text-decoration: none;
}
</style>
</head>
<body>
	<div id="select-pattern">
		<form action="options.php" method="post" id="patterns-form">
			<div id="patterns">
			</div>
			<div id="pagination" class="submit">
			<?php if ( !( $patterns_count = wp_cache_get( 'patterns_count' ) ) ) {
				$patterns_count = file_get_contents( 'http://weber.ir/patterns/count.php' ) / 10;
				wp_cache_set( 'patterns_count', $patterns_count, false, 1800 );
			}
			for( $i = 1; $i <= $patterns_count; $i++ ) {
				echo "<a class='pagination' href='#' data-page='{$i}'>{$i}</a>";
			}
			?>
			</div>
			<!--<input type="hidden" name="pattern" id="pattern" value="<?php echo $pattern ?>" />
			<input type="hidden" name="patternpage" id="patternpage" value="<?php echo $patternpage ?>" />-->
			<div class="description" style="color: #777; font-size: 11px;">
				Patterns provided by: <a href="http://subtlepatterns.com/">Subtle Patterns</a>
			</div>
			<p class="submit">
				<input type="button" class="button-secondary" value="<?php _e('Cancel') ?>" id="patterns-cancel" />
				<input type="button" class="button-primary" value="<?php _e('Save Settings') ?>" id="patterns-save" />
			</p>
		</form>
	</div>
<script>
jQuery(function($){
	var selected_pattern = '',
		selected_page = '';

	function list_patterns( page ) {
		$.ajax({
			url: '<?php echo plugins_url( 'cross-xhr.php', __FILE__ ) ?>',
			data: { page: page, pattern: 'true' },
			type: 'POST',
			success: function(data){
				var data = $.parseJSON( data ),
					output = '';
				$.each( data, function( i, value ){
					output += '<div class="patternpreview" style="background-image: url(<?php echo PATTERNS_BASE_URI ?>'+ value +')" data-url="'+ value +'" />';
				});
				$('#patterns').html(output);
				$('#patterns div').each(function(){
					if( $(this).data('url') == '<?php echo $pattern ?>' )
						$(this).click();
				});
			}
		});
	}
	var currentPage = <?php echo ( ! empty( $patternpage ) ) ? $patternpage : 1 ?>;

	$('.pagination').live('click', function(){
		list_patterns( $(this).data('page') );
		$('a.pagination').removeClass('current');
		$(this).addClass('current');
		return false;
	}).eq(currentPage - 1).click();

	$('.patternpreview').live('click', function(){
		$('div.patternpreview').removeClass('selected');
		$(this).addClass('selected');
		selected_pattern = $(this).data('url');
		selected_page = $('.current', '#pagination').data('page');
	});

	$('#patterns-save').click(function(){

		$('#background_pattern').val( selected_pattern );
		$('#background_image').val( bg_patterns_base_url + selected_pattern );
		$('#background_pattern_page').val( selected_page );
		$('#background_pattern_updated').val(1); // activate save_options

		// pattern preview
		$('#custom-background-image').css({
			'background-image': 'url('+ bg_patterns_base_url + selected_pattern + ')',
			'background-repeat': 'repeat',
			'background-position': 'top left'
		});

		sliderOptions_hideDialog();
	});
	$('#patterns-cancel').click(function(){
		sliderOptions_hideDialog();
	});
	function sliderOptions_hideDialog() {
		$('#select-pattern').remove();
		tb_remove();
	}
});
</script>
</body>
</html>