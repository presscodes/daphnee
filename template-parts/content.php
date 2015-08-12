<?php
/**
 * Template part for displaying posts.
 *
 * @package Daphnee
 */

?>
<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php tha_entry_top(); ?>
	<?php
	/**
	 * The entry header
	 */
	Daphnee()->load_template_partial( 'content-header-archive' );
	?>

	<div class="entry-content">
	<?php tha_entry_content_before(); ?>
	<?php
	/**
	 * The entry content
	 */
	Daphnee()->load_template_partial( 'content-main-archive' );
	?>
	<?php tha_entry_content_after(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->load_template_partial( 'content-footer-archive' );
		?>
	</footer><!-- .entry-footer -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>