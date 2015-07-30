<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Daphnee
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php
/**
 * The sidebar
 */
Daphnee()->template->sidebar();
