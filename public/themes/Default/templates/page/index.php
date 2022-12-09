<?php get_header(); ?>
わーい
<?php
  $args = array(
    'aria_label' => 'breadcrumb',
    'ul_class' =>'p-breadcrumb',
    'li_class' => 'p-breadcrumb__item',
    'li_active_class' => 'is-active',
    'aria_current' => 'page',
    'separator' => '',
  );
  custom_breadcrumb($args);
?>
<div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h2><?php the_title(); ?></h2>
<div class="entry">
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>
<div class="postmetadata">
<?php if( function_exists('the_tags') )
the_tags(__('Tags: '), ', ', '<br />');
?>
<?php edit_post_link(__('Edit'), '&nbsp;|&nbsp;&nbsp;', ''); ?>
</div>
</div>
<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>