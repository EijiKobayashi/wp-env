<?php
// タクソノミー情報取得
$labels = get_taxonomy($taxonomy);
$taxonomy_name = esc_html($labels->name);
$taxonomy_label = esc_html($labels->label);
$template = dirname(__FILE__) . '/templates/taxonomy/'. $taxonomy_name .'.php';

// クエリ・オブジェクト取得
$queried_object = get_queried_object();
//var_dump($queried_object);
$term_name = $queried_object->name;
$term_slug = $queried_object->slug;
$term_taxonomy = $queried_object->taxonomy;

if ( file_exists($template) ) {
  require_once $template;
} else {
  echo 'テンプレートが存在しません！';
}
?>
