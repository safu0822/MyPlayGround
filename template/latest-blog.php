<section class="module" id="blog">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="module-title-simple font-yosugara-large wow fadeInUp">HATATATE BLOG</h2>
        <div class="module-subtitle-simple font-yosugara wow fadeInUp">My record of activities, thoughts and
          feelings.</div>
      </div>
    </div>
    <div class="row multi-columns-row post-columns wow fadeInUp" data-wow-delay=".8s">
      <?php
                $args = array(//ページネーションを使いたいなら指定
                  'posts_per_page' => 3, //３記事のみ出力
                  'post_status' => 'publish', //公開の記事だけ
                  'post_type' => 'blog', //カスタム投稿slag
                  'orderby' => 'date', //日付を出力する基準
                  'order' => 'DESC' //表示する順番（逆はASC）         
                );
                $the_blog_query = new WP_Query($args);
                ?>
      <?php if ( $the_blog_query->have_posts() ) : ?>
      <?php while ( $the_blog_query->have_posts() ) : $the_blog_query->the_post(); ?>
      <?php
                $terms = get_the_terms(get_the_ID(), 'blog_category');
                $tag_terms = get_the_terms(get_the_ID(), 'blog_tag');
                ?>
      <div class="col-sm-6 col-md-4 col-lg-4">
        <div class="post mb-20">
          <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail(array(940, 567)); ?>
            </a>
          </div>
          <div class="post-header">
            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-meta">By&nbsp;<a href="#"><?php the_author_meta('display_name'); ?></a>|
              <?php echo get_the_date(); ?> |
              <?php foreach ($terms as $term) : ?>
              <a href="#<?php echo $term->slug; ?>"><?php echo $term->slug; ?></a>
              <?php endforeach; ?> |
              <?php foreach ($tag_terms as $term) : ?>
              <a href="#<?php echo $term->slug; ?>"><?php echo $term->slug; ?></a>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="post-entry">
            <p><?php echo get_custom_post_excerpt(get_the_ID()); ?></p>
          </div>
          <div class="post-more"><a class="more-link" href="<?php the_permalink(); ?>">Read more</a></div>
        </div>
      </div>
      <?php endwhile; ?>
      <?php else : ?>
      <p class="not-post font-yosugara">まだ投稿はありません。</p>
      <?php endif; ?>
      <?php wp_reset_postdata();?>
    </div>
    <div class="text-center"><a class="btn btn-border-d mt-50 font-yosugara"
        href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Check All Blog</a>
    </div>
  </div>
</section>