<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Daphnee
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * The entry header
	 */
	Daphnee()->load_template_partial( 'content-header-archive' );
	?>

	<div class="entry-summary">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->load_template_partial( 'content-main-archive' );
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->load_template_partial( 'content-footer-archive' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
