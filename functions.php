<?php
function twpp_enqueue_scripts() {

  /* WordPress標準のjQuery読込解除 */
  wp_deregister_script('jquery');

  wp_enqueue_script( 
    'jquery', 
    get_template_directory_uri() . '/assets/lib/jquery/dist/jquery.js'
  );

  wp_enqueue_script( 
    'bootstrap_min', 
    get_template_directory_uri() . '/assets/lib/bootstrap/dist/js/bootstrap.min.js'
  );

  wp_enqueue_script( 
    'wow', 
    get_template_directory_uri() . '/assets/lib/wow/dist/wow.js'
  );

  wp_enqueue_script( 
    'YTPlayer', 
    get_template_directory_uri() . '/assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js'
  );

  wp_enqueue_script( 
    'isotope', 
    get_template_directory_uri() . '/assets/lib/isotope/dist/isotope.pkgd.js'
  );

  wp_enqueue_script( 
    'imagesloaded',
    get_template_directory_uri() . '/assets/lib/imagesloaded/imagesloaded.pkgd.js'
  );

  wp_enqueue_script( 
    'flexslider',
    get_template_directory_uri() . '/assets/lib/flexslider/jquery.flexslider.js'
  );

  wp_enqueue_script( 
    'carousel',
    get_template_directory_uri() . '/assets/lib/owl.carousel/dist/owl.carousel.min.js'
  );

  wp_enqueue_script( 
    'smoothscroll',
    get_template_directory_uri() . '/assets/lib/smoothscroll.js'
  );

  wp_enqueue_script( 
    'magnific-popup',
    get_template_directory_uri() . '/assets/lib/magnific-popup/dist/jquery.magnific-popup.js'
  );

  wp_enqueue_script( 
    'simple-text-rotator',
    get_template_directory_uri() . '/assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"'
  );

  wp_enqueue_script( 
    'plugins',
    get_template_directory_uri() . '/assets/js/plugins.js"'
  );

  wp_enqueue_script( 
    'main',
    get_template_directory_uri() . '/assets/js/main.js'
  );

}

add_action('init', function(){
    add_theme_support('post-thumbnails');
});

add_action( 'init', function() {
  register_post_type( 'photography', [
    'label' => '写真管理',
    'public' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicon-store',
    'supports' => ['title','editor','thumbnail','custom-fields','excerpt','author','trackbacks','comments','revisions','page-attributes'],
    'has_archive' => true,
    'show_in_rest' => true
  ]);

  register_taxonomy( 'genre',  'photography', [
    'label' => '写真カテゴリ',
    'hierarchical' => true,
    'show_in_rest' => true
  ]);
});

add_action( 'init', function() {
  register_post_type( 'works', [
    'label' => 'ポートフォリオワーク',
    'public' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicon-store',
    'supports' => ['title','editor','thumbnail','custom-fields','excerpt','author','trackbacks','comments','revisions','page-attributes'],
    'has_archive' => true,
    'show_in_rest' => true
  ]);

  register_taxonomy( 'work_category',  'works', [
    'label' => 'ワークカテゴリ',
    'hierarchical' => true,
    'show_in_rest' => true
  ]);
});

add_action( 'init', function() {
  register_post_type( 'blog', [
    'label' => 'ブログ投稿',
    'public' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicon-store',
    'supports' => ['title','editor','thumbnail','custom-fields','excerpt','author','trackbacks','comments','revisions','page-attributes'],
    'has_archive' => true,
    'show_in_rest' => true
  ]);

  register_taxonomy( 'blog_category',  'blog', [
    'label' => 'ブログカテゴリ',
    'hierarchical' => true,
    'show_in_rest' => true
  ]);

  register_taxonomy( 'blog_tag',  'blog', [
    'label' => 'ブログタグ',
    'hierarchical' => false,
    'show_in_rest' => true
  ]);
});

function get_custom_post_excerpt($post_id) {
  $post = get_post($post_id);
  $excerpt = wp_trim_words($post->post_content, 100, '...');
  return $excerpt;
}

function custom_posts_per_page($query) {
  if ($query->is_main_query() && !is_admin()) {
      $query->set('posts_per_page', 5);
  }
}

function enqueue_custom_scripts() { 
  if (is_singular('blog')) { 
    wp_enqueue_script( 'create-table-of-contents', get_template_directory_uri() . '/assets/js/createTableOfContents.js', array(), null, true ); 
    wp_enqueue_script( 'create-table-of-side-contents', get_template_directory_uri() . '/assets/js/createTableOfSideContents.js', array(), null, true ); 
  } 
} 

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('pre_get_posts', 'custom_posts_per_page');

add_action( 'widgets_init', function(){
  register_sidebar();
} );

add_action( 'wp_enqueue_scripts', 'twpp_enqueue_scripts', 'get_custom_post_excerpt' );