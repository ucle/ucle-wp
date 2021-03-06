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
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="description" content="UCL Entrepreneurs is a society for students interested in startups and entrepreneurship who need guidance or resources to develop their ideas" />
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/editor-style.css" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="UCL Entrepreneurs" href="<?php echo esc_url(home_url('/feed/')); ?>" />
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <meta name="twitter:creator" content="UCLEntrepreneur" />
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/Blog">
    <div id="wrapper" class="hfeed">
      <header id="header" role="banner">
        <hgroup>
          <h1 itemprop="name" id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/ucle.png" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a></span></h1>
          <h2 itemprop="description" id="site-description"><?php echo ucle_orangify ( get_bloginfo( 'description' ) ); ?></h2>
        </hgroup>

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
