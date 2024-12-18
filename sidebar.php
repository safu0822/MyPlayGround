<div class="col-sm-4 col-md-3 col-md-offset-1 sidebar">
  <div class="widget">
    <h5 class="widget-title ">Check & Follow　👇👇
    </h5>
    <a href="https://www.instagram.com/safu0822_underwater/"><img
        src="<?php echo get_template_directory_uri(); ?>/assets/images/qrcode/instagramQR.JPG" alt="インスタQRコード"></a>
  </div>
  <div class="widget">
    <h5 class="widget-title ">Search</h5>
    <?php get_search_form(); ?>
  </div>
  <div class="widget">
    <h5 class="widget-title ">Blog Categories</h5>
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
  <div class="widget">
    <h5 class="widget-title ">Tag</h5>
    <div class="tags">
      <?php $terms_tags = get_terms('blog_tag'); ?>
      <?php foreach ($terms_tags as $term): ?>
      <?php $term_tag_link = get_category_link($term->term_id);?>
      <a href="<?php echo esc_url($term_tag_link); ?>" rel="tag"><?php echo esc_html($term->name); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="widget">
    <h5 class="widget-title ">Popular Posts</h5>
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
          echo '<ul class="ranking-list">';
            wpp_get_mostpopular($arg);//リストの出力
          echo '</ul>';  
        }
        ?>
  </div>
</div>
<div class="col-sm-4 col-md-3 col-md-offset-1 side_wrapper">
</div>