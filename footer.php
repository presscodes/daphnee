<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Daphnee
 */

?>

	</div><!-- #content -->
	<?php
	/**
	 * The footer
	 */
	Daphnee()->load_template_partial( 'footer' );
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
