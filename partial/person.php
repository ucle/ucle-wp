<div class="person">
  <div class="avatar">
    <?php if (!empty($alt)): ?>
      <div class="boxer">
        <img class="top" src="<?php echo $alt; ?>" alt="" />
        <img class="real" src="<?php echo $img; ?>" alt="" />
      </div>
    <?php else: ?>
      <img class="real" src="<?php echo $img; ?>" alt="" />
    <?php endif; ?>
  </div>
  <h3 class="title"><?php echo $title; ?></h3>
  <div class="blurb">
    <?php echo $blurb; ?>
  </div>
</div>
