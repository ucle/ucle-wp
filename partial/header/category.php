        <header class="page-header">
          <h1 class="page-title"><?php printf( 'Category Archives: %s', '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

        <?php if ( category_description() ) : // Show an optional category description ?>
          <div class="page-meta"><?php echo category_description(); ?></div>
        <?php endif; ?>
        </header><!-- .archive-header -->
