jQuery(document).ready(function($) {
	$( '.menu-toggle' ).on('click', function(event) {
		event.stopPropagation();
		$( 'body' ).toggleClass( 'show-menu' );
	});
	$( document ).on('click', function() {
		if ( event.target.id != 'site-navigation' ) {
			$( 'body' ).toggleClass( 'show-menu', false );	
		}
	});
});
