<section class="pt-0 pb-0" id="recommend">
  <div id="demo06" class="card05 l-section">
    <div class="l-inner">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title-simple font-yosugara-large wow fadeInUp">HATATATE おすすめツアー</h2>
          <div class="module-subtitle-simple font-yosugara wow fadeInUp">おすすめのツアーを一覧でご紹介します！</div>
        </div>
      </div>
      <div class="swiper wow fadeInUp">
        <div class="swiper-wrapper">

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
                'terms'    => 'tour',
              ],
            ],
          ];
          $tour_query = new WP_Query( $args );
          if ( $tour_query->have_posts() ) :
            while ( $tour_query->have_posts() ) : $tour_query->the_post();
          ?>
          <a href="<?php the_permalink(); ?>" class="swiper-slide">
            <article class="slide">
              <div class="slide-media img-cover">
                <?php the_post_thumbnail([640, 360]); ?>
              </div>
              <div class="slide-content">
                <h3 class="slide-title font-alt">
                  <?php echo get_custom_post_title_excerpt(get_the_ID()); ?>
                </h3>
                <p class="font-alt excerpt-pc">
                  <?php echo get_custom_post_excerpt(get_the_ID()); ?>
                </p>
                <p class="font-alt excerpt-sp">
                  <?php echo get_custom_post_excerpt_responsive(get_the_ID()); ?>
                </p>

                <p class="slide-price font-alt">
                  <?php echo esc_html( get_post_meta(get_the_ID(), '一覧料金', true) ); ?>円〜
                </p>
              </div>
            </article>
          </a>
          <?php
            endwhile;
            wp_reset_postdata();
          else :
          ?>
          <p>ツアーが追加されるまでお待ちください。</p>
          <?php endif; ?>

        </div><!-- /swiper-wrapper -->
      </div><!-- /swiper -->
    </div>
  </div>
</section>