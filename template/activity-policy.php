<?php
if ( empty( $args['content'] ) ) return;

$content = $args['content'];

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// URLをリンク化する関数（http:// または https:// で始まり / で終わる文字列のみ、日本語も対象）
function make_clickable_urls( $text ) {
// 日本語・記号含むURL全体を対象にし、末尾が / のみリンク化
$pattern = '/(https?:\/\/[^\s<>"\'\)\(]+?\/(?:[^\s<>"\'\)\(]*\/)?)/u';
    $replacement = '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>';
    return preg_replace($pattern, $replacement, $text);
    }


    function render_table($table) {
    $html = '<div class="table-responsive">
      <table>
        <tbody>';
          $thead = $table->getElementsByTagName('thead')->item(0);
          $tbody = $table->getElementsByTagName('tbody')->item(0);

          if ($thead) {
          $tr = $thead->getElementsByTagName('tr')->item(0);
          if ($tr) {
          $html .= '<tr>';
            foreach ($tr->getElementsByTagName('th') as $th) {
            $val = trim($th->nodeValue);
            if ($val === '') {
            $html .= '<th>&nbsp;</th>';
            } else {
            $html .= '<th>' . esc_html($val) . '</th>';
            }
            }
            $html .= '</tr>';
          }
          }

          if ($tbody) {
          foreach ($tbody->getElementsByTagName('tr') as $tr) {
          $html .= '<tr>';
            $colIndex = 0;
            foreach ($tr->getElementsByTagName('td') as $td) {
            $val = trim($td->nodeValue);
            if ($colIndex > 0 && is_numeric(str_replace(',', '', $val))) {
            $val .= '円';
            }
            $html .= '<td>' . esc_html($val) . '</td>';
            $colIndex++;
            }
            $html .= '</tr>';
          }
          }

          $html .= '</tbody>
      </table>
    </div>';
    return $html;
    }


    $figures = $xpath->query('//figure[contains(@class,"wp-block-table")]');
    ?>

    <section id="equipments" class="activity-policy">
      <div class="discBox">
        <div class="discTxt">

          <?php foreach ($figures as $figure): ?>
          <?php
        $table   = $figure->getElementsByTagName('table')->item(0);
        $caption = $figure->getElementsByTagName('figcaption')->item(0);
        $captionText = $caption ? trim($caption->nodeValue) : '';
      ?>

          <?php if ($captionText === '料金表'): ?>
          <dl class="wow fadeInUp">
            <dt class="jpn">料　金（サービス料金、税金込）</dt>
            <dd class="jpn">
              <?php echo esc_html($captionText); ?><br>
              <?php echo render_table($table); ?><br>
              <?php 
            $price = get_post_meta( get_the_ID(), '料金表', true );
            if ( ! empty( $price ) ) {
              echo wp_kses_post( make_clickable_urls( $price ) );
            }
          ?>
            </dd>
          </dl>
          <?php elseif ($captionText === 'キャンセルポリシー'): ?>
          <dl class="wow fadeInUp" data-wow-delay=".2s">
            <dt class="jpn">キャンセルポリシー</dt>
            <dd class="jpn">
              <?php echo esc_html($captionText); ?><br>
              <?php echo render_table($table); ?><br>
              <?php 
            $cancel = get_post_meta( get_the_ID(), 'キャンセルポリシー', true );
            if ( ! empty( $cancel ) ) {
              echo wp_kses_post( make_clickable_urls( $cancel ) );
            }
          ?>
            </dd>
          </dl>
          <?php endif; ?>
          <?php endforeach; ?>

          <!-- 既存のその他セクション -->
          <dl class="wow fadeInUp" data-wow-delay=".4s">
            <dt class="jpn">詳細</dt>
            <dd class="heightus jpn">
              <?php 
            $detail = get_post_meta( get_the_ID(), '詳細', true );
            if ( ! empty( $detail ) ) {
              echo wp_kses_post( make_clickable_urls( $detail ) );
            }
          ?>
            </dd>
          </dl>
          <dl class="wow fadeInUp" data-wow-delay=".6s">
            <dt class="jpn">持ち物<br></dt>
            <dd class="heightus jpn">
              <?php 
            $items = get_post_meta( get_the_ID(), '持ち物', true );
            if ( ! empty( $items ) ) {
              echo wp_kses_post( make_clickable_urls( $items ) );
            }
          ?>
            </dd>
          </dl>
          <dl class="wow fadeInUp" data-wow-delay=".4s">
            <dt class="jpn">参加条件</dt>
            <dd class="heightus jpn">
              <?php 
            $conditions = get_post_meta( get_the_ID(), '参加条件', true );
            if ( ! empty( $conditions ) ) {
              echo wp_kses_post( make_clickable_urls( $conditions ) );
            }
          ?>
            </dd>
          </dl>
          <dl class="wow fadeInUp" data-wow-delay=".6s">
            <dt class="jpn">その他<br></dt>
            <dd class="heightus jpn">
              <?php 
            $other = get_post_meta( get_the_ID(), 'その他', true );
            if ( ! empty( $other ) ) {
              echo wp_kses_post( make_clickable_urls( $other ) );
            }
          ?>
            </dd>
          </dl>
        </div>
      </div>
    </section>