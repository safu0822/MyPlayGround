<?php
require_once __DIR__ . '/content-defaults.php';
require_once __DIR__ . '/post-types-cms.php';

if ( is_admin() ) {
  require_once __DIR__ . '/admin/settings-page.php';
  require_once __DIR__ . '/admin/importer.php';
}

// 管理画面の値を返す。空欄なら既定値に戻す
function hatatate_get_content( $key ) {
  $saved = get_option( 'hatatate_content', [] );
  if ( is_array( $saved ) && ! empty( $saved[ $key ] ) ) {
    return $saved[ $key ];
  }
  $defaults = hatatate_content_defaults();
  return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

function hatatate_get_image_id( $key ) {
  $saved = get_option( 'hatatate_content', [] );
  return is_array( $saved ) && ! empty( $saved[ $key ] ) ? absint( $saved[ $key ] ) : 0;
}

function hatatate_get_image_url( $key ) {
  $id  = hatatate_get_image_id( $key );
  $url = $id ? wp_get_attachment_image_url( $id, 'full' ) : false;
  if ( $url ) {
    return $url;
  }
  $defaults = hatatate_image_defaults();
  return get_template_directory_uri() . '/' . $defaults[ $key ];
}

// ビジュアルエディタの本文を出力用に整える
function hatatate_render_rich_text( $html ) {
  return wp_kses_post( wpautop( $html ) );
}

// 取り込み前で公開中のQ&Aがなければ既定の項目を表示する
function hatatate_qa_uses_defaults() {
  return ! get_option( 'hatatate_qa_imported' ) && 0 === (int) wp_count_posts( 'qa' )->publish;
}

function hatatate_get_qa_items() {
  if ( hatatate_qa_uses_defaults() ) {
    return hatatate_qa_defaults();
  }
  $posts = get_posts( [
    'post_type'      => 'qa',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => [ 'menu_order' => 'ASC', 'ID' => 'ASC' ],
  ] );
  return array_map( function ( $post ) {
    return [ 'q' => $post->post_title, 'a' => $post->post_content ];
  }, $posts );
}
