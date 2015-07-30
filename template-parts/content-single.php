<?php
/**
 * Template part for displaying single posts.
 *
 * @package Daphnee
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * The entry header
	 */
	Daphnee()->load_template_partial( 'content_header_singular_post' );
	?>
	<div class="entry-content">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->load_template_partial( 'content_main_singular_post' );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->load_template_partial( 'content_footer_singular_post' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
