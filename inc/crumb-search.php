<?php
  global $wp_query;
  echo get_search_query() .  '<i class="be be-arrowright"></i> ' ;
  echo ' 找到 ' . $wp_query->found_posts . ' 篇文章';
?>