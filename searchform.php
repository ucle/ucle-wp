<?php
/**
 * The template for displaying search forms
 */
?>
  <form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="assistive-text">Search</label>
    <input type="text" class="field" name="s" id="s" value="<?php echo is_search() ? esc_attr(get_search_query()) : ""; ?>" placeholder="Search" />
    <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
  </form>
