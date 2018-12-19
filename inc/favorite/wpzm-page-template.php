<?php
	$wpzm_before = "";
	echo "<div class='wpzm-span'>";
	if (!empty($user)) {
		if (wpzm_is_user_favlist_public($user)) {
			$wpzm_before = "$user's Favorite Posts.";
		} else {
			$wpzm_before = "$user's list is not public.";
		}
	}

	if ($wpzm_before):
		echo '<div class="wpzm-page-before">'.$wpzm_before.'</div>';
	endif;

	if ($favorite_post_ids) {
		$favorite_post_ids = array_reverse($favorite_post_ids);
		$post_per_page = 15;
		$page = intval(get_query_var('paged'));

		$qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
		// custom post type support can easily be added with a line of code like below.
		// $qry['post_type'] = array('post','page');
		query_posts($qry);
        
		echo "<ul>";
		while ( have_posts() ) : the_post();
			echo "<li><a href='".get_permalink()."' target='_blank'>" . get_the_title() . "</a> ";
			wpzm_remove_favorite_link(get_the_ID());
			echo "</li>";
		endwhile;
		echo "</ul>";

		echo '<div class="navigation">';
			if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
			<div class="alignleft"><?php next_posts_link('<i class="fa fa-angle-left"></i>') ?></div>
			<div class="alignright"><?php previous_posts_link( '<i class="fa fa-angle-right"></i>') ?></div>
			<?php }
		echo '</div><div class="clear"></div>';

		wp_reset_query();
	} else {     
		echo "<ul><li>";
		echo "". __( '暂无文章收藏', 'begin' ) . "";
		echo "</li></ul>";
	}

	/* echo '<p>'.wpzm_clear_list_link().'</p>';*/
	echo "</div>";
	wpzm_cookie_warning();