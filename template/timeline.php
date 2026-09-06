<?php
/**
 * Timeline template part
 * @param string $args['content'] 投稿本文（Gutenberg HTML）
 */

if ( empty( $args['content'] ) ) {
  return;
}

$content = $args['content'];

// DOMDocumentでパース
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// ヘルパー: ノード直下のテキストだけを取得
function get_direct_text(\DOMNode $node): string {
$buf = '';
foreach ($node->childNodes as $child) {
if ($child->nodeType === XML_TEXT_NODE) {
$buf .= $child->nodeValue;
}
}
return trim($buf);
}

// 「最上位の li」だけを取得（ul.wp-block-list 直下、かつ祖先に li を持たない）
$outerLis = $xpath->query('//ul[contains(@class,"wp-block-list")]/li[not(ancestor::li)]');

if ( ! $outerLis->length ) {
return;
}
?>

<section id="timeline" class="module bg-dark-60 parallax-bg"
  data-background="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/timeline/timeline背景.jpeg">
  <div class="company-history wow fadeInUp" data-wow-duration="2s">
    <h2 class="font-yosugara-large">1日のスケジュール</h2>
    <div class="timeline-container"></div>
    <ul class="timeline">
      <?php foreach ( $outerLis as $li ) : ?>
      <?php
          // 時刻部分（最上位 li の直下テキスト）
          $timeText = get_direct_text($li);

          $title   = '';
          $details = [];

          // 内側の ul
          $innerUls = $li->getElementsByTagName('ul');
          if ( $innerUls->length > 0 ) {
            $firstUl = $innerUls->item(0);
            $firstLi = $firstUl->getElementsByTagName('li')->item(0);

            if ($firstLi) {
              // タイトルは直下テキストのみ
              $title = get_direct_text($firstLi);

              // 補足群: タイトル li の内側 ul のすべての li（直下テキストで取得）
              $nestedUl = $firstLi->getElementsByTagName('ul')->item(0);
              if ($nestedUl) {
                foreach ($nestedUl->getElementsByTagName('li') as $nestedLi) {
                  $text = get_direct_text($nestedLi);
                  if ($text !== '') {
                    $details[] = $text;
                  }
                }
              }
            }
          }
        ?>
      <li class="timeline-item">
        <div class="timeline-date">
          <time class="font-yosugara-medium"><?php echo esc_html($timeText); ?></time>
        </div>
        <div class="timeline-content">
          <?php if ($title): ?>
          <h3 class="font-alt color-white"><?php echo esc_html($title); ?></h3>
          <?php endif; ?>

          <?php foreach ($details as $detail): ?>
          <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $detail)): ?>
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/timeline/' . $detail ); ?>"
            alt="スケジュール画像">
          <?php else: ?>
          <p class="font-serif"><?php echo esc_html($detail); ?></p>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>