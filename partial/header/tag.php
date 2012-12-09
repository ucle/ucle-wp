        <header class="page-header">
          <h1 class="page-title"><?php
            printf( 'Tag Archives: %s', '<span>' . single_tag_title( '', false ) . '</span>' );
          ?></h1>

          <?php
            $tag_description = tag_description();
            if ( ! empty( $tag_description ) )
              echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
          ?>
        </header>
