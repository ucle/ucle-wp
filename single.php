<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
get_sidebar(); ?>

    <div id="primary">
      <div id="content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'content', 'single' ); ?>

          <nav id="nav-below" class="nav-page">
            <h3 class="assistive-text">Post navigation</h3>
            <span class="nav-previous"><?php previous_post_link( '&larr; %link', '%title', true ); ?></span>
            <span class="nav-next"><?php next_post_link( '%link &rarr;', '%title', true ); ?></span>
          </nav><!-- #nav-single -->

          <?php comments_template( '', true ); ?>

        <?php endwhile; // end of the loop. ?>

      </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>
