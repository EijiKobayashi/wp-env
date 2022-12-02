<?php
// PAGINATION
function pagination($pages, $paged, $range = 2, $show_only = false) {

  $pages = (int)$pages; // float型で渡ってくるので明示的に int型 へ
  $paged = $paged ?: 1; // get_query_var('paged')をそのまま投げても大丈夫なように
  $display = $range * 2 + 1;
  $before_shortage = $range - ($pages - $paged);
  $after_shortage = $range - ($paged - 1);

  // 表示テキスト
  $text_before = "Prev";
  $text_next = "Next";

  // 1ページのみで表示設定が true の時
  if ($show_only && $pages === 1) {
    echo '<div class="pager_style"><li class="on">1</li></div>';
    return;
  }

  // 1ページのみで表示設定もない場合
  if ($pages === 1) return;

  // 2ページ以上の時
  if (1 !== $pages) {
    // echo '全' . $pages . 'ページ, ';
    // echo $paged . 'ページ目, ';
    // echo '表示' . $display . '個, ';
    // if ($pages >= $display) {
    //   echo 'ページが多い, ';
    //   if ($paged <= $range) { echo '表示件数が少ない, ' . $after_shortage . '個不足, '; }
    //   if (($pages - $paged) < $range) { echo '表示件数が少ない, ' . $before_shortage . '個不足, '; }
    // }
    echo '<div class="">';
    echo '<ul>';
    if ($paged > 1) {
      // 「前へ」の表示
      echo '<li class="prev"><a href="'. get_pagenum_link($paged - 1) .'">'. $text_before .'</a></li>';
    }
    // 最後のページ
    if ($pages >= $display) {
      $start = $pages - ($display - 1);
      for ($c = 1; $c <= $before_shortage; $c++) {
        echo '<li class="prev"><a href="'. get_pagenum_link($start) .'">'. $start .'</a></li>';
        $start++;
      }
    }
    for ($i = 1; $i <= $pages; $i++) {
      if ($i <= $paged + $range && $i >= $paged - $range) {
        // $paged +- $range 以内であればページ番号を出力
        if ($paged === $i) {
          echo '<li class="on">'. $i .'</li>';
        } else {
          echo '<li><a href="'. get_pagenum_link($i) .'">'. $i .'</a></li>';
        }
      }
    }
    // 最初のページ目
    if ($pages >= $display) {
      $start = ($display - $after_shortage) + 1;
      for ($c = 1; $c <= $after_shortage; $c++) {
        echo '<li class="prev"><a href="'. get_pagenum_link($start) .'">'. $start .'</a></li>';
        $start++;
      }
    }
    if ($paged < $pages) {
      // 「次へ」の表示
      echo '<li class="next"><a href="'. get_pagenum_link($paged + 1) .'">'. $text_next .'</a></li>';
    }
    echo '</ul>';
    echo '</div>';
  }
}

/*
function pagination( $pages = '', $range = 2 ) {
  $showitems = ($range * 2) + 1; // 表示するページ数（5ページを表示）
  global $paged; // 現在のページ値
  if (empty($paged)) $paged = 1; //デフォルトのページ
  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages; // 全ページ数を取得
    if (!$pages) {
      $pages = 1;
    }
  }
  if (1 != $pages) { // 全ページが1でない場合はページネーションを表示する
    echo '<div class="p-pagination">' . "\n";
    // Prev：現在のページ値が1より大きい場合は表示
    if ( $paged > 1 ) {
      echo '<a href="'. get_pagenum_link($paged - 1) .'" class="p-pagination__prev p-pagination__link">PREV</a>';
    }
    for ( $i = 1; $i <= $pages; $i++) {
      if ( 1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
        // 三項演算子での条件分岐
        if ( $paged == $i ) {
          echo '<a href="#" class="p-pagination__link is-active">'. $i .'</a>';
        } else {
          echo '<a href="'. get_pagenum_link($i) .'" class="p-pagination__link">'. $i .'</a>';
        }
      }
    }
    // Next：総ページ数より現在のページ値が小さい場合は表示
    if ($paged < $pages) {
      echo '<a href="'. get_pagenum_link($paged + 1) .'" class="p-pagination__next p-pagination__link">NEXT</a>';
    }
    echo '</div>' . "\n";
  }
}
*/
?>
