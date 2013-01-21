<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(is_sticky() ? "featured" : ""); ?>>
    <header class="entry-header">
      <?php $title = get_the_title() ? get_the_title() : "&laquo;Untitled&raquo;"; ?>
      <?php if ( is_single() ) : ?>
      <h1 class="entry-title"><?php echo $title; ?></h1>
      <?php the_post_thumbnail(array(549,9999)); ?>
      <?php else : ?>
      <h1 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo $title; ?></a>
      </h1>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
        <?php the_post_thumbnail(); ?>
      </a>
      <?php endif; // is_single() ?>
    </header><!-- .entry-header -->

    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
      <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-links">Pages:', 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta" role="contentinfo">
      <?php ucle_entry_meta(); ?>
      <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
      <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
        <div class="author-info">
          <div class="author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 64 ); ?>
          </div><!-- .author-avatar -->
          <div class="author-description">
            <h2><?php printf( 'About %s', get_the_author() ); ?></h2>
            <p><?php the_author_meta( 'description' ); ?></p>
            <div class="author-link">
              <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                <?php printf( 'View all posts by %s <span class="meta-nav">&rarr;</span>', get_the_author() ); ?>
              </a>
            </div><!-- .author-link	-->
          </div><!-- .author-description -->
        </div><!-- .author-info -->
      <?php endif; ?>
    </footer><!-- .entry-meta -->
  </article><!-- #post -->
