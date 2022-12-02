<?php
$post_type_name = esc_html(get_post_type_object(get_post_type())->name);
if (!$post_type_name) {
  $post_type_name = esc_html(get_query_var('post_type'));
}
$post_type_label = esc_html(get_post_type_object(get_post_type())->label);
$template = dirname(__FILE__) . '/templates/archive/'. $post_type_name .'.php';

if ( file_exists($template) ) {
  require_once $template;
} else {
  echo 'テンプレートが存在しません！';
}
?>
