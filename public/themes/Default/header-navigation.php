<div id="hmenu">
<ul>
<!--li><a href="<?php echo get_option('home'); ?>"><?php _e('Home') ?></a></li-->
<?php wp_list_pages('title_li=&depth=1') ?>
<!--li id="hmenu_rss">	<a href="<?php bloginfo('rss2_url'); ?>"  title="<?php bloginfo('name'); ?> RSS Feed">Subscribe to Feed</a></li-->
</ul>
</div>
<hr />
