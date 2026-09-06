<?php
// JSONファイルのパスを取得
$json_file = get_template_directory() . '/assets/json/activitySlide/activity-header-slider.json';

// ファイルを読み込んで配列化
$json_data = file_get_contents( $json_file );
$headers   = json_decode( $json_data, true );

// 読み込みエラー時のフォールバック
if ( ! is_array( $headers ) ) {
    echo '<p>トップページスライドを読み込めませんでした。</p>';
    return;
}
?>
<?php
// 画像が置かれているディレクトリ（ファイルパス）
$dir_path = get_template_directory() . '/assets/images/backgrounds/';

// 画像が置かれているディレクトリ（URL）
$dir_uri  = get_template_directory() . '/assets/images/backgrounds/';

// png / jpg など必要な拡張子を指定
$images = glob( $dir_path . '*.{png,jpg,jpeg,gif}', GLOB_BRACE );

// 空なら何もしない
if ( empty( $images ) ) {
  echo '<p>画像が見つかりませんでした。</p>';
  return;
}
?>
<section class="home-section home-parallax home-fade home-full-height" id="home">
  <div class="hero-slider">
    <ul class="slides">
      <?php foreach ( $headers as $contents ) : ?>
      <li class="bg-dark-30 bg-dark"
        style="background-image:url(<?php echo esc_url( get_template_directory_uri() . '/assets/images/backgrounds/' . $contents['背景'] ); ?>);">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-yosugara mb-30 titan-title-size-1"><?php echo esc_html( $contents['小見出し'] ); ?></div>
            <div class="font-yosugara mb-40 titan-title-size-4"><?php echo esc_html( $contents['見出し'] ); ?></div>
            <a class="font-yosugara section-scroll btn btn-border-w btn-round" href="#recommend">Learn More</a>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>