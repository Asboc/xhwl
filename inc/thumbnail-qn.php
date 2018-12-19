<?php
// 标准缩略图
function zm_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_w'),zm_get_option('img_h')),$crop=1);
			echo '</a>';
		}
	}
}

function zm_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_w'),zm_get_option('img_h')),$crop=1);
			echo '</a>';
		}
	}
}

// 分类宽缩略图
function zm_long_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'long_thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'long_thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_k_w'),zm_get_option('img_k_h')),$crop=1);
			echo '</a>';
		}
	}
}

function zm_long_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'long_thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'long_thumbnail', true);
		echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/long.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_k_w'),zm_get_option('img_k_h')),$crop=1);
			echo '</a>';
		}
	}
}

// 图片缩略图
function img_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_i_w'),zm_get_option('img_i_h')),$crop=1);
			echo '</a>';
		}
	}
}

function img_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_i_w'),zm_get_option('img_i_h')),$crop=1);
			echo '</a>';
		}
	}
}

// 视频缩略图
function videos_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'small', true) ) {
		$image = get_post_meta($post->ID, 'small', true);
		echo '<span class="load"><a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a class="videos" alt="'.$post->post_title .'" href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_v_w'),zm_get_option('img_v_h')),$crop=1);
			echo ' <i class="be be-play"></i></a>';
		}
	}
}

function videos_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'small', true) ) {
		$image = get_post_meta($post->ID, 'small', true);
		echo '<a class="videos" href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a class="videos" alt="'.$post->post_title .'" href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_v_w'),zm_get_option('img_v_h')),$crop=1);
			echo ' <i class="be be-play"></i></a>';
		}
	}
}

function videoe_thumbnail() {
	global $post;
	$img = get_post_meta($post->ID, 'big', true);
	if ( get_post_meta($post->ID, 'small', true) ) {
		$image = get_post_meta($post->ID, 'small', true);
		echo '<a class="videos" href="'.$img.'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a class="videos" alt="'.$post->post_title .'" href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_v_w'),zm_get_option('img_v_h')),$crop=1);
			echo ' <i class="be be-play"></i></a>';
		}
	}
}

function videor_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'small', true) ) {
		$image = get_post_meta($post->ID, 'small', true);
		echo '<span class="load"><a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a class="videor" alt="'.$post->post_title .'" href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_v_w'),zm_get_option('img_v_h')),$crop=1);
			echo ' <i class="be be-play"></i></a>';
		}
	}
}

function videor_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'small', true) ) {
		$image = get_post_meta($post->ID, 'small', true);
		echo '<a class="videor" href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a class="videor" alt="'.$post->post_title .'" href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_v_w'),zm_get_option('img_v_h')),$crop=1);
			echo ' <i class="be be-play"></i></a>';
		}
	}
}

// 商品缩略图
function tao_thumbnail() {
		global $post;
		$url = get_post_meta($post->ID, 'taourl', true);
		if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.esc_url( get_permalink() ).'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_t_w'),zm_get_option('img_t_h')),$crop=1);
			echo '</a>';
		}
	}
}

function tao_thumbnail_h() {
		global $post;
		$url = get_post_meta($post->ID, 'taourl', true);
		if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<span class="load"><a href="'.esc_url( get_permalink() ).'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_t_w'),zm_get_option('img_t_h')),$crop=1);
			echo '</a>';
		}
	}
}

// 图像日志缩略图
function format_image_thumbnail() {
    global $post;
	$content = $post->post_content;
	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][1].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][2].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
	// echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][3].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
}

function format_image_thumbnail_h() {
    global $post;
	$content = $post->post_content;
	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][1].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][2].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
	// echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][3].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
}

function zm_ad_thumbnail() {
	global $post;
	$direct = get_post_meta($post->ID, 'direct', true);
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.$direct.'" target="_blank" rel="nofollow">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_w'),zm_get_option('img_h')),$crop=1);
			echo '</a>';
		}
	}
}

function zm_ad_thumbnail_h() {
	global $post;
	$direct = get_post_meta($post->ID, 'direct', true);
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<span class="load"><a href="'.$direct.'" target="_blank" rel="nofollow"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.$direct.'" target="_blank" rel="nofollow">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_w'),zm_get_option('img_h')),$crop=1);
			echo '</a>';
		}
	}
}

// 图片布局缩略图
function zm_grid_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('grid_w'),zm_get_option('grid_h')),$crop=1);
			echo '</a>';
		}
	}
}

function zm_grid_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a></span>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(zm_get_option('grid_w'),zm_get_option('grid_h')),$crop=1);
			echo '</a>';
		}
	}
}

// 宽缩略图分类
function zm_full_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<header class="full-header"><figure class="full-thumbnail"><span class="load"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></span></figure>';
		echo ''.the_title( sprintf( '<h2 class="entry-title-img"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ).'</header>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<header class="full-header">';
			echo '<figure class="full-thumbnail">';
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(900,350),$crop=1);
			echo '</a>';
			echo ' </figure><div class="clear"></div>';
			echo ''.the_title( sprintf( '<h2 class="entry-title-img"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			echo '</header>';
		}
	}
}

function zm_full_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<header class="full-header"><figure class="full-thumbnail"><span class="load"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></span></figure>';
		echo ''.the_title( sprintf( '<h2 class="entry-title-img"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ).'</header>';
	} else {
		if(wpjam_has_post_thumbnail()){
		if(wpjam_has_post_thumbnail()){
			echo '<header class="full-header">';
			echo '<figure class="full-thumbnail">';
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(900,350),$crop=1);
			echo '</a>';
			echo ' </figure><div class="clear"></div>';
			echo ''.the_title( sprintf( '<h2 class="entry-title-img"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			echo '</header>';
		}
		}
	}
}

// 网址缩略图
function zm_sites_thumbnail() {
	global $post;
	$sites_img_link = sites_nofollow(get_post_meta($post->ID, 'sites_img_link', true));
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.$sites_img_link.'" target="_blank" rel="external nofollow"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.$sites_img_link.'" target="_blank" rel="external nofollow">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_w'),zm_get_option('img_h')),$crop=1);
			echo '</a>';
		}
	}
}

function zm_sites_thumbnail_h() {
	global $post;
	$sites_img_link = sites_nofollow(get_post_meta($post->ID, 'sites_img_link', true));
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.$sites_img_link.'" target="_blank" rel="external nofollow"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.$sites_img_link.'" target="_blank" rel="external nofollow">';
			echo  wpjam_post_thumbnail(array(zm_get_option('img_w'),zm_get_option('img_h')),$crop=1);
			echo '</a>';
		}
	}
}

// wd_img
function gr_wd_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'wd_img', true) ) {
		$image = get_post_meta($post->ID, 'wd_img', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(700,380),$crop=1);
			echo '</a>';
		}
	}
}

function gr_wd_thumbnail_h() {
	global $post;
	if ( get_post_meta($post->ID, 'wd_img', true) ) {
		$image = get_post_meta($post->ID, 'wd_img', true);
		echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		if(wpjam_has_post_thumbnail()){
			echo '<a href="'.get_permalink().'">';
			echo  wpjam_post_thumbnail(array(700,380),$crop=1);
			echo '</a>';
		}
	}
}