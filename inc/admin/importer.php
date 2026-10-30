<?php
add_action( 'admin_notices', function() {
  $screen = get_current_screen();
  if ( ! $screen || ! in_array( $screen->id, [ 'edit-qa', 'toplevel_page_hatatate-content' ], true ) ) {
    return;
  }
  if ( isset( $_GET['hatatate_import'] ) ) {
    $is_success = 'success' === $_GET['hatatate_import'];
    printf(
      '<div class="notice notice-%s"><p>%s</p></div>',
      $is_success ? 'success' : 'error',
      $is_success ? 'Q&amp;Aを取り込みました。' : 'Q&amp;Aの取り込みに失敗しました。もう一度お試しください。'
    );
  }
  if ( ! hatatate_qa_uses_defaults() ) {
    return;
  }
  ?>
  <div class="notice notice-warning">
    <p>現在のQ&amp;A（<?php echo count( hatatate_qa_defaults() ); ?>件）はまだ管理画面に取り込まれていません。先に新しいQ&amp;Aを公開すると、現在の項目は表示されなくなります。</p>
    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
      <input type="hidden" name="action" value="hatatate_import_qa">
      <?php wp_nonce_field( 'hatatate_import_qa' ); ?>
      <p><button type="submit" class="button button-primary">現在の内容を管理画面に取り込む</button></p>
    </form>
  </div>
  <?php
});

add_action( 'admin_post_hatatate_import_qa', function() {
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( '権限がありません。', 403 );
  }
  check_admin_referer( 'hatatate_import_qa' );

  $is_success = hatatate_qa_uses_defaults() ? hatatate_import_qa_defaults() : false;
  wp_safe_redirect( add_query_arg(
    [ 'post_type' => 'qa', 'hatatate_import' => $is_success ? 'success' : 'error' ],
    admin_url( 'edit.php' )
  ) );
  exit;
});

function hatatate_import_qa_defaults() {
  $created_ids = [];
  foreach ( hatatate_qa_defaults() as $index => $item ) {
    $post_id = wp_insert_post( wp_slash( [
      'post_type'    => 'qa',
      'post_status'  => 'publish',
      'post_title'   => $item['q'],
      'post_content' => $item['a'],
      'menu_order'   => ( $index + 1 ) * 10,
    ] ), true );

    if ( is_wp_error( $post_id ) ) {
      error_log( 'hatatate QA import failed: ' . $post_id->get_error_message() );
      foreach ( $created_ids as $created_id ) {
        wp_delete_post( $created_id, true );
      }
      return false;
    }
    $created_ids[] = $post_id;
  }
  update_option( 'hatatate_qa_imported', 1 );
  return true;
}
