<?php
$args = array(//ページネーションを使いたいなら指定
  'posts_per_page' => 5, //３記事のみ出力
  'post_status' => 'publish', //公開の記事だけ
  'post_type' => 'news', //カスタム投稿slag
  'orderby' => 'date', //日付を出力する基準
  'order' => 'DESC' //表示する順番（逆はASC）         
);
$the_news_query = new WP_Query($args);
?>
<section class="module" id="news">
  <div class="container">
    <div id="latest_news">
      <h3 class="font-yosugara-large color-black">
        HATATATEからのお知らせ
      </h3>
      <dl>
        <?php if ( $the_news_query->have_posts() ) : ?>
        <?php while ( $the_news_query->have_posts() ) : $the_news_query->the_post(); ?>
        <dt><?php echo get_the_date(); ?></dt>
        <dd>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </dd>
        <?php endwhile; ?>
        <?php else : ?>
        <p class="not-post font-yosugara">まだ投稿はありません。</p>
        <?php endif; ?>
        <?php wp_reset_postdata();?>
      </dl>
    </div>
    <div class="text-center"><a class="btn btn-border-d mt-50 font-yosugara"
        href="<?php echo esc_url( home_url( '/news' ) ); ?>">Check All news</a>
    </div>
  </div>
</section>