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
	Daphnee()->template->content_header( 'archive', get_post_type() );
	?>

	<div class="entry-summary">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->template->content_main( 'archive', get_post_type() );
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->template->content_main( 'archive', get_post_type() );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
