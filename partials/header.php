<?php tha_header_before(); ?>
<header id="masthead" class="site-header" role="banner"<?php echo ( get_header_image() ) ? ' style="background-image:url(' . esc_url( get_header_image() ) . ');"' : ''; ?>>
    <?php tha_header_top(); ?>
    <div class="row">
        <div class="site-branding col_4">
            <?php if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif; ?>
            <p class="site-description"><?php bloginfo( 'description' ); ?></p>
        </div><!-- .site-branding -->
    </div>
    <?php tha_header_bottom(); ?>
</header><!-- #masthead -->
<?php tha_header_after();
