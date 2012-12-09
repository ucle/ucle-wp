        <header class="page-header">
          <h1 class="page-title">
            <?php if ( is_day() ) : ?>
              <?php printf( 'Daily Archives: %s', '<span>' . get_the_date() . '</span>' ); ?>
            <?php elseif ( is_month() ) : ?>
              <?php printf( 'Monthly Archives: %s', '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
            <?php elseif ( is_year() ) : ?>
              <?php printf( 'Yearly Archives: %s', '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
            <?php else : ?>
              Blog Archives
            <?php endif; ?>
          </h1>
        </header>
