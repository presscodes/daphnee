<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Daphnee
 */

?>
<?php tha_entry_before(); ?>
<section class="no-results not-found">
	<?php tha_entry_top(); ?>
	<?php
	/**
	 * The entry header
	 */
	Daphnee()->load_template_partial( 'content-header-404' );
	?>
	<div class="page-content">
		<?php tha_entry_content_before(); ?>
		<?php
		/**
		 * The entry content
		 */
		Daphnee()->load_template_partial( 'content-main-404' );
		?>
		<?php tha_entry_content_after(); ?>
	</div><!-- .page-content -->
	<?php tha_entry_bottom(); ?>
</section><!-- .no-results -->
<?php tha_entry_after(); ?>
