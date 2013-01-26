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

  // We'll be using post thumbnails for custom header images on posts and pages.
  // We want them to be the size of the header image that we just defined
  // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
  set_post_thumbnail_size( 549, 366, true );

  add_image_size( 'feature', 940, 320, true );
  add_image_size( 'staff', 200, 200, true );
}
endif; // ucle_setup

if ( ! isset( $content_width ) ) $content_width = 549;

/**
 * Sets the post excerpt length to 60 words.
 */
function ucle_excerpt_length( $length ) {
  return 60;
}
add_filter( 'excerpt_length', 'ucle_excerpt_length' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function ucle_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( 'Page %s', max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'ucle_wp_title', 10, 2 );

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
    'name' => 'Main Sidebar',
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
    <nav id="<?php echo esc_attr($nav_id); ?>" class="nav-page">
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
  <li <?php comment_class('pingback'); ?>>
    <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment <?php echo ( $comment->user_id === $post->post_author ) ? 'by-author' : ''; ?>">
      <header class="comment-meta">
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

      </header>

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

if ( ! function_exists( 'ucle_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 */
function ucle_entry_meta() {
  //$categories_list = get_the_category_list( ', ' );
  $tag_list = get_the_tag_list( '', ', ' );

  $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );

  $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( 'View all posts by %s', get_the_author() ) ),
    get_the_author()
  );

  if ( $tag_list ) {
    $utility_text = 'This entry was posted on %2$s<span class="by-author"> by %3$s</span> and tagged %1$s.';
  } else {
    $utility_text = 'This entry was posted on %2$s<span class="by-author"> by %3$s</span>.';
  }

  printf(
    $utility_text,
    $tag_list,
    $date,
    $author
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

function ucle_orangify($str) {
  return preg_replace('/\*(.+)\*/', '<em>$1</em>', $str);
}

function ucle_personify() {
  $page = apply_filters('the_content', get_the_content());
  // Warning: Black magic ahead.
  $members = preg_replace_callback('/<p><img [^>]*alt="(https?:\/\/[^"]+)?.*?".*?src="(.+?)".*?>(<br \/>|<\/p>)(\s*<p>&nbsp;<\/p>)*\s*(<p>)?(.+?)<\/p>(\s*<p>&nbsp;<\/p>)*\s*(.+?)(<p>&nbsp;<\/p>|$)/s', 'ucle_personify_single', $page);
  return str_replace('<p>&nbsp;</p>', '', $members);
}

function ucle_personify_single($matches) {
  $img = $matches[2];
  $alt = $matches[1];
  $title = $matches[6];
  $blurb = $matches[8];
  ob_start();
  include __DIR__ . '/partial/person.php';
  $out = ob_get_contents();
  ob_end_clean();
  return $out;
}

// from http://www.tcbarrett.com/2011/09/wordpress-the_slug-get-post-slug-function/
function the_slug($echo=true){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}

function ucle_posts($header) {
  require __DIR__ . '/partial/posts.php';
}

// Finally, get rid of stuff
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
