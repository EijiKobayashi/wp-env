<?php
foreach(glob(dirname(__FILE__) . '/functions/*.php') as $file) {
  require_once $file;
}
?>
