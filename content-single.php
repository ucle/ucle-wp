<?php
/**
 * The template for displaying content in the single.php template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php echo get_the_title() ? get_the_title() : "&laquo;Untitled&raquo;" ?></h1>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
      <?php ucle_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . 'Pages:' . '</span>', 'after' => '</div>' ) ); ?>
  </div><!-- .entry-content -->

  <footer class="entry-meta">
    <?php
      $categories_list = get_the_category_list( ', ' );

      $tag_list = get_the_tag_list( '', ', ' );
      if ( '' != $tag_list ) {
        $utility_text = 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
      } elseif ( '' != $categories_list ) {
        $utility_text = 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
      } else {
        $utility_text = 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
      }

      printf(
        $utility_text,
        $categories_list,
        $tag_list,
        esc_url( get_permalink() ),
        the_title_attribute( 'echo=0' ),
        get_the_author(),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
      );
    ?>
    <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>

    <?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
    <div id="author-info">
      <div id="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 64 ); ?>
      </div><!-- #author-avatar -->
      <div id="author-description">
        <h2><?php printf( 'About %s', get_the_author() ); ?></h2>
        <?php the_author_meta( 'description' ); ?>
        <div id="author-link">
          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
            <?php printf( 'View all posts by %s <span class="meta-nav">&rarr;</span>', get_the_author() ); ?>
          </a>
        </div><!-- #author-link -->
      </div><!-- #author-description -->
    </div><!-- #author-info -->
    <?php endif; ?>
  </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
