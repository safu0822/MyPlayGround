<section class="module" id="question">
  <h2 class="module-title font-alt">Q & A</h2>
  <div class="container">
    <div class="row font-alt">
      <?php foreach ( hatatate_get_qa_items() as $item ) : ?>
      <details class="qa-1">
        <summary><?php echo esc_html( $item['q'] ); ?></summary>
        <div class="qa-answer"><?php echo hatatate_render_rich_text( $item['a'] ); ?></div>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
