        <header class="page-header">
          <h1 class="page-title author"><?php printf( 'Author Archives: %s', '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
        </header>

        <?php
        // If a user has filled out their description, show a bio on their entries.
        if ( get_the_author_meta( 'description' ) ) : ?>
        <div id="author-info">
          <div id="author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 64 ); ?>
          </div><!-- #author-avatar -->
          <div id="author-description">
            <h2><?php printf( 'About %s', get_the_author() ); ?></h2>
            <?php the_author_meta( 'description' ); ?>
          </div><!-- #author-description	-->
        </div><!-- #author-info -->
        <?php endif; ?>

