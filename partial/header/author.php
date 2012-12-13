        <?php the_post(); ?>

        <header class="archive-header">
          <h1 class="archive-title"><?php printf( 'Author Archives: %s', '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
        </header><!-- .archive-header -->

        <?php rewind_posts(); ?>

        <?php
        // If a user has filled out their description, show a bio on their entries.
        if ( get_the_author_meta( 'description' ) ) : ?>
        <div class="author-info">
          <div class="author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 60 ) ); ?>
          </div><!-- .author-avatar -->
          <div class="author-description">
            <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
            <p><?php the_author_meta( 'description' ); ?></p>
          </div><!-- .author-description	-->
        </div><!-- .author-info -->
        <?php endif; ?>
