<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header();
get_sidebar(); ?>

    <section id="primary">
      <div role="main">

      <?php if ( have_posts() ) : ?>

        <?php if ( !empty ( $header ) ) { require __DIR__ . '/header/' . $header . '.php'; } ?>

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

          <?php
            /* Include the Post-Format-specific template for the content.
             * If you want to overload this in a child theme then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'content', get_post_format() );
          ?>

        <?php endwhile; ?>

        <?php ucle_content_nav( 'nav-below' ); ?>
      <?php else : ?>
        <article id="post-0" class="post no-results not-found">
          <header class="entry-header">
            <h1 class="entry-title">Nothing Found</h1>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <?php if ( $header == 'search' ): ?>
              <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
            <?php else: ?>
              <p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
            <?php endif; ?>
            <?php get_search_form(); ?>
          </div><!-- .entry-content -->
        </article><!-- #post-0 -->
      <?php endif; ?>

      </div><!-- #content -->
    </section><!-- #primary -->

<?php get_footer(); ?>
