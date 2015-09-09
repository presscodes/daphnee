<a class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" href="#">
    <span class="dashicons dashicons-menu"></span>
    <span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'daphnee' ); ?></span>
</a>
<nav id="site-navigation" class="main-navigation col_9" role="navigation">
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
</nav><!-- #site-navigation -->
