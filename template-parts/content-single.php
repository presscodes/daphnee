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
	Daphnee()->template->content_header( 'singular', get_post_type() );
	?>
	<div class="entry-content">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->template->content_main( 'singular', get_post_type() );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->template->content_main( 'singular', get_post_type() );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
