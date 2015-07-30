<header id="masthead" class="site-header" role="banner">
    <div class="site-branding">
        <?php if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php else : ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php endif; ?>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
    </div><!-- .site-branding -->
    <?php
    /**
     * The main navigation
     */
    Daphnee()->load_template_partial( 'navigation' );
    ?>
</header><!-- #masthead -->
