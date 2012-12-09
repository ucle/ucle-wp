<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

  <div id="primary">
    <div id="content" role="main">

      <article id="post-0" class="post error404 not-found">
        <header class="entry-header">
          <h1 class="entry-title">This is somewhat embarrassing, isn&rsquo;t it?</h1>
        </header>

        <div class="entry-content">
          <p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.</p>

          <?php get_search_form(); ?>

          <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

          <div class="widget">
            <h2 class="widgettitle">Most Used Categories</h2>
            <ul>
            <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
            </ul>
          </div>

          <?php
          /* translators: %1$s: smilie */
          $archive_content = '<p>' . sprintf( 'Try looking in the monthly archives. %1$s', convert_smilies( ':)' ) ) . '</p>';
          the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
          ?>

          <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

        </div><!-- .entry-content -->
      </article><!-- #post-0 -->

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_footer(); ?>
