<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Daphnee
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
/**
 * The <head>
 */
Daphnee()->load_template_partial( 'head' );
?>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site wrapper">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'daphnee' ); ?></a>

	<?php
	/**
	 * The global site header
	 */
	Daphnee()->load_template_partial( 'header' );
	?>

	<div id="content" class="site-content row">
