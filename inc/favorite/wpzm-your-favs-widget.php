<?php
echo "<ul>";
if ($favorite_post_ids):
	$c = 0;
	$favorite_post_ids = array_reverse($favorite_post_ids);
	foreach ($favorite_post_ids as $post_id) {
		if ($c++ == $limit) break;
		$p = get_post($post_id);
		echo "<li><i class='fa fa-heart-o'></i>";
		echo "<a href='".get_permalink($post_id)."'>" . $p->post_title . "</a> ";
		echo "</li>";
	}
else:
	echo "<li>";
	echo "". __( '暂无文章收藏', 'begin' ) . "";
	echo "</li>";
endif;
echo "</ul>";
?>