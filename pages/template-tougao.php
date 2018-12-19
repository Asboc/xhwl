<?php
/*
Template Name: 给我投稿
*/

if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send'){
	if( isset($_COOKIE["tougao"]) && ( time() - $_COOKIE["tougao"] ) < 0 ){
		wp_die('您投稿也太勤快了吧，先歇会儿！ <a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}
	//表单变量初始化
	$name = isset( $_POST['tougao_authorname'] ) ? $_POST['tougao_authorname'] : '';
	$email = isset( $_POST['tougao_authoremail'] ) ? $_POST['tougao_authoremail'] : '';
	$blog = isset( $_POST['tougao_authorblog'] ) ? $_POST['tougao_authorblog'] : '';
	$title = isset( $_POST['tougao_title'] ) ? $_POST['tougao_title'] : '';
	$tags = isset( $_POST['tougao_tags'] ) ? $_POST['tougao_tags'] : '';
	$category = isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
	$content = isset( $_POST['zm-content'] ) ? $_POST['zm-content'] : '';
	//表单项数据验证
	if ( empty($name) || strlen($name) > 20 ){
		wp_die('昵称必须填写，且不得超过20个字符 <a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}
	if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
		wp_die('邮箱必须填写，且不得超过60个字符，必须符合 Email 格式 <a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}
	if ( empty($title) || strlen($title) > 100 ){
		wp_die('文章标题必须填写，且不得超过100个字符 <a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}
	if ( empty($content) || strlen($content) < 100){
		wp_die('内容必须填写，且不得少于100个字符 <a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}
	$tougao = array('post_title' => $title,'post_content' => $content,'post_status' => 'pending','tags_input' => $tags,'post_category' => array($category));

	$status = wp_insert_post( $tougao );//将文章插入数据库
	if ($status != 0){
		global $wpdb;
		$myposts = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_status = 'pending' AND post_type = 'post' ORDER BY post_date DESC");
		add_post_meta($myposts[0]->ID, 'postauthor', $name);
		if( !empty($blog))
			add_post_meta($myposts[0]->ID, 'authorurl', $blog);
		setcookie("tougao", time(), time()+180);
		wp_die('投稿成功！<a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}else{
		wp_die('投稿失败！<a href="javascript:void(0);" onclick="history.back();">点此返回</a>');
	}
}
get_header(); ?>
<style type="text/css">
#primary {
	width: 100%;
}
#basicinfo p {
	text-indent: 0;
}
.postform {
	background: #fff;
	width: 40%;
	margin: 5px 0;
	padding: 5px;
	border: 1px solid #ebebeb;
	border-radius: 2px;
	-webkit-appearance: none;
}
.post-area {
	margin-top: 10px;
}
#basicinfo label {
	float: left;
	width: 80px;
	line-height: 40px;
}
#basicinfo input {
	background: #fff;
	width: 40%;
	margin: 5px 0;
	padding: 5px;
	border: 1px solid #ebebeb;
	border-radius: 2px;
	-webkit-appearance: none;
}
#basicinfo input:focus {
	outline: 0;
	border: 1px solid #568abc;
}
textarea, #zm-content{
	background: #fff;
	width: 100%;
	margin: 5px 0;
	padding: 5px;
	border: 1px solid #ebebeb;
	border-radius: 2px;
	-webkit-appearance: none;
}
#submit {
	background: #0088cc;
	float: left;
	width: 40%;
	height: 40px;
	color: #fff;
	text-align: center;
	margin: 10px 0 0 0;
	border: 0px;
	cursor: pointer;
	border-radius: 2px;
	-webkit-appearance: none;
	box-shadow: 0 0 2px rgba(0, 0, 0, 0.4);
}
#submit:hover {
	background: #a3a3a3;
}
.mce-path-item {
	display: none;
}
.mce-stack-layout{
	border: 1px solid #ebebeb;
}
#sc_select {
	display: none;
}
</style>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			<div class="entry-content">
				<div class="single-content">
					<?php the_content(); ?>
					<?php if ( current_user_can('level_0') ){ ?>
					<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
						<div id="basicinfo">
							<p>
								<label>昵称：</label>
								<input type="text" value="" name="tougao_authorname" placeholder="必填" required/>
							</p>
							<p>
								<label>E-Mail：</label>
								<input type="text" value="" name="tougao_authoremail" placeholder="必填" required/>
							</p>
							<p>
								<label>您的网站：</label>
								<input type="text" value="" name="tougao_authorblog" placeholder="选填"/>
							</p>
							<p>
								<label>文章标题：</label>
								<input type="text" value="" name="tougao_title" placeholder="必填" required/>
							</p>
							<p>
								<label>选择分类：</label>
								<?php wp_dropdown_categories('show_count=0&hierarchical=1'); ?>
							</p>
							<p>
								<label>关键字：</label>
								<input type="text" value="" name="tougao_tags" placeholder="选填"/>
							</p>
						</div>
						<div>
							<label>文章内容（不少于100个字）：</label>
						<div class="post-area">
							<?php
								$post = false;
								$content = '';
								$editor_id = 'zm-content';
								$settings = array(
									'textarea_rows' => 10
								);
								wp_editor( $content, $editor_id, $settings );
							?>
						</div>
						<p>
							<input type="hidden" value="send" name="tougao_form" />
							<input id="submit" name="submit" type="submit" value="提交文章" />
						</p>
					</form>

					<div class="clear"></div>

					<?php } else { ?>
					<p>提示：您需要登录，才能投稿！</p>
					<?php } ?>

				</div>
			</div><!-- .entry-content -->
		</article><!-- #page -->
	<?php endwhile; ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>