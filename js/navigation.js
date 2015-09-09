(function($) {
	$(function() {
		$( ".menu-toggle" ).click( function() {
			$( "body" ).toggleClass( "show-menu" );
		});
		$( ".site-header, .site-content" ).click( function() {
			$( "body" ).removeClass( "show-menu" );
		});
	});
})(jQuery);
