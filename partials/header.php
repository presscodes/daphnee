<?php tha_header_before(); ?>
<header id="masthead" class="site-header" role="banner"<?php echo ( get_header_image() ) ? ' style="background-image:url(' . esc_url( get_header_image() ) . ');"' : ''; ?>>
    <?php tha_header_top(); ?>
    <div class="row">
        <div class="site-branding">
            <?php if ( function_exists( 'jetpack_the_site_logo' ) && !jetpack_has_site_logo() ) { ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            <?php } elseif ( function_exists( 'jetpack_the_site_logo' ) && jetpack_has_site_logo() ) { ?>
            <?php jetpack_the_site_logo(); } ?>
        </div><!-- .site-branding -->
        <?php
        /**
         * The main navigation
         */
        Daphnee()->load_template_partial( 'navigation' );
        ?>
    </div>
    <?php tha_header_bottom(); ?>
</header><!-- #masthead -->
<?php tha_header_after();
