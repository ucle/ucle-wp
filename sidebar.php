<?php
/**
 * The Sidebar containing the main widget area.
 */

?>
    <div id="secondary" class="widget-area" role="complementary">
      <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

        <aside id="archives" class="widget">
          <h3 class="widget-title">Archives</h3>
          <ul>
            <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
          </ul>
        </aside>

        <aside id="meta" class="widget">
          <h3 class="widget-title">Meta</h3>
          <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
          </ul>
        </aside>

      <?php else: ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
      <?php endif; // end sidebar widget area ?>
    </div><!-- #secondary .widget-area -->
