<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Daphnee
 */

?>

<section class="no-results not-found">

	<?php
	/**
	 * The entry header
	 */
	Daphnee()->template->content_header( '404' );
	?>
	<div class="page-content">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->template->content_main( '404' );
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
