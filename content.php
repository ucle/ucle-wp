<?php
/**
 * The default template for displaying content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(is_sticky() ? "featured" : ""); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_title() ? get_the_title() : "&laquo;Untitled&raquo;"; ?></a></h1>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
      <?php ucle_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->

  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->

  <footer class="entry-meta">
    <?php $show_sep = false; ?>
    <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
    <?php
      $categories_list = get_the_category_list( ', ' );
      if ( $categories_list ):
    ?>
    <span class="cat-links">
      <?php printf( '<span class="%1$s">Posted in</span> %2$s', 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
      $show_sep = true; ?>
    </span>
    <?php endif; // End if categories ?>
    <?php
      $tags_list = get_the_tag_list( '', ', ' );
      if ( $tags_list ):
      if ( $show_sep ) : ?>
    <span class="sep"> | </span>
      <?php endif; // End if $show_sep ?>
    <span class="tag-links">
      <?php printf( '<span class="%1$s">Tagged</span> %2$s', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
      $show_sep = true; ?>
    </span>
    <?php endif; // End if $tags_list ?>
    <?php endif; // End if 'post' == get_post_type() ?>

    <?php if ( comments_open() ) : ?>
    <?php if ( $show_sep ) : ?>
    <span class="sep"> | </span>
    <?php endif; // End if $show_sep ?>
    <span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . 'Leave a reply' . '</span>', '<b>1</b> Reply', '<b>%</b> Replies' ); ?></span>
    <?php endif; // End if comments_open() ?>

    <?php edit_post_link( 'Edit', '&mdash; <span class="edit-link">', '</span>' ); ?>
  </footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
