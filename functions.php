<?php

add_action( 'after_setup_theme', 'ucle_setup' );

if ( ! function_exists( 'ucle_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function ucle_setup() {

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // Add default posts and comments RSS feed links to <head>.
  add_theme_support( 'automatic-feed-links' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', 'Primary Menu' );

  // Add support for a variety of post formats
  //add_theme_support( 'post-formats', array( 'link', 'gallery', 'quote' ) );

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  add_theme_support( 'post-thumbnails' );

  // Add support for custom headers.
  $custom_header_support = array(
    // The height and width of our custom header.
    'width' => 940,
    'height' => 250,
    // Support flexible heights.
    'flex-height' => true,
  );

  add_theme_support( 'custom-header', $custom_header_support );

  // We'll be using post thumbnails for custom header images on posts and pages.
  // We want them to be the size of the header image that we just defined
  // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
  set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

  // Add Twenty Eleven's custom image sizes.
  // Used for large feature (header) images.
  add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
  // Used for featured posts if a large-feature doesn't exist.
  add_image_size( 'small-feature', 500, 300 );

  // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
  register_default_headers( array(
    'ucle2012' => array(
      'url' => '%s/images/headers/ucle2012.jpg',
      'thumbnail_url' => '%s/images/headers/ucle2012-thumbnail.jpg',
      /* translators: header image description */
      'description' => 'UCLe 2012'
    )
  ) );
}
endif; // ucle_setup

/**
 * Sets the post excerpt length to 60 words.
 */
function ucle_excerpt_length( $length ) {
  return 60;
}
add_filter( 'excerpt_length', 'ucle_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function ucle_continue_reading_link() {
  return ' <a class="more" href="'. esc_url( get_permalink() ) . '">' . 'Continue reading <span class="meta-nav">&rarr;</span>' . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and ucle_continue_reading_link().
 */
function ucle_auto_excerpt_more( $more ) {
  return ' &hellip;' . ucle_continue_reading_link();
}
add_filter( 'excerpt_more', 'ucle_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function ucle_custom_excerpt_more( $output ) {
  if ( has_excerpt() && ! is_attachment() ) {
    $output .= ucle_continue_reading_link();
  }
  return $output;
}
add_filter( 'get_the_excerpt', 'ucle_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function ucle_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'ucle_page_menu_args' );

/**
 * Register our sidebars and widgetized areas.
 */
function ucle_widgets_init() {

  register_sidebar( array(
    'name' => __( 'Main Sidebar', 'twentyeleven' ),
    'id' => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'ucle_widgets_init' );

if ( ! function_exists( 'ucle_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function ucle_content_nav( $nav_id ) {
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $nav_id; ?>" class="nav-page">
      <h3 class="assistive-text">Post navigation</h3>
      <div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
      <div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
    </nav>
  <?php endif;
}
endif;

if ( ! function_exists( 'ucle_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function ucle_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer class="comment-meta">
        <div class="comment-author vcard">
          <?php
            $avatar_size = 64;
            if ( '0' != $comment->comment_parent )
              $avatar_size = 32;

            echo get_avatar( $comment, $avatar_size );

            printf( '%1$s <span class="what">on %2$s</span>',
              sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
              sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() )
              )
            );
          ?>

          <?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .comment-author .vcard -->

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
          <br />
        <?php endif; ?>

      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <?php if ( comments_open() ) : ?>
      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
      <?php endif; ?>
    </article><!-- #comment-## -->

  <?php
      break;
  endswitch;
}
endif;

if ( ! function_exists( 'ucle_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ucle_posted_on() {
  printf( '<span class="sep">posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( 'View all posts by %s', get_the_author() ) ),
    get_the_author()
  );
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 */
function ucle_body_classes( $classes ) {

  if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
    $classes[] = 'single-author';

  if ( is_singular() && ! is_home() )
    $classes[] = 'singular';

  return $classes;
}
add_filter( 'body_class', 'ucle_body_classes' );

function ucle_posts($header) {
  require __DIR__ . '/partial/posts.php';
}