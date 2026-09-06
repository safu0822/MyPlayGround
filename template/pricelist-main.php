<?php
/**
 * Template Part: pricelist-main
 * 全 priceList 投稿の料金表を一覧表示する
 */

if ( ! function_exists( 'pricelist_make_clickable_urls' ) ) {
  function pricelist_make_clickable_urls( $text ) {
    $pattern = '/(https?:\/\/[^\s<>"\'\)\(]+?\/(?:[^\s<>"\'\)\(]*\/)?)/u';
    $replacement = '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>';
    return preg_replace($pattern, $replacement, $text);
  }
}

if ( ! function_exists( 'pricelist_render_table' ) ) {
  function pricelist_render_table( $table ) {
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
          $html .= ($val === '') ? '<th>&nbsp;</th>' : '<th>' . esc_html($val) . '</th>';
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

    $html .= '</tbody></table></div>';
    return $html;
  }
}

$pricelist_query = new WP_Query([
  'post_type'      => 'pricelist',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);
?>

<section id="pricelist" class="pricelist-section">
  <div class="pricelist-container">

    <?php if ( $pricelist_query->have_posts() ) : ?>
      <?php while ( $pricelist_query->have_posts() ) : $pricelist_query->the_post(); ?>
        <?php
          $content = get_the_content();
          $dom = new DOMDocument();
          libxml_use_internal_errors(true);
          $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
          libxml_clear_errors();
          $xpath = new DOMXPath($dom);
          $figures = $xpath->query('//figure[contains(@class,"wp-block-table")]');
        ?>

        <?php if ( $figures->length > 0 ) : ?>
          <div class="pricelist-item wow fadeInUp">
            <h3 class="pricelist-item-title font-yosugara-medium">
              <?php the_title(); ?>
            </h3>
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="pricelist-item-thumb">
                <?php the_post_thumbnail('medium'); ?>
              </div>
            <?php endif; ?>

            <div class="pricelist-tables">
              <?php
                $body = $dom->getElementsByTagName('body')->item(0);
                if ($body) :
                  foreach ($body->childNodes as $node) :
                    if ($node->nodeType !== XML_ELEMENT_NODE) continue;

                    // テーブルブロック
                    $classes = $node->getAttribute('class');
                    if ($node->nodeName === 'figure' && strpos($classes, 'wp-block-table') !== false) :
                      $table = $node->getElementsByTagName('table')->item(0);
                      $caption = $node->getElementsByTagName('figcaption')->item(0);
                      $captionText = $caption ? trim($caption->nodeValue) : '';
              ?>
                      <div class="pricelist-table-block">
                        <?php if ($captionText) : ?>
                          <h4 class="pricelist-table-caption"><?php echo esc_html($captionText); ?></h4>
                        <?php endif; ?>
                        <?php echo pricelist_render_table($table); ?>
                      </div>
              <?php
                    else :
                      // テーブル以外のブロック（段落など）
                      echo '<div class="pricelist-text">' . wp_kses_post( $dom->saveHTML($node) ) . '</div>';
                    endif;
                  endforeach;
                endif;
              ?>
            </div>

            <?php
              $price_note = get_post_meta( get_the_ID(), '料金表', true );
              if ( ! empty( $price_note ) ) :
            ?>
              <div class="pricelist-note jpn">
                <?php echo wp_kses_post( pricelist_make_clickable_urls( $price_note ) ); ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <p class="text-center">料金情報が追加されるまでお待ちください。</p>
    <?php endif; ?>
  </div>
</section>
