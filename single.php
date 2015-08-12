<?php
/**
 * The template for displaying all single posts.
 *
 * @package Daphnee
 */

get_header(); ?>

	<?php tha_content_before(); ?>
	<div id="primary" class="content-area <?php echo Daphnee()->layout->main_content_columns(); ?>">
		<?php tha_content_top(); ?>
		<main id="main" class="site-main" role="main">

		<?php tha_content_while_before(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		<?php tha_content_while_after(); ?>

		</main><!-- #main -->
		<?php tha_content_bottom(); ?>
	</div><!-- #primary -->
	<?php tha_content_after(); ?>

<?php tha_sidebars_before(); ?>
<?php get_sidebar(); ?>
<?php tha_sidebars_after(); ?>
<?php tha_footer_before(); ?>
<?php get_footer(); ?>
<?php tha_footer_after(); ?>
