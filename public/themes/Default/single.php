<?php
$post_type_name = esc_html(get_post_type_object(get_post_type())->name);
$post_type_label = esc_html(get_post_type_object(get_post_type())->label);
$template = dirname(__FILE__) . '/templates/single/'. $post_type_name .'.php';

if ( empty($contents) ) {
  if ( file_exists($template) ) {
    require_once $template;
  } else {
    echo 'テンプレートが存在しません！';
  }
} else {
  get_header();

  if (have_posts()) {
    while (have_posts()) {
      the_post();
      echo '<div class="post" id="post-'. the_ID() .'">';
      echo '<h3 class="post-title"><a href="'. get_the_permalink() .'" rel="bookmark" title="">'. get_the_title() .'</a></h3>';
      echo '<div>'. get_the_excerpt() .'</div>';
    }
    if (function_exists("pagination")) {
      pagination($additional_loop->max_num_pages);
    }
  } else {
    echo '<h2>記事がありません。</h2>';
  }

  //get_sidebar();
  get_footer();
}
?>
