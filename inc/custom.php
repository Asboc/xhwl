<?php

// 选择颜色
function begin_color(){
	custom_color();
}
function custom_color(){
	if (zm_get_option("custom_color")) {
		$color = substr(zm_get_option("custom_color"), 1);
	}
	if ($color) {
		$styles .= "
a:hover,.top-menu a:hover,.show-more span,.cat-box .icon-cat,.entry-meta a,.entry-meta-no a,.at, .at a,#user-profile a:hover, .nav-search:hover, .off-side:hover:after, .nav-search:hover:after, .top-icon .be {color: #" . $color . ";}
.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after{border-top-color: #" . $color . ";}
.thumbnail .cat,.format-img-cat, .des-t, .des-p  {background: #" . $color . ";}
#login h1 a,.format-aside .post-format a,#searchform button,.li-icon-1,.li-icon-2,.li-icon-3, .title-l,.buttons a, .li-number, .searchbar button, 
.entry-more a, .qqonline a, #login input[type='submit'], .log-zd, .group-phone a, .deanm-main .de-button a, #site-nav .down-menu > li > a:hover,#site-nav .down-menu > li.sfHover > a {background: #" . $color . ";}
.entry-more a {right: -1px;}
.entry-more a:hover {color: #fff;background: #595959;}
.entry-direct a:hover, #respond input[type='text']:focus, #respond textarea:focus {border: 1px solid #" . $color . ";}
#down a,.page-links span,.reply a:hover,.widget_categories a:hover,.widget_links a:hover,#respond #submit:hover,.callbacks_tabs .callbacks_here a,#gallery .callbacks_here a,#fontsize:hover,.single-meta li a:hover,.meta-nav:hover,.nav-single i:hover, .widget_categories a:hover, .widget_links a:hover, .tagcloud a:hover, #sidebar .widget_nav_menu a:hover, .gr-cat-title a, .group-tab-hd .group-current, .img-tab-hd .img-current {background: #" . $color . ";border: 1px solid #" . $color . ";}
.comment-tool a, .link-all a:hover, .link-f a:hover, .ias-trigger-next a:hover, .type-cat a:hover, .type-cat a:hover, .child-cat a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}
.entry-header h1 {border-left: 5px solid #" . $color . ";border-right: 5px solid #" . $color . ";}
.slider-caption, .grid,icon-zan, .grid-cat, .header-sub h1, .cms-news-grid .marked-ico {background: #" . $color . ";}
@media screen and (min-width: 900px) {#scroll li a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}.custom-more a, .cat-more a,.author-m a {background: #" . $color . ";}}
@media screen and (max-width: 900px) {#navigation-toggle:hover,.nav-search:hover,.mobile-login a:hover,.nav-mobile:hover, {color: #" . $color . ";}}
@media screen and (min-width: 550px) {.pagination span.current, .pagination a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}}
@media screen and (max-width: 550px) {.pagination .prev,.pagination .next {background: #" . $color . ";}}
.single-content h3, .single-content .directory {border-left: 5px solid #" . $color . ";}
.resp-vtabs li.resp-tab-active {border-left: 2px solid #" . $color . "  !important;}
.page-links  a:hover span {background: #a3a3a3;border: 1px solid #a3a3a3;}
.single-content a:hover {color: #555;}
.ball-pulse > div{border: 1px solid #" . $color . ";}
#site-nav .down-menu > .current-menu-item > a{border-bottom: 2px solid #" . $color . ";}
.format-aside .post-format a:hover,.cat-more a:hover,.custom-more a:hover {color: #fff;}";
	}
	if ($styles) {
		echo "<style>" . $styles . "</style>";
	}
}

// 定制CSS
function modify_css(){
	custom_css();
}
function custom_css(){
	if (zm_get_option("custom_css")) {
		$css = substr(zm_get_option("custom_css"), 0);
		echo "<style>" . $css . "</style>";
	}
}

// 自定义宽度
function begin_width(){
	custom_width();
}
function custom_width(){
	if (zm_get_option("custom_width")) {
		$width = substr(zm_get_option("custom_width"), 0);
		echo "<style>#content, .header-sub, .top-nav, #top-menu, #mobile-nav, #main-search, #search-main, .breadcrumb, .footer-widget, .links-box, .g-col {width: " . $width . "px;}@media screen and (max-width: " . $width . "px) {#content, .breadcrumb, .footer-widget, .links-box, #top-menu, .top-nav, #main-search, #search-main, #mobile-nav, .header-sub, .breadcrumb, .g-col {width: 98%;}}</style>";
	}
}

// 缩略图宽度
function begin_thumbnail_width(){
	thumbnail_width();
}

function thumbnail_width(){
	if (zm_get_option("thumbnail_width")) {
		$thumbnail = substr(zm_get_option("thumbnail_width"), 0);
		echo "<style>.thumbnail {max-width: " . $thumbnail . "px;}@media screen and (max-width: 620px) {.thumbnail {max-width: 100px;}}</style>";
	}
}

// 调整信息位置
function zm_meta_left(){
	meta_left();
}

function meta_left(){
	if (zm_get_option("meta_left")) {
		$meta = substr(zm_get_option("meta_left"), 0);
		echo "<style>.entry-meta {left: " . $meta . "px;}@media screen and (max-width: 620px) {.entry-meta {left: 130px;}}</style>";
	}
}

// 后台添加文章ID
function ssid_column($cols) {
	$cols['ssid'] = 'ID';
	return $cols;
}

function ssid_value($column_name, $id) {
	if ($column_name == 'ssid')
		echo $id;
}

function ssid_return_value($value, $column_name, $id) {
	if ($column_name == 'ssid')
		$value = $id;
	return $value;
}

function ssid_css() {
?>
<style type="text/css">
	#ssid { width: 50px;} 
</style>
<?php 
}

function ssid_add() {
	add_action('admin_head', 'ssid_css');

	add_filter('manage_posts_columns', 'ssid_column');
	add_action('manage_posts_custom_column', 'ssid_value', 10, 2);

	add_filter('manage_pages_columns', 'ssid_column');
	add_action('manage_pages_custom_column', 'ssid_value', 10, 2);

	add_filter('manage_media_columns', 'ssid_column');
	add_action('manage_media_custom_column', 'ssid_value', 10, 2);

	add_filter('manage_link-manager_columns', 'ssid_column');
	add_action('manage_link_custom_column', 'ssid_value', 10, 2);

	add_action('manage_edit-link-categories_columns', 'ssid_column');
	add_filter('manage_link_categories_custom_column', 'ssid_return_value', 10, 3);

	foreach ( get_taxonomies() as $taxonomy ) {
		add_action("manage_edit-${taxonomy}_columns", 'ssid_column');
		add_filter("manage_${taxonomy}_custom_column", 'ssid_return_value', 10, 3);
	}

	add_action('manage_users_columns', 'ssid_column');
	add_filter('manage_users_custom_column', 'ssid_return_value', 10, 3);

	add_action('manage_edit-comments_columns', 'ssid_column');
	add_action('manage_comments_custom_column', 'ssid_value', 10, 2);
}