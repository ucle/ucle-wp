<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php
      /*
       * Print the <title> tag based on what is being viewed.
       */
      global $page, $paged;

      wp_title( '|', true, 'right' );

      // Add the blog name.
      bloginfo( 'name' );

      // Add the blog description for the home/front page.
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

      // Add a page number if necessary:
      if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( 'Page %s', max( $paged, $page ) );

      ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/editor-style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <!-- social meta -->
    <meta name="twitter:creator" content="UCLEntrepreneur" />
    <?php
      /* We add some JavaScript to pages with the comment form
       * to support sites with threaded comments (when in use).
       */
      if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

      /* Always have wp_head() just before the closing </head>
       * tag of your theme, or you will break many plugins, which
       * generally use this hook to add elements to <head> such
       * as styles, scripts, and meta tags.
       */
      wp_head();
    ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/Blog">
    <div id="wrapper" class="hfeed">
      <header id="header" role="banner">
        <hgroup>
          <h1 itemprop="name" id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/ucle.png" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a></span></h1>
          <h2 itemprop="description" id="site-description"><?php bloginfo( 'description' ); ?></h2>
        </hgroup>

        <?php
          $header_image = get_header_image();
          if ( $header_image ) :
            $header_image_width = get_theme_support( 'custom-header', 'width' );
            if ( is_singular()
              && has_post_thumbnail( $post->ID )
              && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) )
              && $image[1] >= $header_image_width ) :
              // Houston, we have a new header image!
              echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
            else :
              $hsz = get_custom_header(); ?>
              <img id="banner" src="<?php header_image(); ?>" width="<?php echo $hsz->width; ?>" height="<?php echo $hsz->height; ?>" alt="" />
              <?php
            endif;
          endif;
        ?>

        <?php get_search_form(); ?>

        <nav id="access" role="navigation">
          <h3 class="assistive-text">Main menu</h3>
          <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
          <div class="skip-link"><a class="assistive-text" href="#content" title="Skip to primary content">Skip to primary content</a></div>
          <div class="skip-link"><a class="assistive-text" href="#secondary" title="Skip to secondary content">Skip to secondary content</a></div>
          <?php /*
            Our navigation menu.
            If one isn't filled out, wp_nav_menu falls back to wp_page_menu.
            The menu assigned to the primary location is the one used.
            If one isn't assigned, the menu with the lowest ID is used. */ ?>
          <div id="main-menu">
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
          </div>
        </nav>
    </header>

      <div id="content">
