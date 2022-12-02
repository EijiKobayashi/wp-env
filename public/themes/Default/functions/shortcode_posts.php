<?php

// BASE URL
function base_url() {
  return get_bloginfo('url');
}
add_shortcode('baseurl', 'base_url');

// IGNORE
function ignore_shortcode( $atts, $content = null ) {
  return null;
}
add_shortcode('ignore', 'ignore_shortcode');

// INCLUDE
function include_template_shortcode($params = array()) {
  extract(shortcode_atts(array('file' => 'default'), $params));
  ob_start();
  include_once(STYLESHEETPATH . "/$file.php");
  return ob_get_clean();
}
add_shortcode('include', 'include_template_shortcode');

?>
