<?php
/**
 * Template part for displaying posts.
 *
 * @package Daphnee
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * The entry header
	 */
	Daphnee()->load_template_partial( 'content_header_archive' );
	?>

	<div class="entry-content">
	<?php
	/**
	 * The entry content
	 */
	Daphnee()->load_template_partial( 'content_main_archive' );
	?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->load_template_partial( 'content_footer_archive' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
