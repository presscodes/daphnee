<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Daphnee
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * The entry header
	 */
	Daphnee()->template->content_header( 'singular', 'page' );
	?>

	<div class="entry-content">
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->template->content_main( 'singular', 'page' );
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
