<?php
// JSONファイルのパスを取得
$json_file = get_template_directory() . '/assets/json/setsubi/equipments.json';

// ファイルを読み込んで配列化
$json_data  = file_get_contents( $json_file );
$data       = json_decode( $json_data, true );
$equipments = isset( $data['list'] ) ? $data['list'] : $data;
$background = isset( $data['background'] ) ? $data['background'] : false;

// 読み込みエラー時のフォールバック
if ( ! is_array( $equipments ) ) {
    echo '<p>チームデータを読み込めませんでした。</p>';
    return;
}
?>
<?php
// 画像が置かれているディレクトリ（ファイルパス）
$dir_path = get_template_directory() . '/assets/images/equipments/';

// 画像が置かれているディレクトリ（URL）
$dir_uri  = get_template_directory_uri() . '/assets/images/equipments/';

// png / jpg など必要な拡張子を指定
$images = glob( $dir_path . '*.{png,jpg,jpeg,gif,JPG,PNG}', GLOB_BRACE );

// 空なら何もしない
if ( empty( $images ) ) {
  echo '<p>画像が見つかりませんでした。</p>';
  return;
}
?>

<section class="module" id="equipments">
  <?php if ( $background ) : ?>
  <div class="video-background">
    <video class="fixed-bg" muted playsinline autoplay loop>
      <source src="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/IMG_2290-1.mp4"
        type="video/mp4">
    </video>
  </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h2 class="module-title-simple font-yosugara-large">施設&設備紹介</h2>
      <div class="module-subtitle-simple font-yosugara">HATATATEの設備や施設をご紹介します！</div>
    </div>
  </div>
  <div class="discBox wow fadeInUp">
    <div class="discTxt font-alt">
      <?php foreach ( $equipments as $equipment ) : ?>
      <dl>
        <dt><?php echo esc_html( $equipment['見出し'] ); ?></dt>
        <dd class="heightus jpn"><?php echo esc_html( $equipment['コンテンツ'] ); ?></dd>
      </dl>
      <?php endforeach; ?>
    </div>
    <div id="imageslide">

      <!-- メインスライダー -->
      <ul class="slider">
        <?php foreach ( $images as $img_path ) :
          // basename() でファイル名だけ取り出す
          $filename = basename( $img_path );
          $img_url  = esc_url( $dir_uri . $filename );
        ?>
        <li>
          <img src="<?php echo $img_url; ?>" alt="" />
        </li>
        <?php endforeach; ?>
      </ul>

      <!-- ページャー -->
      <ul class="bx-pager" id="bxpagerPC">
        <?php foreach ( $images as $index => $img_path ) :
          $filename = basename( $img_path );
          $img_url  = esc_url( $dir_uri . $filename );
          // 最初のアイテムだけ class="active" を付与
          $active   = ( 0 === $index ) ? ' class="active"' : '';
        ?>
        <li>
          <a data-slide-index="<?php echo esc_attr( $index ); ?>" href="" <?php echo $active; ?>>
            <img src="<?php echo $img_url; ?>" alt="" />
          </a>
        </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </div>
</section>