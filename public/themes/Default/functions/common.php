<?php

// ヘッダーメタ削除
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link' );
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head',10);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles', 10);
add_filter('show_admin_bar', '__return_false');

// 省略時設定
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
  return '...';
}

// アイキャッチ有効化
add_theme_support('post-thumbnails');

// BODY にタグ CLASS 付与
function add_slug_class_name( $classes ) {
  /* if ( is_singular() ) {
    $page = get_post( get_the_ID() );
    $classes[] = $page->post_name;
  }*/
  if ( is_singular() ) {
    $post_type = get_query_var( 'post_type' );
    if ( is_page() ) {
      $post_type = 'page';
    }
    if ( $post_type && is_post_type_hierarchical( $post_type ) ) {
      global $post;
      $classes[] = esc_attr( $post->post_name );
      if ( $post->ancestors ) {
        $root = $post->ancestors[count($post->ancestors) - 1];
        $root_post = get_post( $root );
        $classes[] = esc_attr( $root_post->post_name );
      }
    }

    $page = get_post( get_the_ID() );
    $classes[] = $page->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_class_name' );
function remove_body_class( $wp_classes, $extra_classes ) {
  $wp_classes = preg_grep( "/single-|page-|template|logged-in|\d/", $wp_classes, PREG_GREP_INVERT );
  return array_merge( $wp_classes, (array) $extra_classes );
}
add_filter( 'body_class', 'remove_body_class', 10, 2 );

// THUMBNAIL / TRIMMING
//add_image_size('common', 600, 450, true);          // COMMON
//add_image_size('mainvisual_pc', 1280, 500, true);  // MAIN VISUAL PC
//add_image_size('mainvisual_sp', 750, 560, true);   // MAIN VISUAL SP
//add_image_size('square', 500, 500, true);          // SQUARE
//add_image_size('square_small', 300, 300, true);    // SQUARE Small
//add_image_size('gallery_list', 320, 210, true);    // GALLERY
//add_image_size('articles_list', 600, 400, true);   // ARTICLES LIST
//add_image_size('news_list', 350, 215, true);       // NEWS LIST
//add_image_size('highlights', 640, 450, true);      // HIGHLIGHTS

// CLASS追加 for IMG
function image_class_filter( $class ) {
  return $class . ' img-responsive';
}
add_filter('get_image_tag_class', 'image_class_filter');

// CLASS追加 for previous_post_link() & next_post_link()
function add_prev_post_link_class($output) {
  return str_replace('<a href=', '<a class="nav-links__prev nav-links__a" href=', $output);
}
add_filter( 'previous_post_link', 'add_prev_post_link_class' );
function add_next_post_link_class($output) {
  return str_replace('<a href=', '<a class="nav-links__next nav-links__a" href=', $output);
}
add_filter( 'next_post_link', 'add_next_post_link_class' );

// ブロックエディタスタイル削除
function dequeue_plugins_style() {
  wp_dequeue_style('wp-block-library');
}
add_action( 'wp_enqueue_scripts', 'dequeue_plugins_style', 9999);
function dequeue_global_style() {
  wp_dequeue_style('global-styles');
}
add_action( 'wp_enqueue_scripts', 'dequeue_global_style', 9999);

// デフォルトjQueryを削除
function delete_jquery() {
  if (!is_admin()) {
    wp_enqueue_scripts('jquery');
  }
}
add_action( 'init', 'delete_jquery' );

// SVGアップロード
function add_file_types_to_uploads( $file_types ) {
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge( $file_types, $new_filetypes );
  return $file_types;
}
add_action( 'upload_mimes', 'add_file_types_to_uploads' );

// SVG表示
add_filter( 'manage_media_columns', function( $columns ) {
  echo '<style>.media-icon img[src$=".svg"]{width:100%;}</style>';
  return $columns;
});

// 自動整形の無効化
add_filter( 'the_content', 'disabled_wpautop', 1 );
function disabled_wpautop($content) {
  global $post;
  $post_type = get_post_type( $post->ID );
  $arr_types = array( 'others' );
  if( in_array( $post_type, $arr_types ) ) {
    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_excerpt', 'wpautop' );
  }
  return $content;
}

// Disable block frontend wrapper
add_filter( 'lazyblock/test/frontend_allow_wrapper', '__return_false' );

?>
