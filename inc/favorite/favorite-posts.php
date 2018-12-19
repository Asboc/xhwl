<?php
/*
Author URI: https://github.com/hberberoglu/wp-favorite-posts
*/
define('WPZM_META_KEY', "zm_favorites");
define('WPZM_USER_OPTION_KEY', "wpzm_useroptions");
define('WPZM_COOKIE_KEY', "wp-favorite-posts");

if ( !defined( 'WPFP_DEFAULT_PRIVACY_SETTING' ) )
	define( 'WPFP_DEFAULT_PRIVACY_SETTING', false );

$ajax_mode = 1;

function wp_favorite_posts() {
	if (isset($_REQUEST['wpzmaction'])):
		global $ajax_mode;
		$ajax_mode = isset($_REQUEST['ajax']) ? $_REQUEST['ajax'] : false;
		if ($_REQUEST['wpzmaction'] == 'add') {
			wpzm_add_favorite();
		} else if ($_REQUEST['wpzmaction'] == 'remove') {
			wpzm_remove_favorite();
		} else if ($_REQUEST['wpzmaction'] == 'clear') {
			if (wpzm_clear_favorites()) '删除';
			else wpzm_die_or_go("ERROR");
		}
	endif;
}
add_action('wp_loaded', 'wp_favorite_posts');

function wpzm_add_favorite($post_id = "") {
	if ( empty($post_id) ) $post_id = $_REQUEST['postid'];
	if (wpzm_do_add_to_list($post_id)) {
		// added, now?
		do_action('wpzm_after_add', $post_id);
		wpzm_update_post_meta($post_id, 1);
		wpzm_die_or_go('<span class="favorite-o"><i class="be be-star"></i>已收藏</span>');
	}
}
function wpzm_do_add_to_list($post_id) {
	if (wpzm_check_favorited($post_id))
		return false;
	if (is_user_logged_in()) {
		return wpzm_add_to_usermeta($post_id);
	} else {
		return wpzm_set_cookie($post_id, "added");
	}
}

function wpzm_remove_favorite($post_id = "") {
	if (empty($post_id)) $post_id = $_REQUEST['postid'];
	if (wpzm_do_remove_favorite($post_id)) {
		// removed, now?
		do_action('wpzm_after_remove', $post_id);
		wpzm_update_post_meta($post_id, -1);
			wpzm_die_or_go('<span class="favorite-o"><i class="be be-favorite"></i>已删除</span>');
	}
	else return false;
}

function wpzm_die_or_go($str) {
	global $ajax_mode;
	if ($ajax_mode):
		die($str);
	else:
		wp_redirect($_SERVER['HTTP_REFERER']);
	endif;
}

function wpzm_add_to_usermeta($post_id) {
	$zm_favorites = wpzm_get_user_meta();
	$zm_favorites[] = $post_id;
	wpzm_update_user_meta($zm_favorites);
	return true;
}

function wpzm_check_favorited($cid) {
	if (is_user_logged_in()) {
		$favorite_post_ids = wpzm_get_user_meta();
		if ($favorite_post_ids)
			foreach ($favorite_post_ids as $zmost_id)
				if ($zmost_id == $cid) return true;
	} else {
		if (wpzm_get_cookie()):
			foreach (wpzm_get_cookie() as $zmost_id => $val)
				if ($zmost_id == $cid) return true;
		endif;
	}
	return false;
}

function wpzm_link( $return = 0, $action = "", $show_span = 1, $args = array() ) {
	global $post;
	//print_r($post);
	$post_id = &$post->ID;
	extract($args);
	$str = "";
	if ($show_span)
		$str = "<div class='favorite-box'><span class='favorite-e'>";
	//$str .= wpzm_before_link_img();
	//$str .= wpzm_loading_img();
	if ($action == "remove"):
		$str .= wpzm_link_html($post_id, "remove");
	elseif ($action == "add"):
		$str .= wpzm_link_html($post_id, '收藏本文', "add");
	elseif (wpzm_check_favorited($post_id)):
		$str .= wpzm_link_html($post_id, '<i class="be be-star"></i> '. __( '已收藏', 'begin' ) . '', "remove");
	else:
		$str .= wpzm_link_html($post_id, ' '. __( '收 <i class="be be-favorite"></i> 藏', 'begin' ) . '', "add");
	endif;
	if ($show_span)
		$str .= "</span></div>";
	if ($return) { return $str; } else { echo $str; }
}

function wpzm_links( $return = 0, $action = "", $show_span = 1, $args = array() ) {
	global $post;
	//print_r($post);
	$post_id = &$post->ID;
	extract($args);
	$str = "";
	if ($show_span)
		$str = "<span class='favorite-s'>";
	if ($action == "remove"):
		$str .= wpzm_links_html($post_id, "remove");
	elseif ($action == "add"):
		$str .= wpzm_links_html($post_id, ' 收藏本文', "add");
	elseif (wpzm_check_favorited($post_id)):
		$str .= wpzm_links_html($post_id, ' <i class="be be-star"></i>', "remove");
	else:
		$str .= wpzm_links_html($post_id, ' <i class="be be-favorite"></i>'. __( '收藏', 'begin' ) . '</span>', "add");
	endif;
	if ($show_span)
		$str .= "</span>";
	if ($return) { return $str; } else { echo $str; }
}

function wpzm_link_html($post_id, $opt, $action) {
	$link = "<a class='wpzm-link' href='?wpzmaction=".$action."&amp;postid=". esc_attr($post_id) . "' rel='nofollow'>". $opt ."</a>";
	$link = apply_filters( 'wpzm_link_html', $link );
	return $link;
}

function wpzm_links_html($post_id, $opt, $action) {
	$link = "<a class='wpzm-link' href='?wpzmaction=".$action."&amp;postid=". esc_attr($post_id) . "' title='". __( '收藏本文', 'begin' ) . "' rel='nofollow'>". $opt ."</a>";
	$link = apply_filters( 'wpzm_links_html', $link );
	return $link;
}

function wpzm_get_users_favorites($user = "") {
	$favorite_post_ids = array();

	if (!empty($user)):
		return wpzm_get_user_meta($user);
	endif;

	# collect favorites from cookie and if user is logged in from database.
	if (is_user_logged_in()):
		$favorite_post_ids = wpzm_get_user_meta();
	else:
		if (wpzm_get_cookie()):
			foreach (wpzm_get_cookie() as $post_id => $post_title) {
				array_push($favorite_post_ids, $post_id);
			}
		endif;
	endif;
    return $favorite_post_ids;
}

function wpzm_list_favorite_posts( $args = array() ) {
	$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
	extract($args);
	global $favorite_post_ids;
		$favorite_post_ids = wpzm_get_users_favorites();
	include("wpzm-page-template.php");
}


# 读取meta_value
function wpzm_list_most_favorited($limit=5) {
global $wpdb;
	$query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
	$query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
	$query .= " WHERE post_status='publish' AND meta_key='".WPZM_META_KEY."' AND meta_value > 0 ORDER BY ROUND(meta_value) DESC LIMIT 0, $limit";
	$results = $wpdb->get_results($query);
	if ($results) {
		echo "<ul>";
		foreach ($results as $o):
			$p = get_post($o->post_id);
			echo "<li>";
			echo "<a href='".get_permalink($o->post_id)."' title='有 ". $o->meta_value ." 人收藏'>" . $p->post_title . "</a>";
			echo "</li>";
		endforeach;
		echo "</ul>";
	}
}

include("wpzm-widgets.php");

function wpzm_clear_favorites() {
	if (wpzm_get_cookie()):
		foreach (wpzm_get_cookie() as $post_id => $val) {
			wpzm_set_cookie($post_id, "");
			wpzm_update_post_meta($post_id, -1);
		}
	endif;
	if (is_user_logged_in()) {
		$favorite_post_ids = wpzm_get_user_meta();
		if ($favorite_post_ids):
			foreach ($favorite_post_ids as $post_id) {
				wpzm_update_post_meta($post_id, -1);
			}
		endif;
		if (!delete_user_meta(wpzm_get_user_id(), WPZM_META_KEY)) {
			return false;
	}
	}
	return true;
}

function wpzm_do_remove_favorite($post_id) {
	if (!wpzm_check_favorited($post_id))
		return true;

	$a = true;
	if (is_user_logged_in()) {
		$user_favorites = wpzm_get_user_meta();
		$user_favorites = array_diff($user_favorites, array($post_id));
		$user_favorites = array_values($user_favorites);
		$a = wpzm_update_user_meta($user_favorites);
	}
	if ($a) $a = wpzm_set_cookie($_REQUEST['postid'], "");
	return $a;
}



function wpzm_shortcode_func() {
	wpzm_list_favorite_posts();
}
add_shortcode('wp-favorite-posts', 'wpzm_shortcode_func');

function wpfp_add_js_script() {
	wp_enqueue_script( "wpzm", get_template_directory_uri() . "/js/wpzm.js", array( 'jquery' ), version, true );
}

if (zm_get_option('favorite_js')) {
	if ( !is_admin() ) {
		add_action('wp_print_scripts', 'wpfp_add_js_script');
	}
}

function wpzm_update_user_meta($arr) {
	return update_user_meta(wpzm_get_user_id(),WPZM_META_KEY,$arr);
}

function wpzm_update_post_meta($post_id, $val) {
	$oldval = wpzm_get_post_meta($post_id);
	if ($val == -1 && $oldval == 0) {
    	$val = 0;
	} else {
		// $val = $oldval + $val;
	}
	return add_post_meta($post_id, WPZM_META_KEY, $val, true) or update_post_meta($post_id, WPZM_META_KEY, $val);
}

function wpzm_delete_post_meta($post_id) {
	return delete_post_meta($post_id, WPZM_META_KEY);
}

function wpzm_get_cookie() {
	if (!isset($_COOKIE[WPZM_COOKIE_KEY])) return;
	return $_COOKIE[WPZM_COOKIE_KEY];
}

function wpzm_get_options() {
	return get_option('wpzm_options');
}

function wpzm_get_user_id() {
	global $current_user;
	wp_get_current_user();
	return $current_user->ID;
}

function wpzm_get_user_meta($user = "") {
	if (!empty($user)):
		$userdata = get_user_by( 'login', $user );
		$user_id = $userdata->ID;
		return get_user_meta($user_id, WPZM_META_KEY, true);
	else:
		return get_user_meta(wpzm_get_user_id(), WPZM_META_KEY, true);
	endif;
}

function wpzm_get_post_meta($post_id) {
	$val = get_post_meta($post_id, WPZM_META_KEY, true);
	if ($val < 0) $val = 0;
	return $val;
}

function wpzm_set_cookie($post_id, $str) {
	$expire = time()+60*60*24*30;
	return setcookie("wp-favorite-posts[$post_id]", $str, $expire, "/");
}

function wpzm_is_user_favlist_public($user) {
	$user_opts = wpzm_get_user_options($user);
	if (empty($user_opts)) return WPFP_DEFAULT_PRIVACY_SETTING;
	if ($user_opts["is_wpzm_list_public"])
		return true;
	else
		return false;
}

function wpzm_get_user_options($user) {
	$userdata = get_user_by( 'login', $user );
	$user_id = $userdata->ID;
	return get_user_meta($user_id, WPZM_USER_OPTION_KEY, true);
}

function wpzm_is_user_can_edit() {
	if (isset($_REQUEST['user']) && $_REQUEST['user'])
		return false;
	return true;
}

function wpzm_remove_favorite_link($post_id) {
    if (wpzm_is_user_can_edit()) {
		$class = 'wpzm-link remove-parent';
		$link = "<a id='rem_$post_id' class='$class' href='?wpzmaction=remove&amp;page=1&amp;postid=". $post_id ."' rel='nofollow'>". __( '删除', 'begin' ) . "</a>";
		$link = apply_filters( 'wpzm_remove_favorite_link', $link );
		echo $link;
	}
}

function wpzm_clear_list_link() {
	if (wpzm_is_user_can_edit()) {
		echo "<a class='all-wpzm-link wpzm-link' href='?wpzmaction=clear' rel='nofollow'>". __( '全部删除', 'begin' ) . "</a>";
	}
}

function wpzm_cookie_warning() {
	if (!is_user_logged_in() && !isset($_GET['user']) ):
		echo "<p></p>";
	endif;
}

function wpzm_content_filter($content) {
	if (is_single()) {
		if (!zm_get_option('favorite_ub') || (zm_get_option("favorite_ub") == 'favorite_t')) {
			$content .= wpzm_link(0);
		}
		if (zm_get_option('favorite_ub') == 'favorite_b') {
			$content .= wpzm_link(1);
		}
	}
	return $content;
}
add_filter('the_content','wpzm_content_filter');