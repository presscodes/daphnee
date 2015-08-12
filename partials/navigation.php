<nav id="site-navigation" class="main-navigation mp-menu" role="navigation">
  <?php wp_nav_menu( array( 
  	'theme_location'  => 'primary', 
  	'menu_id'         => 'primary-menu', 
  	'container'       => 'div',
		'container_class' => 'mp-level', 
		'walker'          => new MultiLevel_Push_Menu_Walker
	) ); ?>
</nav><!-- #site-navigation -->
