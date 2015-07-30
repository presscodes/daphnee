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
	Daphnee()->load_template_partial( 'content-header-404' );
	?>
	<div class="page-content">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->load_template_partial( 'content-main-404' );
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
