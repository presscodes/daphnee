<header class="entry-header">
    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
        <?php daphnee_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
</header><!-- .entry-header -->
