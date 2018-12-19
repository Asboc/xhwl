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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_k_w').'&h='.zm_get_option('img_k_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			echo '<a class="random-img" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/long.jpg" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/long.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_k_w').'&h='.zm_get_option('img_k_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
		} else { 
			echo '<span class="load"><a class="random-img" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/long.png" data-original="'.get_template_directory_uri().'/img/random/long.jpg" alt="'.$post->post_title .'" /></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_i_w').'&h='.zm_get_option('img_i_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_i_w').'&h='.zm_get_option('img_i_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&a='.zm_get_option('crop_top').'&zc=1" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a></span>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<span class="load"><a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a class="videos" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&a='.zm_get_option('crop_top').'&zc=1" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a class="videos" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a class="videos" href="'.$img.'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&a='.zm_get_option('crop_top').'&zc=1" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a class="videos" href="'.$img.'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&a='.zm_get_option('crop_top').'&zc=1" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a></span>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<span class="load"><a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a class="videor" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&a='.zm_get_option('crop_top').'&zc=1" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a class="videor" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
			echo ' alt="'.$post->post_title .'" /><i class="be be-play"></i></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_t_w').'&h='.zm_get_option('img_t_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_t_w').'&h='.zm_get_option('img_t_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.$direct.'" target="_blank" rel="nofollow"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a href="'.$direct.'" target="_blank" rel="nofollow"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a href="'.$direct.'" target="_blank" rel="nofollow"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<span class="load"><a href="'.$direct.'" target="_blank" rel="nofollow"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('grid_w').'&h='.zm_get_option('grid_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('grid_w').'&h='.zm_get_option('grid_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
		} else { 
			$random = mt_rand(1, 20);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<header class="full-header"><figure class="full-thumbnail"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w=900&h=350&a=t&zc=1" alt="'.$post->post_title .'" /></figure><div class="clear"></div>';
			echo ''.the_title( sprintf( '<h2 class="entry-title-img"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ).'</header>';
		} else {
			the_title( sprintf( '<h2 class="entry-title-full"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			echo '<span class="title-l"></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<header class="full-header"><figure class="full-thumbnail"><span class="load"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w=900&h=350&a=t&zc=1" alt="'.$post->post_title .'" /></span></figure><div class="clear"></div>';
			echo ''.the_title( sprintf( '<h2 class="entry-title-img"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ).'</header>';
		} else {
			the_title( sprintf( '<h2 class="entry-title-full"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			echo '<span class="title-l"></span>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.$sites_img_link.'" target="_blank" rel="external nofollow"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<div class="load"><a href="'.$sites_img_link.'" target="_blank" rel="external nofollow"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></div>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w=700&h=380&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a>';
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
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		echo '<span class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w=700&h=380&a='.zm_get_option('crop_top').'&zc=1" alt="'.$post->post_title .'" /></a></span>';
	}
}