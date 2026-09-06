<section class="module activity-liner bg-dark-60"
  data-background="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/696B07AF-6AB0-4F61-9519-F81F5DF088F1.jpg">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="font-yosugara-large module-title-simple color-white wow fadeInUp">アクティビティメニュー</h2>
        <div class="font-yosugara module-subtitle-simple color-white wow fadeInUp">
          HATATATEではみなさまに様々なアクティビティをご用意しています。</div>
      </div>
    </div>
    <div class="row multi-columns-row wow fadeInUp">
      <?php
        $args = [
          'post_type'      => 'activity',
          'posts_per_page' => 10,        // 必要に応じて変更
          'orderby'        => 'date',
          'order'          => 'DESC',
          'tax_query'      => [
            [
              'taxonomy' => 'activity_category',
              'field'    => 'slug',
              'terms'    => 'activity',
            ],
          ],
        ];
        $activity_query = new WP_Query( $args );
        if ( $activity_query->have_posts() ) :
          while ( $activity_query->have_posts() ) : $activity_query->the_post();
      ?>
      <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="<?php the_permalink(); ?>">
          <div class="content-box-image"><?php the_post_thumbnail([640, 360]); ?></div>
          <h3 class="content-box-title font-yosugara-medium"><?php echo get_custom_post_title_excerpt(get_the_ID()); ?>
          </h3>
        </a>
      </div>
      <?php
            endwhile;
            wp_reset_postdata();
          else :
          ?>
      <p>アクティビティが追加されるまでお待ちください。</p>
      <?php endif; ?>
    </div>
  </div>
</section>