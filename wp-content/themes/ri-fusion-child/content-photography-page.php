<?php if(have_rows('included_photos')) : ?>
  <div class="photo-grid">
    <?php while(have_rows('included_photos')) : the_row();
      $photo = get_sub_field('photo');
      $photo_title = get_sub_field('photo_title'); ?>

      <article class="photo">
        <div class="photo-inner" style="background-image:url(<?= $photo ?>)">
          <span class="show-for-sr"><?= $photo_title ?></span>
          <!-- <i class="fa fa-search deploy" aria-hidden="true"></i>
          <div class="full-size">
            <img src="<?= $photo ?>" alt="<?= $photo_title ?>">
            <i class="fa fa-window-close close" aria-hidden="true"></i>
          </div> -->
        </div>
      </article>

    <?php endwhile; ?>
  </div>
<?php endif; ?>