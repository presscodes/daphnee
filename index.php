<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Daphnee
 */

get_header(); ?>

	<?php tha_content_before(); ?>
	<div id="primary" class="content-area <?php echo Daphnee()->layout->main_content_columns(); ?>">
		<?php tha_content_top(); ?>
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php tha_content_while_before(); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

			<?php tha_content_while_after(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

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
