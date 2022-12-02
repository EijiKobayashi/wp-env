<?php
global $post;
$slug = esc_html($post->post_name);
$contents = esc_html($post->post_content);
$template = dirname(__FILE__) . '/templates/page/'. $slug .'.php';

if ( empty($contents) ) {
  if ( file_exists($template) ) {
    require_once $template;
  } else {
    echo 'テンプレートが存在しません！';
  }
} else {
  get_header();

  if (have_posts()) : while (have_posts()) : the_post();
    remove_filter('the_content', 'wpautop');
    the_content('');
  endwhile; endif;

  get_sidebar();
  get_footer();
}
?>
