<?php
// JSONファイルのパスを取得
$json_file = get_template_directory() . '/assets/json/staff/team.json';

// ファイルを読み込んで配列化
$json_data = file_get_contents( $json_file );
$members   = json_decode( $json_data, true );

// 読み込みエラー時のフォールバック
if ( ! is_array( $members ) ) {
    echo '<p>チームデータを読み込めませんでした。</p>';
    return;
}
?>
<section class="module-small" id="staff">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2 class="module-title-simple font-yosugara-large">スタッフ</h2>
        <div class="module-subtitle-simple font-yosugara">HATATATE MARINE SERVICEでは
          経験豊かなスタップが皆様をお待ちしています！</div>
      </div>
    </div>
    <div class="row">
      <?php foreach ( $members as $member ) : ?>
      <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-3">
        <div class="team-item">
          <div class="team-image">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/staff/' . $member['写真'] ); ?>"
              alt="<?php echo esc_attr( $member['名前'] ); ?>" />
            <div class="team-detail">
              <h5 class="font-yosugara"><?php echo esc_html( $member['見出し'] ); ?></h5>
              <p class="font-yosugara"><?php echo esc_html( $member['紹介'] ); ?></p>
            </div>
          </div>
          <div class="team-descr font-yosugara-medium">
            <div class="team-name"><?php echo esc_html( $member['名前'] ); ?></div>
            <div class="team-role"><?php echo esc_html( $member['役割'] ); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>