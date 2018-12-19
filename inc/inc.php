<?php
// Ajax加载
function ajax_scroll_js() {
if ( !is_singular() && !is_paged() ) { ?>
<script type="text/javascript">var ias=$.ias({container:"#main",item:"article",pagination:"#nav-below",next:"#nav-below .nav-previous a",});ias.extension(new IASTriggerExtension({text:'<i class="be be-circledown"></i>更多',offset:<?php echo zm_get_option('scroll_n');?>,}));ias.extension(new IASSpinnerExtension());ias.extension(new IASNoneLeftExtension({text:'已是最后',}));ias.on('rendered',function(items){$("img").lazyload({effect: "fadeIn",failure_limit: 70});})</script>
<?php }
}

function ajax_c_scroll_js() {
if ( is_single() ) { ?>
<script type="text/javascript">var ias=$.ias({container:"#comments",item:".comment-list",pagination:".scroll-links",next:".scroll-links .nav-previous a",});ias.extension(new IASTriggerExtension({text:'<i class="be be-circledown"></i>更多',offset: 0,}));ias.extension(new IASSpinnerExtension());ias.extension(new IASNoneLeftExtension({text:'已是最后',}));ias.on('rendered',function(items){$("img").lazyload({effect: "fadeIn",failure_limit: 10});});</script>
<?php }
}

// 只搜索文章标题
function wpse_11826_search_by_title( $search, $wp_query ) {
	if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
		global $wpdb;
		$q = $wp_query->query_vars;
		$n = ! empty( $q['exact'] ) ? '' : '%';
		$search = array();
		foreach ( ( array ) $q['search_terms'] as $term )
			$search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
		if ( ! is_user_logged_in() )
			$search[] = "$wpdb->posts.post_password = ''";
		$search = ' AND ' . implode( ' AND ', $search );
	}
	return $search;
}

// gravatar头像调用
function cn_avatar($avatar) {
	$avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="http://cn.gravatar.com/avatar/$1?s=$2&d=mm" alt="avatar" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
	return $avatar;
}

function ssl_avatar($avatar) {
	$avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" alt="avatar" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
	return $avatar;
}

if (zm_get_option('no') !== 'no') :
	if (!zm_get_option('gravatar_url') || (zm_get_option("gravatar_url") == 'cn')) {
		add_filter('get_avatar', 'cn_avatar');
	}

	if (zm_get_option('gravatar_url') == 'ssl') {
		add_filter('get_avatar', 'ssl_avatar');
	}
endif;

// 标签
require get_template_directory() . '/inc/tag-letter.php';

// 字数统计
function count_words ($text) {
	global $post;
	if ( '' == $text ) {
		$text = $post->post_content;
		if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= ''.sprintf(__( '共', 'begin' )).' ' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') . ' '.sprintf(__( '字', 'begin' )).'';
		return $output;
	}
}

// 分类优化
function zm_category() {
	$category = get_the_category();
	if($category[0]){
	echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
	}
}

// 索引
function zm_get_current_count() {
	global $wpdb;
	$current_post = get_the_ID();
	$query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
	$query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
	$query .= " WHERE post_status='publish' AND meta_key='zm_like' AND post_id = '".$current_post."'";
	$results = $wpdb->get_results($query);
	if ($results) {
		foreach ($results as $o):
			echo $o->meta_value;
		endforeach;
	}else {echo( '0' );}
}

if (zm_get_option('index_c')) {
// 目录
function article_catalog($content) {
	$matches = array();
	$ul_li = '';
	$r = "/<h4>([^<]+)<\/h4>/im";

	if(preg_match_all($r, $content, $matches)) {
		foreach($matches[1] as $num => $title) {
			$content = str_replace($matches[0][$num], '<span class="directory"></span><h4 id="title-'.$num.'">'.$title.'</h4>', $content);
			$ul_li .= '<li><i class="be be-arrowright"></i> <a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
		}
		$content = "
			\n<div id=\"log-box\">
				<div id=\"catalog\"><ul id=\"catalog-ul\">\n" . $ul_li . "</ul><span class=\"log-zd\"><span class=\"log-close\"><a title=\"" . sprintf(__( '隐藏目录', 'begin' )) . "\"><i class=\"be be-cross\"></i><strong>" . sprintf(__( '目录', 'begin' )) . "</strong></a></span></span></div>
			</div>\n" . $content;
	}
	return $content;
}
add_filter( "the_content", "article_catalog" );
}

if (zm_get_option('tag_c')) {
// 关键词加链接
$match_num_from = 1; //一个关键字少于多少不替换
$match_num_to = zm_get_option('chain_n');

add_filter('the_content','tag_link',1);

function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}

function tag_link($content){
global $match_num_from,$match_num_to;
$posttags = get_the_tags();
	if ($posttags) {
		usort($posttags, "tag_sort");
		foreach($posttags as $tag) {
			$link = get_tag_link($tag->term_id);
			$keyword = $tag->name;
			if (preg_match_all('|(<h[^>]+>)(.*?)'.$keyword.'(.*?)(</h[^>]*>)|U', $content, $matchs)) {continue;}
			if (preg_match_all('|(<a[^>]+>)(.*?)'.$keyword.'(.*?)(</a[^>]*>)|U', $content, $matchs)) {continue;}

			$cleankeyword = stripslashes($keyword);
			$url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('查看与 %s 相关的文章', 'begin' ))."\"";
			$url .= ' target="_blank"';
			$url .= ">".addcslashes($cleankeyword, '$')."</a>";
			$limit = rand($match_num_from,$match_num_to);

			$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$cleankeyword = preg_quote($cleankeyword,'\'');
			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
			$content = preg_replace($regEx,$url,$content,$limit);
			$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
		}
	}
	return $content;
}
}
// 添加视频
function my_videos( $atts, $content = null ) {
	extract( shortcode_atts( array (
		'href' => '',
		 'img' => '<img class="aligncenter" src="'.$content.'">'
	), $atts ) );
	return '<div class="video-content"><a class="videos" href="'.$href.'" title="播放视频">'.$img.'<i class="be be-play"></i></a></div>';
}

// 评论可见
function reply_read($atts, $content=null) {
	extract(shortcode_atts(array("notice" => '
	<div class="reply-read">
		<div class="reply-ts">
			<div class="read-sm"><i class="be be-info"></i>' . sprintf(__( '此处为隐藏的内容！', 'begin' )) . '</div>
			<div class="read-sm"><i class="be be-loader"></i>' . sprintf(__( '发表评论并刷新，才能查看', 'begin' )) . '</div>
		</div>
		<div class="read-pl"><a href="#respond"><i class="be be-speechbubble"></i>' . sprintf(__( '发表评论', 'begin' )) . '</a></div>
		<div class="clear"></div>
    </div>'), $atts));
	$email = null;
	$user_ID = (int) wp_get_current_user()->ID;
	if ($user_ID > 0) {
		$email = get_userdata($user_ID)->user_email;
		if ( current_user_can('level_10') ) {
			return '<p class="secret-password"><i class="be be-clipboard"></i>隐藏的内容：<br />'.do_shortcode( $content ).'</p>';
		}
	} else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
		$email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
	} else {
		return $notice;
	}
    if (empty($email)) {
		return $notice;
	}
	global $wpdb;
	$post_id = get_the_ID();
	$query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
	if ($wpdb->get_results($query)) {
		return do_shortcode('<p class="secret-password"><i class="be be-clipboard"></i>隐藏的内容：<br />'.do_shortcode( $content ).'</p>');
	} else {
		return $notice;
	}
}

// 登录可见
function login_to_read($atts, $content = null) {
	extract(shortcode_atts(array("notice" =>'
	<div class="reply-read">
		<div class="reply-ts">
			<div class="read-sm"><i class="be be-info"></i>' . sprintf(__( '此处为隐藏的内容！', 'begin' )) . '</div>
			<div class="read-sm"><i class="be be-loader"></i>' . sprintf(__( '登录后才能查看！', 'begin' )) . '</div>
		</div>
		<div class="read-pl"><a href="#login" class="flatbtn" id="login-see" ><i class="be be-timerauto"></i>' . sprintf(__( '登录', 'begin' )) . '</a></div>
		<div class="clear"></div>
	</div>'), $atts));
	if (is_user_logged_in()) {
		return do_shortcode( $content );
	} else {
		return $notice;
	}
}

// 加密内容
function secret($atts, $content=null){
extract(shortcode_atts(array('key'=>null), $atts));
if ( current_user_can('level_10') ) {
	return '<p class="secret-password"><i class="be be-clipboard"></i>加密的内容：<br />'.do_shortcode( $content ).'</p>';
}
if(isset($_POST['secret_key']) && $_POST['secret_key']==$key){
	return '<p class="secret-password"><i class="be be-clipboard"></i>加密的内容：<br />'.do_shortcode( $content ).'</p>';
	} else {
		return '
		<form class="post-password-form" action="'.get_permalink().'" method="post">
			<div class="post-secret"><i class="be be-info"></i>' . sprintf(__( '输入密码查看加密内容：', 'begin' )) . '</div>
			<p>
				<input id="pwbox" type="password" size="20" name="secret_key">
				<input type="submit" value="' . sprintf(__( '提交', 'begin' )) . '" name="Submit">
			</p>
		</form>	';
	}
}

// 解压密码
function reply_password($atts, $content=null) {
	extract(shortcode_atts(array("notice" => '<div class="reply_pass">' . sprintf(__( '<strong>下载密码：</strong>发表评论并刷新可见！', 'begin' )) . '</div>'), $atts));
	$email = null;
	$user_ID = (int) wp_get_current_user()->ID;
	if ($user_ID > 0) {
		$email = get_userdata($user_ID)->user_email;
		if ( current_user_can('level_10') ) {return ''.do_shortcode( $content ).'';}
	} else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
		$email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
	} else {
		return $notice;
	}
    if (empty($email)) {
		return $notice;
	}
	global $wpdb;
	$post_id = get_the_ID();
	$query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
	if ($wpdb->get_results($query)) {
		return do_shortcode(''.do_shortcode( $content ).'');
	} else {
		return $notice;
	}
}

// 图片alt
if (zm_get_option('image_alt')) {
function image_alt($c) {
	global $post;
	$title = $post->post_title;
	$s = array('/src="(.+?.(jpg|bmp|png|jepg|gif))"/i' => 'src="$1" alt="'.$title.'"');
	foreach($s as $p => $r){
	$c = preg_replace($p,$r,$c);
	}
	return $c;
}
add_filter( 'the_content', 'image_alt' );
}

// 形式名称
function begin_post_format( $safe_text ) {
	if ( $safe_text == '引语' )
		return '软件';
	return $safe_text;
}

// 分页
function begin_pagenav() {
if (zm_get_option('scroll')) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<div class="nav-next"><?php previous_posts_link(''); ?></div>
			<div class="nav-previous"><?php next_posts_link(''); ?></div>
		</nav>
	<?php endif;
}
	the_posts_pagination( array(
		'mid_size'           => 4,
		'prev_text'          => '<i class="be be-arrowleft"></i>',
		'next_text'          => '<i class="be be-arrowright"></i>',
		'before_page_number' => '<span class="screen-reader-text">'.sprintf(__( '第', 'begin' )).' </span>',
		'after_page_number'  => '<span class="screen-reader-text"> '.sprintf(__( '页', 'begin' )).'</span>',
	) );
}

// 面包屑导航
function begin_breadcrumb() {
		if (is_home()) {
			if ( zm_get_option('bulletin') ) {
				echo '<div class="bull">';
				echo '<i class="be be-volumedown"></i>';
				echo "</div>";
				get_template_part( 'template/bulletin' );
			} else {
				echo '<i class="be be-home"></i>' . sprintf(__( '现在位置', 'begin' )) . '<i class="be be-arrowright"></i>' . sprintf(__( '首页', 'begin' )) . '';
			}
		}

		if ( !is_home() && !is_front_page() ) {
			echo '<a class="crumbs" href="';
			echo home_url('/');
			echo '">';
			echo '<i class="be be-home"></i>' . sprintf(__( '首页', 'begin' )) . '';
			echo "</a>";
		}

		if ( !is_search() ) {
			if ( is_category() ) {
				echo '<i class="be be-arrowright"></i>';
				echo get_category_parents( get_query_var('cat') , true , '<i class="be be-arrowright"></i>' );
				echo '' . sprintf(__( '文章', 'begin' )) . ' ';
			}
		}

		if ( is_tax('notice') ) {
			echo '<i class="be be-arrowright"></i>';
			
		}
		if ( is_tax('gallery') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('gallerytag') ) {
			echo '<i class="be be-arrowright"></i>';
			echo setTitle();
		}

		if ( is_tax('videos') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('videotag') ) {
			echo '<i class="be be-arrowright"></i>';
			echo setTitle();
		}

		if ( is_tax('taobao') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('taotag') ) {
			echo '<i class="be be-arrowright"></i>';
			echo setTitle();
		}

		if ( is_tax('products') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('product_cat') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('product_tag') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('favorites') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if (function_exists( 'is_shop' )) {
			if ( zm_get_option('woo') ) {
				if ( is_shop('shop') && !is_front_page() ) {
					echo '<i class="be be-arrowright"></i>';
					echo trim( wp_title( '',0 ) );
				}
			}
		}

		if ( is_tax('download_category') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('download_tag') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('dwqa-question_category') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if ( is_tax('dwqa-question_tag') ) {
			echo '<i class="be be-arrowright"></i>';
		}

		if (is_single()) {
			echo '<i class="be be-arrowright"></i>';
			echo the_category('<i class="be be-arrowright"></i>', 'multiple');
			if ( 'post' == get_post_type() ) {
				echo '<i class="be be-arrowright"></i>';
				echo '' . the_title() . '';
			}
			if (is_attachment() ) {	echo '' . sprintf(__( '附件', 'begin' )) . ''; }
		}

		if ( is_page() && !is_front_page() ) {
			echo '<i class="be be-arrowright"></i>';
			echo the_title();
		}

		if ( is_page() && is_front_page() ) {
			if (zm_get_option('bulletin')) {
				echo '<div class="bull">';
				echo '<i class="be be-volumedown"></i>';
				echo "</div>";
				get_template_part( 'template/bulletin' );
			} else {
				echo '<i class="be be-home"></i>' . sprintf(__( '现在位置', 'begin' )) . '<i class="be be-arrowright"></i>' . sprintf(__( '首页', 'begin' )) . '';
			}
		}

	elseif ( is_tag() ) {echo '<i class="be be-arrowright"></i>';single_tag_title();echo '<i class="be be-arrowright"></i>文章 ';}
	elseif ( is_day() ) {echo '<i class="be be-arrowright"></i>';echo"发表于"; the_time('Y年m月d日'); echo'的文章';}
	elseif ( is_month() ) {echo '<i class="be be-arrowright"></i>';echo"发表于"; the_time('Y年m月'); echo'的文章';}
	elseif ( is_year() ) {echo '<i class="be be-arrowright"></i>';echo"发表于"; the_time('Y年'); echo'的文章';}
	elseif ( is_author() ) {echo '<i class="be be-arrowright"></i>';echo wp_title( ''); echo'发表的文章';}
	elseif ( is_404() ) {echo '<i class="be be-arrowright"></i>';echo'' . sprintf(__( '亲，你迷路了！', 'begin' )) . ''; echo'';}
	elseif ( is_search()) {
		echo '<i class="be be-arrowright"></i>' . sprintf(__( '搜索', 'begin' )) . ' ';
		echo '<i class="be be-arrowright"></i>';
		echo get_template_part( 'inc/crumb-search' );
	}
}

// 文章信息
function begin_entry_meta() {
	if ( ! is_single() ) :
	echo '<span class="date">';
		time_ago( $time_type ='post' );
	echo '</span>';
	if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views"><i class="be be-eye"></i> ','</span>' ); }
	if ( post_password_required() ) { 
		echo '<span class="comment"><a href=""><i class="icon-scroll-c"></i> ' . sprintf(__( '密码保护', 'begin' )) . '</a></span>';
	} else {
		echo '<span class="comment">';
			comments_popup_link( '<span class="no-comment"><i class="be be-speechbubble"></i> ' . sprintf(__( '发表评论', 'begin' )) . '</span>', '<i class="be be-speechbubble"></i> 1 ', '<i class="be be-speechbubble"></i> %' );
		echo '</span>';
	}
 	else :

	echo '<ul class="single-meta">';
		edit_post_link('' . sprintf(__( '编辑', 'begin' )) . '', '<li class="edit-link">', '</li>' );

		echo '<li class="print"><a href="javascript:printme()" target="_self" title="' . sprintf(__( '打印', 'begin' )) . '"><i class="be be-print"></i></a></li>';

		if ( post_password_required() ) { 
			echo '<li class="comment"><a href="#comments">' . sprintf(__( '密码保护', 'begin' )) . '</a></li>';
		} else {
			echo '<li class="comment">';
				comments_popup_link( '<i class="be be-speechbubble"></i> ' . sprintf(__( '发表评论', 'begin' )) . '', '<i class="be be-speechbubble"></i> 1 ', '<i class="be be-speechbubble"></i> %' );
			echo '</li>';
		}

		if( function_exists( 'the_views' ) ) { the_views(true, '<li class="views"><i class="be be-eye"></i> ','</li>');  }
		echo '<li class="r-hide"><a href="#"><span class="off-side"></span></a></li>';
	echo '</ul>';

	echo '<ul id="fontsize"><li>A+</li></ul>';
	echo '<div class="single-cat-tag">';
		echo '<div class="single-cat">' . sprintf(__( '所属分类', 'begin' )) . '：';
			the_category( ' ' );
		echo '</div>';
	echo '</div>';

	endif;
}

// 日志信息
function begin_format_meta() {
	echo '<span class="date">';
		time_ago( $time_type ='post' );
	echo '</span>';
	echo '<span class="format-cat"><i class="be be-folder"></i> ';
		zm_category();
	echo '</span>';
	if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views"><i class="be be-eye"></i> ','</span>' ); }
	if ( post_password_required() ) { 
		echo '<span class="comment"><a href=""><i class="icon-scroll-c"></i> ' . sprintf(__( '密码保护', 'begin' )) . '</a></span>';
	} else {
		echo '<span class="comment">';
			comments_popup_link( '<span class="no-comment"><i class="be be-speechbubble"></i> ' . sprintf(__( '发表评论', 'begin' )) . '</span>', '<i class="be be-speechbubble"></i> 1 ', '<i class="be be-speechbubble"></i> %' );
		echo '</span>';
	}
}

function begin_single_meta() {
	echo '<div class="begin-single-meta">';
		echo '<span class="my-date"><i class="be be-schedule"></i> ';
		time_ago( $time_type ='posts' );
		echo '</span>';
		if ( post_password_required() ) { 
			echo '<span class="comment"><a href="#comments">' . sprintf(__( '密码保护', 'begin' )) . '</a></li>';
		} else {
			echo '<span class="comment">';
				comments_popup_link( '<i class="be be-speechbubble"></i> ' . sprintf(__( '发表评论', 'begin' )) . '', '<i class="be be-speechbubble"></i> 1 ', '<i class="be be-speechbubble"></i> %' );
			echo '</span>';
		}
		if( function_exists( 'the_views' ) ) { the_views(true, '<span class="views"><i class="be be-eye"></i> ','</span>');  }
		echo '<span class="print"><a href="javascript:printme()" target="_self" title="' . sprintf(__( '打印', 'begin' )) . '"><i class="be be-print"></i></a></span>';
		edit_post_link('' . sprintf(__( '编辑', 'begin' )) . '', '<span class="edit-link">', '</span>' );
		echo '<span class="s-hide"><a href="#"><span class="off-side"></span></a></span>';
	echo '</div>';
}

function begin_single_cat() {
	echo '<ul id="fontsize"><li>A+</li></ul>';
	echo '<div class="single-cat-tag">';
		echo '<div class="single-cat">' . sprintf(__( '所属分类', 'begin' )) . '：';
			the_category( ' ' );
		echo '</div>';
	echo '</div>';
}

// 页面信息
function begin_page_meta() {
	echo '<ul class="single-meta">';
		edit_post_link('' . sprintf(__( '编辑', 'begin' )) . '', '<li class="edit-link">', '</li>' );
		echo '<li class="print"><a href="javascript:printme()" target="_self" title="' . sprintf(__( '打印', 'begin' )) . '"><i class="be be-print"></i></a></li>';
		echo '<li class="comment">';
		comments_popup_link( '<i class="be be-speechbubble"></i> ' . sprintf(__( '发表评论', 'begin' )) . '', '<i class="be be-speechbubble"></i> 1 ', '<i class="be be-speechbubble"></i> %' );
		echo '</li>';
		if( function_exists( 'the_views' ) ) { the_views(true, '<li class="views"><i class="be be-eye"></i> ','</li>');  }
		echo '<li class="r-hide"><a href="#"><span class="off-side"></span></a></li>';
	echo '</ul>';
	echo '<ul id="fontsize">A+</ul>';
}

// 其它信息
function begin_grid_meta() {
	echo '<span class="date">';
		the_time( 'm/d' ); 
	echo '</span>';
	if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views"><i class="be be-eye"></i> ','</span>' ); }
	if ( post_password_required() ) { 
		echo '<span class="comment"><a href=""><i class="icon-scroll-c"></i> ' . sprintf(__( '密码保护', 'begin' )) . '</a></span>';
	} else {
		echo '<span class="comment">';
			comments_popup_link( '<span class="no-comment"><i class="be be-speechbubble"></i> ' . sprintf(__( '发表评论', 'begin' )) . '</span>', '<i class="be be-speechbubble"></i> 1 ', '<i class="be be-speechbubble"></i> %' );
		echo '</span>';
	}
}

// 点击最多文章
function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title =  get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a></li>";
			$i++;
		}
	} else {
		$temp = '<li>暂无文章</li>';
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}

// 热门文章
function get_timespan_most_viewed_img($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
			echo "<li>";
			echo "<span class='thumbnail'>";
			echo zm_thumbnail();
			echo "</span>"; 
			echo the_title( sprintf( '<span class="new-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span>' ); 
			echo "<span class='date'>";
			echo the_time('m/d');
			echo "</span>";
			echo the_views( true, '<span class="views"><i class="be be-eye"></i> ','</span>');
			echo "</li>"; 
		}
	}
}

function get_timespan_most_viewed_img_h($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
			echo "<li>";
			echo "<span class='thumbnail'>";
			echo zm_thumbnail_h();
			echo "</span>"; 
			echo the_title( sprintf( '<span class="new-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span>' ); 
			echo "<span class='date'>";
			echo the_time('m/d');
			echo "</span>";
			echo the_views( true, '<span class="views"><i class="be be-eye"></i> ','</span>');
			echo "</li>"; 
		}
	}
}

// 时间
if (zm_get_option('meta_time')) {
function time_ago( $time_type ){
	switch( $time_type ){
		case 'comment': //评论时间
				printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time());
			break;
		case 'post'; //日志时间
				echo get_the_date();
			break;
		case 'posts'; //日志时间年
				echo get_the_date();
				echo '<i class="i-time">' . get_the_time('H:i:s') . '</i>';
			break;
	}
}
} else { 
function time_ago( $time_type ){
	switch( $time_type ){
		case 'comment': //评论时间
			$time_diff = current_time('timestamp') - get_comment_time('U');
			if( $time_diff <= 300 )
				echo ('刚刚');
			elseif(  $time_diff>=300 && $time_diff <= 86400 ) //24 小时之内
				echo human_time_diff(get_comment_time('U'), current_time('timestamp')).'前';
			else
				printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time());
			break;
		case 'post'; //日志时间
			$time_diff = current_time('timestamp') - get_the_time('U');
			if( $time_diff <= 300 )
				echo ('刚刚');
			elseif(  $time_diff>=300 && $time_diff <= 86400 ) //24 小时之内
				echo human_time_diff(get_the_time('U'), current_time('timestamp')).'前';
			else
				echo the_time( 'm月d日' );
			break;
		case 'posts'; //日志时间年
			//$time_diff = current_time('timestamp') - get_the_time('U');
			//if( $time_diff <= 300 )
				//echo ('刚刚');
			//elseif(  $time_diff>=300 && $time_diff <= 86400 ) //24 小时之内
				//echo human_time_diff(get_the_time('U'), current_time('timestamp')).'前';
			//else
				echo get_the_date();
				echo '<i class="i-time">' . get_the_time('H:i:s') . '</i>';
			break;
	}
}
}
// 幻灯
function gallery($atts, $content=null){
	return '<div id="gallery" class="slide-h"><div class="rslides" id="slide">'.$content.'</div></div>
	<div class="img-n">共<span class="myimg"></span></div>
	<script type="text/javascript" src="'.get_template_directory_uri().'/js/slides.js"></script>';
}

function image($atts, $content=null){
extract(shortcode_atts(array('h'=>null), $atts));
	return '<div id="gallery" class="slides-h" style="height:'.$h.'px"><div class="rslides" id="slides">'.$content.'</div></div>
	<div class="img-n">共<span class="mimg"></span></div>
	<script type="text/javascript" src="'.get_template_directory_uri().'/js/slides.js"></script>';
}

// 下载按钮
function button_a($atts, $content = null) {
	return '<div class="down"><a class="d-popup" title="下载链接" href="#button_file"><i class="be be-download"></i>下载地址</a><div class="clear"></div></div>';
}

// 自定义按钮
function button_b($atts, $content = null) {
	return '<div class="down"><a class="d-popup" title="下载链接" href="#button_file"><i class="be be-download"></i>'.$content.'</a><div class="clear"></div></div>';
}

// 链接按钮
function button_url($atts,$content=null){
	extract(shortcode_atts(array("href"=>'http://'),$atts));
	return '<div class="down down-link"><a href="'.$href.'" rel="external nofollow" target="_blank"><i class="be be-download"></i>'.$content.'</a><div class="clear"></div></div><div class="down-line"></div>';
}

// fieldset标签
function fieldset_label($atts, $content = null) {
	return $content;
}

// 添加<code>
function addcode($atts, $content=null, $code="") {
 $return = '<code>';
 $return .= $content;
 $return .= '</code>';
 return $return;
}
add_shortcode('code' , 'addcode');

//点赞最多文章
function get_like_most($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS zm_like FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'zm_like' AND post_password = '' ORDER  BY zm_like DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_like = intval($post->like);
			$post_like = number_format($post_like);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a></li>";
			$i++;
		}
	} else {
		$temp = '<li>暂无文章</li>';
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}

// 点赞最多有图
function get_like_most_img($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS zm_like FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'zm_like' AND post_password = '' ORDER  BY zm_like DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_like = intval($post->like);
			$post_like = number_format($post_like);
			echo "<li>";
			echo "<span class='thumbnail'>";
			echo zm_thumbnail();
			echo "</span>";
			echo the_title( sprintf( '<span class="new-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span>' );
			echo "<span class='discuss'><i class='be be-thumbs-up-o'>&nbsp;";
			echo zm_get_current_count();
			echo "</i></span>";
			echo "<span class='date'>";
			echo the_time( 'm/d' );
			echo "</span>";
			echo "</li>";
		}
	}
}

function get_like_most_img_h($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS zm_like FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'zm_like' AND post_password = '' ORDER  BY zm_like DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_like = intval($post->like);
			$post_like = number_format($post_like);
			echo "<li>";
			echo "<span class='thumbnail'>";
			echo zm_thumbnail_h();
			echo "</span>";
			echo the_title( sprintf( '<span class="new-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span>' );
			echo "<span class='discuss'><i class='be be-thumbs-up-o'>&nbsp;";
			echo zm_get_current_count();
			echo "</i></span>";
			echo "<span class='date'>";
			echo the_time( 'm/d' );
			echo "</span>";
			echo "</li>";
		}
	}
}

// 文字展开
function show_more($atts, $content = null) {
	return '<span class="show-more" title="' . (__( '文字折叠', 'begin' )) . '"><span><i class="be be-squareplus"></i>' . sprintf(__( '展开', 'begin' )) . '</span></span>';
}

function section_content($atts, $content = null) {
	return '<div class="section-content">'.do_shortcode( $content ).'</p></div><p>';
}

// 短代码广告
function post_ad(){

if ( wp_is_mobile() ) {
		return '<div class="post-ad"><div class="ad-m ad-site">'.stripslashes( zm_get_option('ad_s_z_m') ).'</div></div>';
	} else {
		return '<div class="post-ad"><div class="ad-pc ad-site">'.stripslashes( zm_get_option('ad_s_z') ).'</div></div>';
	}
}
// 点赞
function begin_ding(){
	global $wpdb,$post;
	$id = $_POST["um_id"];
	$action = $_POST["um_action"];
	if ( $action == 'ding'){
		$bigfa_raters = get_post_meta($id,'zm_like',true);
		$expire = time() + 99999999;
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
		setcookie('zm_like_'.$id,$id,$expire,'/',$domain,false);
		if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
			update_post_meta($id, 'zm_like', 1);
		}
		else {
			update_post_meta($id, 'zm_like', ($bigfa_raters + 1));
		}
		echo get_post_meta($id,'zm_like',true);
	}
	die;
}

if (zm_get_option('baidu_submit')) {
// 主动推送
if(!function_exists('Baidu_Submit')){
    function Baidu_Submit($post_ID) {
		$WEB_DOMAIN = get_option('home');
		if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
		$url = get_permalink($post_ID);
		$api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.zm_get_option('token_p');
		$request = new WP_Http;
		$result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
		$result = json_decode($result['body'],true);
		if (array_key_exists('success',$result)) {
		    add_post_meta($post_ID, 'Baidusubmit', 1, true);
		}
	}
	add_action('publish_post', 'Baidu_Submit', 0);
}
}

// 评论贴图
if (zm_get_option('embed_img')) {
add_action('comment_text', 'comments_embed_img', 2);
}
function comments_embed_img($comment) {
	$size = auto;
	$comment = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img src="$1" alt="评论" style="width:'.$size.'; height:'.$size.'" />', $comment);
	return $comment;
}

// title
if (zm_get_option('wp_title')) {
} else {
function begin_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	$title .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'begin_wp_title', 10, 2 );
}

if (zm_get_option('refused_spam')) {
	// 禁止无中文留言
	if ( current_user_can('level_10') ) {
	} else {
	function refused_spam_comments( $comment_data ) {
		$pattern = '/[一-龥]/u';  
		if(!preg_match($pattern,$comment_data['comment_content'])) {
			err('评论必须含中文！');
		}
		return( $comment_data );
	}
	add_filter('preprocess_comment','refused_spam_comments');
	}
}
// @回复
if (zm_get_option('at')) {
function comment_at( $comment_text, $comment = '') {
	if( $comment->comment_parent > 0) {
		$comment_text = '<span class="at">@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a></span> ' . $comment_text;
	}
	return $comment_text;
}
add_filter( 'comment_text' , 'comment_at', 20, 2);
}

// 表情
function begin_smilies_src( $old, $img ) {
    return get_stylesheet_directory_uri().'/img/smilies/'.$img;
}
function begin_smilies(){
	global $wpsmiliestrans;
	$wpsmiliestrans = array(
		':mrgreen:' => 'icon_mrgreen.gif',
		':neutral:' => 'icon_neutral.gif',
		':twisted:' => 'icon_twisted.gif',
		  ':arrow:' => 'icon_arrow.gif',
		  ':shock:' => 'icon_eek.gif',
		  ':smile:' => 'icon_smile.gif',
		    ':???:' => 'icon_confused.gif',
		   ':cool:' => 'icon_cool.gif',
		   ':evil:' => 'icon_evil.gif',
		   ':grin:' => 'icon_biggrin.gif',
		   ':idea:' => 'icon_idea.gif',
		   ':oops:' => 'icon_redface.gif',
		   ':razz:' => 'icon_razz.gif',
		   ':roll:' => 'icon_rolleyes.gif',
		   ':wink:' => 'icon_wink.gif',
		    ':cry:' => 'icon_cry.gif',
		    ':eek:' => 'icon_surprised.gif',
		    ':lol:' => 'icon_lol.gif',
		    ':mad:' => 'icon_mad.gif',
		    ':sad:' => 'icon_sad.gif',
		      '8-)' => 'icon_cool.gif',
		      '8-O' => 'icon_eek.gif',
		      ':-(' => 'icon_sad.gif',
		      ':-)' => 'icon_smile.gif',
		      ':-?' => 'icon_confused.gif',
		      ':-D' => 'icon_biggrin.gif',
		      ':-P' => 'icon_razz.gif',
		      ':-o' => 'icon_surprised.gif',
		      ':-x' => 'icon_mad.gif',
		      ':-|' => 'icon_neutral.gif',
		      ';-)' => 'icon_wink.gif',
		       '8O' => 'icon_eek.gif',
		       ':(' => 'icon_sad.gif',
		       ':)' => 'icon_smile.gif',
		       ':?' => 'icon_confused.gif',
		       ':D' => 'icon_biggrin.gif',
		       ':P' => 'icon_razz.gif',
		       ':o' => 'icon_surprised.gif',
		       ':x' => 'icon_mad.gif',
		       ':|' => 'icon_neutral.gif',
		       ';)' => 'icon_wink.gif',
		      ':!:' => 'icon_exclaim.gif',
		      ':?:' => 'icon_question.gif',
	);

	remove_action( 'wp_head' , 'print_emoji_detection_script', 7 );
	add_filter( 'smilies_src' , 'begin_smilies_src' , 10 , 2 );
}

// 浏览总数
function all_view(){
global $wpdb;
$count=0;
$views= $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='views'");
foreach($views as $key=>$value)
	{
		$meta_value=$value->meta_value;
		if($meta_value!=' '){
			$count+=(int)$meta_value;
		}
	}
return $count;
}

// 编辑_blank
function autoblank($text) {
	$return = str_replace('<a', '<a target="_blank"', $text);
	return $return;
}
add_filter('edit_post_link', 'autoblank');

// 登录
function custom_login_head(){
$imgurl=zm_get_option('login_img');
$logourl=zm_get_option('logo');
echo'<style type="text/css">
body{
	font-family: "Microsoft YaHei", Helvetica, Arial, Lucida Grande, Tahoma, sans-serif;
	background: url('.$imgurl.');
	width:100%;
	height:100%;
}
.login h1 a {
	background:url('.$logourl.') no-repeat;
	background-size: 220px 50px;
	width: 220px;
	height: 50px;
	padding: 0;
	margin: 0 auto 1em;
}
.login form, .login .message {
	background: #fff;
	background: rgba(255, 255, 255, 0.6);
	border-radius: 2px;
	border: 1px solid #fff;
}
.login label {
	color: #000;
	font-weight: bold;
}
.login .message {
	color: #000;
}
#backtoblog a, #nav a {
	color: #fff !important;
}
</style>';

}
if (zm_get_option('custom_login')) {
	add_action('login_head', 'custom_login_head');
}

// 登录提示
function  zm_login_title() {
	return '欢迎您光临本站！';
}
add_filter('login_headertitle', 'zm_login_title');
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));

// 添加按钮
function begin_select(){
echo '
<select id="sc_select">
	<option value="您需要选择一个短代码">插入短代码</option>
	<option value="[button]按钮名称[/button]">下载链接</option>
	<option value="[url href=链接地址]按钮名称[/url]">链接按钮</option>
	<option value="[videos href=视频代码]图片链接[/videos]">添加视频</option>
	<option value="[img]插入图片[/img]">添加相册</option>
	<option value="[reply]隐藏的内容[/reply]">回复可见</option>
	<option value="[login]隐藏的内容[/login]">登录可见</option>
	<option value="[password key=密码]加密的内容[/password]">密码保护</option>
	<option value="[code]代码[/code]">添加代码</option>
	<option value="[s][p]隐藏的文字[/p]">文字折叠</option>
	<option value="<fieldset><legend>我是标题</legend>这里是内容</fieldset>">fieldset标签</option>
	<option value="[ad]">插入广告</option>
</select>';
}

function begin_button() {
echo '<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#sc_select").change(function() {
	send_to_editor(jQuery("#sc_select :selected").val());
	return false;
	});
});
</script>';
}

// 可视化按钮

function begin_tinymce_button() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		add_filter( 'mce_buttons', 'begin_register_tinymce_button' );
		add_filter( 'mce_external_plugins', 'begin_add_tinymce_button' );
	}
}

function begin_register_tinymce_button( $buttons ) {
	array_push( $buttons, "down", "url", "videos", "img", "reply", "login", "password", "addcode", "addfolding", "field", "ad" );
	return $buttons;
}

function begin_add_tinymce_button( $plugin_array ) {
	$plugin_array['begin_button_script'] = get_bloginfo( 'template_url' ) . '/js/buttons.js';
	return $plugin_array;
}

// 列表按钮
function spces_code_plugin() {
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
		return;
	}
	if (get_user_option('rich_editing') == 'true') {
		add_filter('mce_external_plugins', 'specs_mce_external_plugins_filter');
		add_filter('mce_buttons', 'specs_mce_buttons_filter');
	}
}

function specs_mce_external_plugins_filter($plugin_array) {
	$plugin_array['specs_code_plugin'] = get_template_directory_uri() . '/inc/addlist/list-btn.js';
	return $plugin_array;
}

function specs_mce_buttons_filter($buttons) {
	array_push($buttons, 'specs_code_plugin');
	return $buttons;
}

add_shortcode('wplist', 'wplist_shortcode');
function wplist_shortcode($atts, $content = '') {
	$atts['content'] = $content;
	$out = '<div class="wplist-item"><a href="' . $atts['link'] . '" target="_blank" isconvert="1" rel="nofollow" >';
	$out.= '<div class="wplist-item-img"><img itemprop="image" src="' . $atts['img'] . '" alt="' . $atts['title'] . '" /></div>';
	$out.= '<div class="wplist-title">' . $atts['title'] . '</div>';
	$out.= '<p class="wplist-des">' . $atts['content'] . '</p>';
	if (!empty($atts['price'])) {
		$out.= '<div class="wplist-oth"><div class="wplist-res wplist-price">' . $atts['price'] . '</div>';
		if (!empty($atts['oprice'])) {
			$out.= '<div class="wplist-res wplist-old-price"><del>' . $atts['oprice'] . '</del></div>';
		}
		$out.= '</div>';
	}
	$out.= '<div class="wplist-btn">' . $atts['btn'] . '</div><div class="clear"></div>';
	$out.= '</a><div class="clear"></div></div>';
	return $out;
}

// 后台样式
function admin_style(){
	echo'<style type="text/css">body{ font-family: Microsoft YaHei;}#activity-widget #the-comment-list .avatar {width: 48px;height: 48px;}.show-id {float: left;color: #999;width: 50%;margin: 0;padding: 3px 0;}.clear {clear: both;margin: 0 0 8px 0}</style>';
}
add_action('admin_head', 'admin_style');

// 外链跳转
if (zm_get_option('link_to')) {
	add_filter('the_content','link_to_jump',999);
	function link_to_jump($content){
		preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$content,$matches);
		if($matches){
		    foreach($matches[2] as $val){
			    if(strpos($val,'://')!==false && strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val) && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$val)){
			    	$content=str_replace("href=\"$val\"", "href=\"".get_template_directory_uri()."/inc/go.php?url=$val\" ",$content);
				}
			}
		}
		return $content;
	}

	// 评论者链接跳转并新窗口打开
	function commentauthor($comment_ID = 0) {
		$url    = get_comment_author_url( $comment_ID );
		$author = get_comment_author( $comment_ID );
		if ( empty( $url ) || 'http://' == $url )
		echo $author;
		else
		echo "<a href='".get_template_directory_uri()."/inc/go.php?url=$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
	}

	// 下载外链跳转
	function link_nofollow($url) {
		if(strpos($url,'://')!==false && strpos($url,home_url())===false && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$url)) {
			$url = str_replace($url, get_template_directory_uri()."/inc/go.php?url=".$url,$url);
		}
		return $url;
	}
}

// 网址跳转
function sites_nofollow($url) {
	$url = str_replace($url, get_template_directory_uri()."/inc/go.php?url=".$url,$url);
	return $url;
}

// 添加斜杠
function nice_trailingslashit($string, $type_of_url) {
	if ( $type_of_url != 'single' && $type_of_url != 'page' )
		$string = trailingslashit($string);
	return $string;
}
add_filter('user_trailingslashit', 'nice_trailingslashit', 10, 2);

function html_page_permalink() {
	global $wp_rewrite;
	if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
		$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	}
}

// 禁止登录后台
function redirect_non_admin_user() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}
// if (zm_get_option('no_admin')) {add_action( 'admin_init', 'redirect_non_admin_user' );}
function begin_user_contact($user_contactmethods){
	//去掉默认联系方式
	unset($user_contactmethods['aim']);
	unset($user_contactmethods['yim']);
	unset($user_contactmethods['jabber']);

	//添加自定义联系方式
	$user_contactmethods['qq'] = 'QQ';
	$user_contactmethods['weixin'] = '微信';
	$user_contactmethods['weibo'] = '新浪微博';

    return $user_contactmethods;
}

// 用户文章
function num_of_author_posts($authorID=''){
	if ($authorID) {
		$author_query = new WP_Query( 'posts_per_page=-1&author='.$authorID );
		$i=0;
		while ($author_query->have_posts()) : $author_query->the_post(); ++$i; endwhile; wp_reset_postdata();
		return $i;
	}
	return false;
}

// 密码提示
function change_protected_title_prefix() {
	return '%s';
}
add_filter('protected_title_format', 'change_protected_title_prefix');

// 评论等级
if (zm_get_option('vip')) {
	function get_author_class($comment_author_email,$user_id){
		global $wpdb;
		$author_count = count($wpdb->get_results(
		"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
		$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) return;
		if($author_count>=0 && $author_count<2)
			echo '<a class="vip vip0" title="评论达人 VIP.0"><i class="be be-favoriteoutline"></i><span class="lv">0</span></a>';
		else if($author_count>=2 && $author_count<5)
			echo '<a class="vip vip1" title="评论达人 VIP.1"><i class="be be-favorite"></i><span class="lv">1</span></a>';
		else if($author_count>=5 && $author_count<10)
			echo '<a class="vip vip2" title="评论达人 VIP.2"><i class="be be-favorite"></i><span class="lv">2</span></a>';
		else if($author_count>=10 && $author_count<20)
			echo '<a class="vip vip3" title="评论达人 VIP.3"><i class="be be-favorite"></i><span class="lv">3</span></a>';
		else if($author_count>=20 && $author_count<50)
			echo '<a class="vip vip4" title="评论达人 VIP.4"><i class="be be-favorite"></i><span class="lv">4</span></a>';
		else if($author_count>=50 && $author_count<100)
			echo '<a class="vip vip5" title="评论达人 VIP.5"><i class="be be-favorite"></i><span class="lv">5</span></a>';
		else if($author_count>=100 && $author_count<200)
			echo '<a class="vip vip6" title="评论达人 VIP.6"><i class="be be-favorite"></i><span class="lv">6</span></a>';
		else if($author_count>=200 && $author_count<300)
			echo '<a class="vip vip7" title="评论达人 VIP.7"><i class="be be-favorite"></i><span class="lv">7</span></a>';
		else if($author_count>=300 && $author_count<400)
			echo '<a class="vip vip8" title="评论达人 VIP.8"><i class="be be-favorite"></i><span class="lv">8</span></a>';
		else if($author_count>=400)
			echo '<a class="vip vip9" title="评论达人 VIP.9"><i class="be be-favorite"></i><span class="lv">9</span></a>';
	}
}

// admin
function get_author_admin($comment_author_email,$user_id){
	global $wpdb;
	$author_count = count($wpdb->get_results(
	"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
	$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) echo '<i class="zm zm-black-tie" style="color: #c40000;">&nbsp;</i><span class="" style="margin-top: 2px!important;color: #c40000;font-size: 13px;;"><b>博主</b></span>';
}

// 图标
class iconfont {
	function __construct(){
		add_filter( 'nav_menu_css_class', array( $this, 'nav_menu_css_class' ) );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'walker_nav_menu_start_el' ), 10, 4 );
	}
	function nav_menu_css_class( $classes ){
		if( is_array( $classes ) ){
			$tmp_classes = preg_grep( '/^(be)(-\S+)?$/i', $classes );
			if( !empty( $tmp_classes ) ){
				$classes = array_values( array_diff( $classes, $tmp_classes ) );
			}
		}
		return $classes;
	}

	protected function replace_item( $item_output, $classes ){
		$spacer = 1 == $settings[ 'spacing' ] ? ' ' : '';
		if( !in_array( 'be', $classes ) ){
			array_unshift( $classes, 'be' );
		}
		$before = true;
		$icon = '<i class="' . implode( ' ', $classes ) . '"></i>';
		preg_match( '/(<a.+>)(.+)(<\/a>)/i', $item_output, $matches );
		if( 4 === count( $matches ) ){
			$item_output = $matches[1];
			if( $before ){
				$item_output .= $icon . '<span class="font-text">' . $spacer . $matches[2] . '</span>';
			} else {
				$item_output .= '<span class="font-text">' . $matches[2] . $spacer . '</span>' . $icon;
			}
			$item_output .= $matches[3];
		}
		return $item_output;
	}

	function walker_nav_menu_start_el( $item_output, $item, $depth, $args ){
		if( is_array( $item->classes ) ){
			$classes = preg_grep( '/^(be)(-\S+)?$/i', $item->classes );
			if( !empty( $classes ) ){
				$item_output = $this->replace_item( $item_output, $classes );
			}
		}
		return $item_output;
	}
}
new iconfont();

// 冒充
function usercheck($incoming_comment) {
	$isSpam = 0;
	if (trim($incoming_comment['comment_author']) == ''.zm_get_option('admin_name').'')
	$isSpam = 1;
	if (trim($incoming_comment['comment_author_email']) == ''.zm_get_option('admin_email').'')
	$isSpam = 1;
	if(!$isSpam)
	return $incoming_comment;
	err('<i class="be be-info"></i>请勿冒充管理员发表评论！');
}

// 自动标签
function auto_tags(){
	$tags = get_tags( array('hide_empty' => false) );
	$post_id = get_the_ID();
	$post_content = get_post($post_id)->post_content;
	if ($tags) {
		foreach ( $tags as $tag ) {
			if ( strpos($post_content, $tag->name) !== false)
				wp_set_post_tags( $post_id, $tag->name, true );
		}
	}
}

// 页面添加标签
class PTCFP{
	function __construct(){
	add_action( 'init', array( $this, 'taxonomies_for_pages' ) );
		if ( ! is_admin() ) {
			add_action( 'pre_get_posts', array( $this, 'tags_archives' ) );
		}
	}
	function taxonomies_for_pages() {
		register_taxonomy_for_object_type( 'post_tag', 'page' );
	}
	function tags_archives( $wp_query ) {
	if ( $wp_query->get( 'tag' ) )
		$wp_query->set( 'post_type', 'any' );
	}
}
$ptcfp = new PTCFP();

// 分类标签
function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results ("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name
		FROM
			$wpdb->posts as p1
			LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,

			$wpdb->posts as p2
			LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
			ORDER by tag_name
	");
	$count = 0;

    if($tags) {
		foreach ($tags as $tag) {
			$mytag[$count] = get_term_by('id', $tag->tag_id, 'post_tag');
			$count++;
		}
	} else {
      $mytag = NULL;
    }
    return $mytag;
}

// 获取当前页面地址
function currenturl() {
	$current_url = home_url(add_query_arg(array()));
	if (is_single()) {
		$current_url = preg_replace('/(\/comment|page|#).*$/','',$current_url);
	} else {
		$current_url = preg_replace('/(comment|page|#).*$/','',$current_url);
	}
	echo $current_url;
}

// 自定义类型面包屑
function begin_taxonomy_terms( $product_id, $taxonomy, $args = array() ) {
    $terms = wp_get_post_terms( $product_id, $taxonomy, $args );
  return apply_filters( 'begin_taxonomy_terms' , $terms, $product_id, $taxonomy, $args );
}

// 子分类
function get_category_id($cat) {
	$this_category = get_category($cat);
	while($this_category->category_parent) {
		$this_category = get_category($this_category->category_parent);
	}
	return $this_category->term_id;
}


function child_cat() {
	if(get_category_children(get_category_id(the_category_ID(false)))!= "" ){
		echo '<div class="header-sub"><ul class="child-cat wow fadeInUp" data-wow-delay="0.3s">';
		echo wp_list_categories("child_of=".get_category_id(the_category_ID(false)). "&depth=1&hide_empty=0&title_li=&orderby=id&order=ASC");
		echo '</ul></div>';
	}
}

// 评论加nofollow
function nofollow_comments_popup_link(){
	return ' rel="external nofollow"';
}

// 图片数量
if( !function_exists('get_post_images_number') ){
	function get_post_images_number(){
		global $post;
		$content = $post->post_content; 
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $result, PREG_PATTERN_ORDER);
		return count($result[1]);
	}
}

// 头部冗余代码
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// 编辑器增强
function enable_more_buttons($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'wp_page';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	return $buttons;
}
add_filter( "mce_buttons_2", "enable_more_buttons" );

// 禁止代码标点转换
remove_filter( 'the_content', 'wptexturize' );

if (zm_get_option('xmlrpc_no')) {
// 禁用xmlrpc
add_filter('xmlrpc_enabled', '__return_false');
}

// 禁止评论自动超链接
remove_filter('comment_text', 'make_clickable', 9);

// 禁止评论HTML
if (zm_get_option('comment_html')) {
add_filter('comment_text', 'wp_filter_nohtml_kses');
add_filter('comment_text_rss', 'wp_filter_nohtml_kses');
add_filter('comment_excerpt', 'wp_filter_nohtml_kses');
}


// 链接管理
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// 显示全部设置
function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');

// 屏蔽自带小工具
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// 禁用版本修订
if (zm_get_option('revisions_no')) {
	add_filter( 'wp_revisions_to_keep', 'disable_wp_revisions_to_keep', 10, 2 );
}
function disable_wp_revisions_to_keep( $num, $post ) {
	return 0;
}

// 禁用自动保存
if (zm_get_option('autosave_no')) {
add_action('admin_print_scripts', create_function( '$a', "wp_deregister_script('autosave');"));
}

// 禁止后台加载谷歌字体
function wp_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'wp_remove_open_sans_from_wp_core' );

// 禁用emoji
 function disable_emojis() {
 	remove_action( 'wp_print_styles', 'print_emoji_styles' );
 }
 add_action( 'init', 'disable_emojis' );

// 禁用oembed/rest
function disable_embeds_init() {
	global $wp;
	$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
		'embed',
	) );
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	add_filter( 'embed_oembed_discover', '__return_false' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
if (zm_get_option('embed_no')) {
	add_action( 'init', 'disable_embeds_init', 9999 );
}

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

function disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}
function disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}
	return $rules;
}
function disable_embeds_remove_rewrite_rules() {
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
function disable_embeds_flush_rewrite_rules() {
	remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

// 禁止dns-prefetch
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );


if (zm_get_option('my_author')) {
// 替换用户链接
add_filter( 'request', 'my_author' );
function my_author( $query_vars ) {
	if ( array_key_exists( 'author_name', $query_vars ) ) {
		global $wpdb;
		$author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='first_name' AND meta_value = %s", $query_vars['author_name'] ) );
		if ( $author_id ) {
			$query_vars['author'] = $author_id;
			unset( $query_vars['author_name'] );
		}
	}
	return $query_vars;
}

add_filter( 'author_link', 'my_author_link', 10, 3 );
function my_author_link( $link, $author_id, $author_nicename ) {
	$my_name = get_user_meta( $author_id, 'first_name', true );
	if ( $my_name ) {
		$link = str_replace( $author_nicename, $my_name, $link );
	}
	return $link;
}
}
// 屏蔽用户名称类
function remove_comment_body_author_class( $classes ) {
	foreach( $classes as $key => $class ) {
	if(strstr($class, "comment-author-")||strstr($class, "author-")) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}

// 最新更新
function recently_updated_posts($num=10,$days=7) {
	if( !$recently_updated_posts = get_option('recently_updated_posts') ) {
		query_posts('post_status=publish&orderby=modified&posts_per_page=-1');
		$i=0;
		while ( have_posts() && $i<$num ) : the_post();
			if (current_time('timestamp') - get_the_time('U') > 60*60*24*$days) {
				$i++;
				$the_title_value=get_the_title();
				$recently_updated_posts.='<li><i class="be be-arrowright"></i><a href="'.get_permalink().'" title="'.$the_title_value.'">'
				.$the_title_value.'</a></li>';
			}
		endwhile;
		wp_reset_query();
		if ( !empty($recently_updated_posts) ) update_option('recently_updated_posts', $recently_updated_posts);
	}
	$recently_updated_posts=($recently_updated_posts == '') ? '<li>目前没有文章被更新</li>' : $recently_updated_posts;
	echo $recently_updated_posts;
}

function clear_cache_recently() {
	update_option('recently_updated_posts', '');
}
add_action('save_post', 'clear_cache_recently');

if (zm_get_option('edd')) {
// edd custom-fields
$download_args = array('supports' => apply_filters( 'edd_download_supports', array( 'custom-fields') ),);
register_post_type( 'download', apply_filters( 'edd_download_post_type_args', $download_args ) );
}

if (zm_get_option('allow_files')) {
// 允许投稿上传
	if ( current_user_can('contributor') && !current_user_can('upload_files') )
	add_action('admin_init', 'allow_contributor_uploads');

	function allow_contributor_uploads() {
		$contributor = get_role('contributor');
		$contributor->add_cap('upload_files');
	}
} else {
	if ( current_user_can('contributor') && current_user_can('upload_files') )
	add_action('admin_init', 'allow_contributor_uploads');

	function allow_contributor_uploads() {
		$contributor = get_role('contributor');
		$contributor->remove_cap('upload_files');
	}
}

// 注册时间
function user_registered(){
	$userinfo=get_userdata(get_current_user_id());
	$authorID= $userinfo->ID;
	$user = get_userdata( $authorID );
	$registered = $user->user_registered;
	echo '' . date( "" . sprintf(__( 'Y年m月d日', 'begin' )) . "", strtotime( $registered ) );
}

// 文章归档更新
function clear_archives() {
	update_option('cx_archives_list', '');
	update_option('up_archives_list', '');
}

// 登录时间
function user_last_login($user_login) {
	global $user_ID;
	date_default_timezone_set(PRC);
	$user = get_user_by( 'login', $user_login );
	update_user_meta($user->ID, 'last_login', date('Y-m-d H:i:s'));
}

function get_last_login($user_id) {
	$last_login = get_user_meta($user_id, 'last_login', true);
	$date_format = get_option('date_format') . ' ' . get_option('time_format');
	$the_last_login = mysql2date($date_format, $last_login, false);
	echo $the_last_login;
}

// 登录角色
function get_user_role() {
	global $current_user;
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);
	return $user_role;
}

// 读者排行
function top_comment_authors($amount = 98) {
	global $wpdb;
		$prepared_statement = $wpdb->prepare(
		'SELECT
		COUNT(comment_author) AS comments_count, comment_author, comment_author_url, comment_author_email, MAX( comment_date ) as last_commented_date
		FROM '.$wpdb->comments.'
		WHERE comment_author != "" AND comment_type = "" AND comment_approved = 1  AND user_id = ""
		GROUP BY comment_author
		ORDER BY comments_count DESC, comment_author ASC
		LIMIT %d',
		$amount);
	$results = $wpdb->get_results($prepared_statement);
	$output = '<div class="top-comments">';
	foreach($results as $result) {
		$c_url = $result->comment_author_url;
		$output .= '
		<div class="lx8">
			<div class="top-author">
				<div class="top-comment"><a href="' . get_template_directory_uri()."/inc/go.php?url=". $c_url . '" target="_blank" rel="external nofollow">' . get_avatar($result->comment_author_email, 96) . '<div class="author-url"><strong> ' . $result->comment_author . '</div></strong></a></div>
				<div class="top-comment">'.$result->comments_count.'条留言</div>
				<div class="top-comment">最后' . human_time_diff(strtotime($result->last_commented_date)) . '前</div>
			</div>
		</div>';
	}
	$output .= '<div class="clear"></div></div>';
	echo $output;
}


function top_comments($number = 98) {
	global $wpdb;
	$counts = wp_cache_get( 'mostactive' );
	if ( false === $counts ) {
		$counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email
		FROM {$wpdb->prefix}comments
		WHERE comment_date > date_sub( NOW(), INTERVAL 90 DAY )
		AND comment_approved = '1'
		AND comment_author_email != 'example@example.com'
		AND comment_author_email != ''
		AND comment_author_url != ''
		AND comment_type = ''
		AND user_id = '0'
		GROUP BY comment_author_email
		ORDER BY cnt DESC
		LIMIT $number");
	}
	$mostactive =  '<div class="top-comments">';
	if ( $counts ) {
		wp_cache_set( 'mostactive', $counts );
		foreach ($counts as $count) {
			$c_url = $count->comment_author_url;
			$mostactive .= '
			<div class="lx8">
				<div class="top-author">
					<div class="top-comment"><a href="' . get_template_directory_uri()."/inc/go.php?url=". $c_url . '" target="_blank" rel="external nofollow">' . get_avatar($count->comment_author_email, 96). '<div class="author-url"><strong> ' . $count->comment_author . '</div></strong></a></div>
					<div class="top-comment">'.$count->cnt.'个脚印</div>
				</div>
			</div>';
		}
		$mostactive .= '<div class="clear"></div></div>';
		echo $mostactive;
	}
}
if (zm_get_option('meta_delete')) {
} else {
require get_template_directory() . '/inc/meta-delete.php';
}

// 邀请码
if (zm_get_option('invitation_code')) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/invitation/front-end.php';
	} else {
		require get_template_directory() . '/inc/invitation/back-end.php';
	}
}

// 删除图片附件
function delete_post_and_attachments($post_ID) {
	global $wpdb;
	$thumbnails = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = $post_ID" );
	foreach ( $thumbnails as $thumbnail ) {
		wp_delete_attachment( $thumbnail->meta_value, true );
	}

	$attachments = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_parent = $post_ID AND post_type = 'attachment'" );
	foreach ( $attachments as $attachment ) {
		wp_delete_attachment( $attachment->ID, true );
	}

	$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = $post_ID" );
}
if (zm_get_option('attachments_delete')) {
	add_action('before_delete_post', 'delete_post_and_attachments');
}

// 分类ID
function show_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<ol class="show-id">'.$category->name.' [ ' .$category->term_id.' ]</ol>';
		echo $output;
	}
}

function search_cat(){
	$categories = get_categories();
	foreach ($categories as $cat) {
	$output = '<option value="'.$cat->cat_ID.'">'.$cat->cat_name.'</option>';
		echo $output;
	}

	// $categories = get_categories(array('taxonomy' => 'gallery'));
	// foreach ($categories as $cat) {
	// $output = '<option value="'.$cat->cat_ID.'">'.$cat->cat_name.'</option>';
	// echo $output;
	// }
}

// 热评文章
function hot_comment_viewed($number, $days){
	global $wpdb;
	$sql = "SELECT ID , post_title , comment_count
			FROM $wpdb->posts
			WHERE post_type = 'post' AND post_status = 'publish' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
			ORDER BY comment_count DESC LIMIT 0 , $number ";
	$posts = $wpdb->get_results($sql);
	$i = 1;
	$output = "";
	foreach ($posts as $post){
		$output .= "\n<li><span class='li-icon li-icon-$i'>$i</span><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\" (".$post->comment_count."条评论)\" >".$post->post_title."</a></li>";
		$i++;
	}
	echo $output;
}

// custum font
function custum_font_family($initArray){
   $initArray['font_formats'] = "微软雅黑='微软雅黑';华文彩云='华文彩云';华文行楷='华文行楷';华文琥珀='华文琥珀';华文新魏='华文新魏';华文中宋='华文中宋';华文仿宋='华文仿宋';华文楷体='华文楷体';华文隶书='华文隶书';华文细黑='华文细黑';宋体='宋体';仿宋='仿宋';黑体='黑体';隶书='隶书';幼圆='幼圆'";
   return $initArray;
}

// 修改登录链接
function login_protect(){
	if($_GET[''.zm_get_option('pass_h').''] != ''.zm_get_option('word_q').'')header('Location: '.zm_get_option('go_link').'');// 忘了删除
}