<?php
/**
 * The template used for displaying page content in page.php
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
	Daphnee()->load_template_partial( 'content-header-singular-page' );
	?>

	<div class="entry-content">
	  <?php tha_entry_content_before(); ?>
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->load_template_partial( 'content-main-singular-page' );
		?>
		<?php tha_entry_content_after(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/**
		 * The entry footer
		 */
		Daphnee()->load_template_partial( 'content-footer-singular-page' );
		?>
	</footer><!-- .entry-footer -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
