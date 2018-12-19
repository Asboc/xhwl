<?php
// No Category Parents

add_filter ("pre_post_link", "zm_filter_category");// will apply to post permalink
add_filter ("user_trailingslashit", "zmfilter_category");

add_filter ("category_link", "zm_filter_category_link");// will apply to post permalink

add_filter( 'rewrite_rules_array','zm_insert_rewrite_rules' );
add_filter( 'query_vars','zm_insert_query_vars' );
add_action( 'wp_loaded','zm_flush_rules' );

// seems category filters are not working
add_action('created_category','zm_flush_rules2');
add_action('edited_category','zm_flush_rules2');
add_action('delete_category','zm_flush_rules2');

// flush_rules() if our rules are not yet included
function zm_flush_rules(){
	update_option('category_base','');
	$rules = get_option( 'rewrite_rules' );

	//if ( ! isset( $rules['(.+?)-cat/?$'] ) ) { // have to comment this in order to refresh the rules
		global $wp_rewrite;
	   	$wp_rewrite->flush_rules();
	//}
}

function zm_flush_rules2(){
	$rules = get_option( 'rewrite_rules' );

		global $wp_rewrite;
	   	$wp_rewrite->flush_rules();
}

// Adding a new rule
function zm_insert_rewrite_rules( $rules )
{
global $wp_rewrite;
	$newrules = array();
	$newrules['(.+?)-cat/?$'] = 'index.php?category_name=$matches[1]';
	$newrules['(.+?)-cat/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
 	
 	
	$categories = get_categories(array('hide_empty'=>false));
	
	
	if ($categories)
	{
		foreach ($categories as $key => $val)
		{
			$posts = get_posts (array("name" => $val->slug));		
			if (!$posts)
			{
				$newrules['('.$val->category_nicename.')/?$'] = 'index.php?category_name=$matches[1]';
				$newrules['('.$val->category_nicename.')/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';

				$newrules['.+?/('.$val->category_nicename.')/?$'] = 'index.php?category_name=$matches[1]';
				$newrules['.+?/('.$val->category_nicename.')/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
			}
		}
	}

	return $newrules + $rules;
}

function zm_insert_query_vars( $vars )
{
    array_push($vars, 'id');
    return $vars;
}

//add_filter('request', 'zmcategory_rewrite_rules');

function zmcategory_rewrite_rules() {
	global $wp_rewrite;
	
	echo "<pre>";
	print_r ($wp_rewrite);
	echo "</pre>";
	
//	[(.+?)/?$] => index.php?category_name=$matches[1]

}

function zm_filter_category_link ($termlink)
{
	if (preg_match ("/\?cat=/", $termlink))
		return $termlink;
	
	
	$str = explode("/", $termlink);
	
	$zmslug = $slug = $str[count($str)-2];
	
	// check if category slug exist in post
	
	$posts = get_posts (array("name" => $slug));		
	preg_match ("/category.*?".$zmslug."/", $termlink, $result);
	
	if ($posts)
		$slug .= "-cat";

	$str = explode("/", $result[0]);
	
	if (count($str) > 3)
		$link = $str[count($str)-2]."/".$slug ;		
	else
		$link = $slug;

	$termlink = preg_replace ("/category.*?".$zmslug."/", $link, $termlink);
	
	return $termlink;	
}

function zm_filter_category ($permalink)
{
	$permalink = str_replace ("%category%", "%zmcategory%", $permalink); 
	
	return $permalink;
}
	
function zmfilter_category ($string)
{
	if (preg_match ("/%zmcategory%/", $string))
	{
		$str = explode("/", $string);
		$slug = $str[count($str)-2];
		
		$posts = get_posts (array("name" => $slug));
		
		$cats = get_the_category($posts[0]->ID);
		
		if ( $cats ) {
			usort($cats, '_usort_terms_by_ID'); 
			$category = $cats[0]->slug;
			if ( $parent = $cats[0]->parent )
			{
				$one = 1;
			}
		}
		
		$string = preg_replace("/%zmcategory%/", $category, $string);		
	}
	
	return $string;	
}