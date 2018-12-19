<?php
//更多精彩尽在http://www.reteng.org
if (function_exists('register_sidebar')){
	register_sidebar( array(
		'name'          => '博客布局侧边栏',
		'id'            => 'sidebar-h',
		'description'   => '显示在首页博客布局侧边栏',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '正文侧边栏',
		'id'            => 'sidebar-s',
		'description'   => '显示在文章正文及页面侧边栏',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '分类归档侧边栏',
		'id'            => 'sidebar-a',
		'description'   => '显示在文章归档页、搜索、404页侧边栏 ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '杂志布局侧边栏',
		'id'            => 'cms-s',
		'description'   => '只显示在杂志布局侧边栏',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '杂志单栏小工具',
		'id'            => 'cms-one',
		'description'   => '显示在首页CMS杂志布局',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '杂志两栏小工具',
		'id'            => 'cms-two',
		'description'   => '显示在首页CMS杂志布局',
		'before_widget' => '<div class="xl2"><aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside></div>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '正文底部小工具',
		'id'            => 'sidebar-e',
		'description'   => '显示在正文底部',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="s-icon"></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '公司主页“一栏”小工具',
		'id'            => 'group-one',
		'description'   => '显示在公司主页布局',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '公司主页“两栏”小工具',
		'id'            => 'group-two',
		'description'   => '显示在公司主页布局',
		'before_widget' => '<div class="xl2"><aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '公司主页“三栏”小工具',
		'id'            =>  'group-three',
		'description'   => '显示在公司主页布局',
		'before_widget' => '<div class="xl3"><aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '页脚小工具',
		'id'            => 'sidebar-f',
		'description'   => '显示在页脚',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="s-icon"></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '菜单页面',
		'id'            => 'all-cat',
		'description'   => '只适用于菜单页面模板，添加自定义菜单小工具',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '网址侧边栏',
		'id'            => 'favorites',
		'description'   => '只适用于网址分类法页面 ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => '网址单栏小工具',
		'id'            => 'favorites-one',
		'description'   => '显示网址页面',
		'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp" data-wow-delay="0.3s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

register_nav_menus(
	array(
		'primary' => '主要菜单',
		'header' => '顶部菜单',
		'mobile' => '移动端菜单'
	)
);

add_theme_support( 'custom-background' );
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link'
) );
require get_template_directory() . '/inc/function.php';
if (zm_get_option('languages_en')) {
add_action('after_setup_theme', 'begin_theme_setup');
function begin_theme_setup(){
	load_theme_textdomain( 'begin', get_template_directory() . '/languages' );
}
}
if ( ! zm_get_option('wp_title') ) {
	add_theme_support( 'title-tag' );

/** 兼容模式
function theme_slug_render_title() {
    echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
}
add_action( 'wp_head', 'theme_slug_render_title' );
 */
}
if (function_exists( 'is_shop' )) {
	add_theme_support( 'woocommerce' );
}
add_editor_style( '/css/editor-style.css' );
add_theme_support( 'automatic-feed-links' );
show_admin_bar(false);
function default_menu() {
	echo '<ul class="default-menu"><li><a href="'.home_url().'/wp-admin/nav-menus.php">设置菜单</a></li></ul>';
}
define( 'version', '2017.07.26' );

function zmingcx_scripts() {
	$my_theme = wp_get_theme();
	$theme_version = $my_theme->get( 'Version' );
	wp_enqueue_style( 'begin-style', get_stylesheet_uri(), array(), esc_attr( $theme_version ) );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/fonts/fonts.css', array(), version );
	if ( zm_get_option('iconfont_url')) {
		wp_enqueue_style( 'iconfontd', 'https:'.zm_get_option('iconfont_url'), array(), version );
	}
	if (zm_get_option('highlight')) {
		if ( is_singular() ) {
			wp_enqueue_style( 'highlight', get_template_directory_uri() . '/css/highlight.css', array(), version );
		}
	}
	if (function_exists( 'is_shop' )) {
		wp_enqueue_style( 'woo', get_template_directory_uri() . '/css/woo.css', array(), version );
	}
	if (function_exists( 'edd_get_actions' )) {
		wp_enqueue_style( 'edd', get_template_directory_uri() . '/css/edd.css', array(), version );
	}
	if (function_exists( 'dwqa_breadcrumb' )) {
		wp_enqueue_style( 'dw', get_template_directory_uri() . '/css/dw.css', array(), version );
	}
	if (function_exists( 'is_bbpress' )) {
		wp_enqueue_style( 'bbpress', get_template_directory_uri() . '/css/bbp.css', array(), version );
	}
	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.10.1', false );
		wp_enqueue_script( 'jquery' );
	}
	wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/slides.js', array(), version, true );
	if (zm_get_option('qr_img')) {
		wp_enqueue_script( 'jquery.qrcode.min', get_template_directory_uri() . '/js/jquery.qrcode.min.js', array(), version, true );
	}
	if (zm_get_option('wow_no')) {
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.js', array(), '0.1.9', true );
	}
	if (zm_get_option('sidebar_sticky')) {
		wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/sticky.js', array(), '1.6.0', true );
	}
	if (zm_get_option('search_cat')) {
		wp_enqueue_script( 'selectordie', get_template_directory_uri() . '/js/selectordie.js', array(), version, true );
	}
	wp_enqueue_script( 'jquery-ias', get_template_directory_uri() . '/js/jquery-ias.js', array(), '2.2.1', true );
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/jquery.lazyload.js', array(), version, true );
	wp_enqueue_script( 'tipso', get_template_directory_uri() . '/js/tipso.js', array(), '1.0.1', true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), version, true );
	wp_register_script( 'flexisel', get_template_directory_uri() . '/js/flexisel.js', array(), version, true );
	wp_enqueue_script( 'flexisel' );
	if ( is_singular() ) {
		if (zm_get_option('no_admin')) {
			wp_localize_script( 'script', 'wpl_ajax_url', get_template_directory_uri() . '/inc/admin-ajax.php');
		} else { 
			wp_localize_script( 'script', 'wpl_ajax_url', admin_url() . "admin-ajax.php");
		}
	}
	if (zm_get_option('comment_ajax')) {
		if ( is_singular() ) {
			wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.js', array(), version, true);
			if (zm_get_option('qt')) {
				wp_enqueue_script( 'comments-ajax-qt', get_template_directory_uri() . '/js/comments-ajax-qt.js', array(), version, true);
			} else {
				wp_enqueue_script( 'comments-ajax', get_template_directory_uri() . '/js/comments-ajax.js', array(), version, true);
			}
		}
	} else { 
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'zmingcx_scripts' );

function remove_footer_admin () {
    echo '<a href="http://www.reteng.org" target="_blank">ReTeng.ORG</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function footerscript() {
	wp_register_script( 'superfish', get_template_directory_uri() . "/js/superfish.js", array(), version, true );
	if (zm_get_option('gb2')) {
		wp_register_script( 'gb2big5', get_template_directory_uri() . "/js/gb2big5.js", array(), version, true );
	}
	if (zm_get_option('share')) {
		wp_register_script( 'bd_share', get_template_directory_uri() . "/js/bd-share.js", array(), version, true );
	}
	if (zm_get_option('group_carousel')) {
		wp_register_script( 'carousel', get_template_directory_uri() . "/js/carousel.min.js", array(), version, true );
	}
	if ( !is_admin() ) {
		wp_enqueue_script( 'superfish' );
		wp_enqueue_script( 'gb2big5' );
		wp_enqueue_script( 'carousel' );
		if ( is_singular() ) {
			wp_enqueue_script( 'bd_share' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'footerscript' );

// 全部结束

//添加HTML编辑器自定义快捷标签按钮
add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');
function bolo_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
QTags.addButton( 'v_notice', '绿框', '<blockquote id="sc_notice">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_error', '红框', '<blockquote id="sc_error">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_warn', '黄框', '<blockquote id="sc_warn">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_tips', '灰框', '<blockquote id="sc_tips">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_blue', '蓝框', '<blockquote id="sc_blue">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_black', '黑框', '<blockquote id="sc_black">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_xuk', '虚线', '<blockquote id="sc_xuk">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_lvb', '绿边', '<blockquote id="sc_lvb">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_redb', '红边', '<blockquote id="sc_redb">输入文字</blockquote>\n', "" );
QTags.addButton( 'v_organge', '橙边', '<blockquote id="sc_organge">输入文字</blockquote>\n', "" );
</script>
<?php
}

// 博客后台登录失败时发送邮件通知管理员
function wp_login_failed_notify()
{
    date_default_timezone_set('PRC');
    $admin_email = get_bloginfo('admin_email');
    $to = $admin_email;
    $subject = '【登录失败】有人使用了错误的用户名或密码登录『' . get_bloginfo('name') . '』';
    $message = '<span style="color:red; font-weight: bold;">『' . get_bloginfo('name') . '』有一条登录失败的记录产生，若登录操作不是您产生的，请及时注意网站安全！</span><br /><br />';
    $message .= '登录名：' . $_POST['log'];
    $message .= '<br />尝试的密码：' . $_POST['pwd'];
    $message .= '<br />登录的时间：' . date("Y-m-d H:i:s");
    $message .= '<br />登录的 IP：' . $_SERVER['REMOTE_ADDR'];
    $message .= '<br /><br />';
    $message .= '您可以： <a href="' . get_bloginfo('url') . '" target="_target">进入' . get_bloginfo('name') . '»</a>';
    wp_mail( $to, $subject, $message, "Content-Type: text/html; charset=UTF-8" );
}
add_action('wp_login_failed', 'wp_login_failed_notify');