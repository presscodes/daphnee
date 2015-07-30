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
	Daphnee()->load_template_partial( 'content-header-singular-post' );
	?>
	<div class="entry-content">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->load_template_partial( 'content-main-singular-page' );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->load_template_partial( 'content-footer-singular-page' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
