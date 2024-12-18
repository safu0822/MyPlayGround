<div class="module-small bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="widget">
          <h5 class="widget-title font-alt">About</h5>
          <p>My information can also be found on the following social networking sites But don't look too much because
            it's embarrassing!</p>
          <p>Instagram<a href="https://www.instagram.com/safu0822_underwater/">：@safu0822_underwater</a></p>
          <p>facebook<a href="https://www.facebook.com/profile.php?id=100025317318258">：@safu0822</a></p>
          <p>github<a href="https://github.com/safu0822">：safu0822</a></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="widget">
          <h5 class="widget-title font-alt">Blog Categories</h5>
          <?php $terms = get_terms('blog_category'); ?>
          <ul class="icon-list">
            <?php foreach ($terms as $term): ?>
            <?php 
              $term_data = get_term(esc_html($term->term_id));
              $post_count = $term_data->count;
              $term_link = get_category_link($term->term_id);
            ?>
            <li><a href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($term->name); ?> -
                <?php echo $post_count; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="widget">
          <h5 class="widget-title font-alt">Popular News</h5>
          <?php 
            if (function_exists('wpp_get_mostpopular')) {
              $arg = array (
                'range' => 'all',//集計する期間 {daily(1日), weekly(1週間), monthly(1ヶ月), all(全期間)}
                'order_by' => 'views',//表示順｛views（閲覧数),comments（コメント数）,avg（1日の平均）}
                'post_type' => 'post,page,blog',//ポストタイプを指定 {post, page, カスタムポスト名}
                'title_length' => '25',//表示させるタイトル文字数
                'excerpt_length' => '0',//抜粋文字数
                'stats_comments' => '0',//コメント数を表示{ 1(表示), 0(非表示) }
                'stats_date' => 1,//日付を表示 { 1(表示), 0(非表示) }
                'stats_date_format' => 'F j, Y',//日付表示フォーマット
                'limit' => 10, //表示数
                'stats_views' => '0',//閲覧数表示 { 1(表示), 0(非表示) }
                'thumbnail_width' => '50',//サムネイルの幅
                'thumbnail_height' => '50',//サムネイルの高さ
                'stats_category' => 1,//カテゴリー名を使用する { 1(する), 0(しない) } {category}
                'post_html' => '<li>{thumb}<h1>{title}</h1><p>{summary}</p><div>{stats}{category}</div></li>'//表示されるhtmlの設定（{thumb}はリンク付きのサムネイル画像,{title}はリンク付きのタイトル,{summary}は抜粋文）
              );
            //ランキングを表示  
            echo '<ul class="ranking-footer-list">';
              wpp_get_mostpopular($arg);//リストの出力
            echo '</ul>';  
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<hr class="divider-d">
<footer class="footer bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <p class="copyright font-alt">&copy; 2024&nbsp;<a href="/">So Suzuki</a>, All Rights Reserved</p>
      </div>
      <div class="col-sm-6">
        <div class="footer-social-links">
          <a class="link-icon" href="https://www.instagram.com/safu0822_underwater/"><i class="fa fa-instagram"></i>
          </a>
          <a class="link-icon" href="https://www.facebook.com/profile.php?id=100025317318258"><i
              class="fa fa-facebook"></i>
          </a>
          <a class="link-icon" href="https://www.linkedin.com/in/so-suzuki-46697a257/"><i class="fa fa-linkedin"></i>
          </a>
          <a class="link-icon" href="https://github.com/safu0822"><i class="fa fa-github"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script>
(function($) {
  /* URLコピー機能を実装するDOM要素をCSSクラスで指定 */
  var clipboard = new ClipboardJS('.share-url');
  clipboard.on('success', function(e) {
    /* URLコピー完了時のメッセージを対象のURLコピーボタン内に表示 */
    $(e.trigger.nextElementSibling).fadeIn().delay(1000).fadeOut();
  });
})(jQuery);
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v21.0">
</script>
<?php wp_footer(); ?>