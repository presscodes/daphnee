<?php
// Wrapper for Multi Level Submenu
class MultiLevel_Push_Menu_Walker extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array() ) {
  	$output .= "\n$indent<div class='mp-level'><ul class='sub-menu'>\n";
  }
  function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "</ul></div>\n";
  }
}