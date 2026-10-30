<?php
function hatatate_content_fields() {
  return [
    'about' => [
      'label'  => 'トップページ：about',
      'fields' => [
        'about_title'         => [ 'label' => '見出し', 'type' => 'text' ],
        'about_body'          => [ 'label' => '本文', 'type' => 'editor' ],
        'about_image'         => [ 'label' => '写真', 'type' => 'image' ],
        'about_instagram_url' => [ 'label' => 'Instagram URL', 'type' => 'url' ],
      ],
    ],
    'access' => [
      'label'  => 'アクセスページ',
      'fields' => [
        'access_title'          => [ 'label' => '見出し', 'type' => 'text' ],
        'access_body'           => [ 'label' => '本文', 'type' => 'editor' ],
        'access_map_image'      => [ 'label' => '地図画像', 'type' => 'image' ],
        'access_map_url'        => [ 'label' => 'GoogleマップURL', 'type' => 'url' ],
        'access_transfer_image' => [ 'label' => '乗り継ぎ画像', 'type' => 'image' ],
        'access_header_bg'      => [ 'label' => 'ページ上部の背景画像', 'type' => 'image' ],
        'access_section_bg'     => [ 'label' => '本文の背景画像', 'type' => 'image' ],
      ],
    ],
  ];
}

function hatatate_sanitize_content( $input ) {
  $input = is_array( $input ) ? $input : [];
  $clean = [];
  foreach ( hatatate_content_fields() as $section ) {
    foreach ( $section['fields'] as $key => $field ) {
      $value = isset( $input[ $key ] ) ? $input[ $key ] : '';
      switch ( $field['type'] ) {
        case 'editor':
          $clean[ $key ] = trim( wp_kses_post( $value ) );
          break;
        case 'image':
          $clean[ $key ] = absint( $value );
          break;
        case 'url':
          $clean[ $key ] = esc_url_raw( $value );
          break;
        default:
          $clean[ $key ] = sanitize_text_field( $value );
      }
    }
  }
  return $clean;
}

add_action( 'admin_init', function() {
  register_setting( 'hatatate_content_group', 'hatatate_content', [
    'type'              => 'array',
    'sanitize_callback' => 'hatatate_sanitize_content',
  ] );
});

add_action( 'admin_menu', function() {
  add_menu_page( 'サイト文章設定', 'サイト文章設定', 'manage_options', 'hatatate-content', 'hatatate_render_settings_page', 'dashicons-edit-page', 11 );
});

add_action( 'admin_enqueue_scripts', function( $hook ) {
  if ( 'toplevel_page_hatatate-content' !== $hook ) {
    return;
  }
  wp_enqueue_media();
  wp_enqueue_script( 'hatatate-admin-media', get_template_directory_uri() . '/assets/js/admin-media.js', [ 'jquery' ], null, true );
});

function hatatate_render_image_field( $key ) {
  $id = hatatate_get_image_id( $key );
  ?>
  <div class="hatatate-image-field">
    <input type="hidden" name="hatatate_content[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $id ? $id : '' ); ?>">
    <p><img class="hatatate-image-preview" src="<?php echo esc_url( hatatate_get_image_url( $key ) ); ?>" data-default="<?php echo esc_url( get_template_directory_uri() . '/' . hatatate_image_defaults()[ $key ] ); ?>" alt="" style="max-width:240px;height:auto;"></p>
    <button type="button" class="button hatatate-image-select">画像を選択</button>
    <button type="button" class="button-link hatatate-image-clear">元の画像に戻す</button>
  </div>
  <?php
}

function hatatate_render_field( $key, $field ) {
  $name = 'hatatate_content[' . $key . ']';
  switch ( $field['type'] ) {
    case 'editor':
      wp_editor( hatatate_get_content( $key ), 'hatatate_' . $key, [
        'textarea_name' => $name,
        'textarea_rows' => 12,
        'media_buttons' => false,
      ] );
      break;
    case 'image':
      hatatate_render_image_field( $key );
      break;
    default:
      printf(
        '<input type="%s" class="regular-text" name="%s" value="%s">',
        esc_attr( $field['type'] ),
        esc_attr( $name ),
        esc_attr( hatatate_get_content( $key ) )
      );
  }
}

function hatatate_render_settings_page() {
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }
  ?>
  <div class="wrap">
    <h1>サイト文章設定</h1>
    <p>空欄のまま保存した項目は、元の内容に戻ります。Q&amp;Aは左メニューの「Q&amp;A」から編集できます。</p>
    <form method="post" action="options.php">
      <?php settings_fields( 'hatatate_content_group' ); ?>
      <?php foreach ( hatatate_content_fields() as $section ) : ?>
      <h2><?php echo esc_html( $section['label'] ); ?></h2>
      <table class="form-table" role="presentation">
        <?php foreach ( $section['fields'] as $key => $field ) : ?>
        <tr>
          <th scope="row"><?php echo esc_html( $field['label'] ); ?></th>
          <td><?php hatatate_render_field( $key, $field ); ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
      <?php endforeach; ?>
      <?php submit_button( '保存する' ); ?>
    </form>
  </div>
  <?php
}
