<?php
  $content = $args['content'] ?? '';
  $terms   = $args['terms'] ?? [];

  // デフォルト値
  $heading = 'アクティビティ詳細';

  if ( ! empty( $terms ) && is_array( $terms ) ) {
      // 最初のタームを取得
      $first_term = reset( $terms );
      if ( isset( $first_term->slug ) && $first_term->slug === 'tour' ) {
          $heading = 'ツアー詳細';
      }
  }

  // imgタグのsrc属性を抽出
  preg_match_all('/<img[^>]+(?:src|data-src)="([^">]+)"/i', $content, $matches);
?>
<section id="equipments">
  <h2 class="font-yosugara-large ">〜<?php echo esc_html( $heading ); ?>〜</h2>
  <div class="discBox">
    <div id="imageslide">
      <ul class="slider">
        <?php foreach ($matches[1] as $src) : ?>
        <li><img src="<?php echo $src; ?>" alt=""></li>
        <?php endforeach; ?>
      </ul>
      <ul class="bx-pager" id="bxpagerPC">
        <?php foreach ($matches[1] as $i => $src) : ?>
        <li>
          <a data-slide-index="<?php echo $i; ?>" class="">
            <img src="<?php echo esc_url($src); ?>" alt="">
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>