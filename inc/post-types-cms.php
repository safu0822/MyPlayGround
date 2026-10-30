<?php
add_action( 'init', function() {
  register_post_type( 'qa', [
    'label' => 'Q&A',
    'public' => false,
    'show_ui' => true,
    'menu_position' => 11,
    'menu_icon' => 'dashicons-editor-help',
    'supports' => ['title','editor','page-attributes'],
    'has_archive' => false,
    'rewrite' => false,
    'query_var' => false,
  ]);
});

// 管理画面の一覧も表示順で並べる
add_action( 'pre_get_posts', function( $query ) {
  if ( ! is_admin() || ! $query->is_main_query() || 'qa' !== $query->get( 'post_type' ) || $query->get( 'orderby' ) ) {
    return;
  }
  $query->set( 'orderby', [ 'menu_order' => 'ASC', 'ID' => 'ASC' ] );
});
