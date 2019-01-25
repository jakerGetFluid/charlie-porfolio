<section class="photo-cats">
  <?php
    $args = array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      'meta_query' => array(
        array(
          'key' => '_wp_page_template',
          'value' => 'template-photography.php'
        )
      )
    );

    $photo_cats = new WP_Query($args);

    if($photo_cats->have_posts()) :
      while($photo_cats->have_posts()) : $photo_cats->the_post();
        $feat_cat_photo = get_field('featured_photo');
        $cat_link = get_the_permalink(); ?>
        
        <article class="cat">
          <?php if($feat_cat_photo) : ?>
            <div class="cat-bg" style="background-image:url(<?= $feat_cat_photo ?>)"></div>
          <?php endif; ?>
          <a href="<?= $cat_link ?>" class="cat-inner">
            <h4><?php the_title(); ?></h4>
          </a>
        </article>
        <?php
      endwhile;
    endif;
    wp_reset_postdata();
  ?>
</section>