<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Daphnee
 */

?><!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<?php
/**
 * The <head>
 */
Daphnee()->load_template_partial( 'head' );
?>

<body <?php body_class(); ?>>
<?php tha_body_top(); ?>
<div id="page" class="hfeed site wrapper">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'daphnee' ); ?></a>
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">
		<a href="#" id="trigger" class="menu-trigger" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'daphnee' ); ?></a>

		<?php
		/**
		 * The main navigation
		 */
		Daphnee()->load_template_partial( 'navigation' );
		?>

		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
		<?php
		/**
		 * The global site header
		 */
		Daphnee()->load_template_partial( 'header' );
		?>

		<div id="content" class="site-content row">
