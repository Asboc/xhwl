<?php
/*
Template Name: 立即注册
*/
?>

<?php
	if( !empty($_POST['user_reg']) ) {
		$error = '';
		$sanitized_user_login = sanitize_user( $_POST['user_login'] );
		$user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

  // 检查名称
	if ( $sanitized_user_login == '' ) {
		$error .= '<i class="be be-info"></i>请输入用户名！<br />';
	} elseif ( ! validate_username( $sanitized_user_login ) ) {
		$error .= '<i class="be be-info"></i>此用户名包含无效字符，请输入有效的用户名！<br />';
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$error .= '<i class="be be-info"></i>该用户名已被注册，请再选择一个！<br />';
	}

  // 检查邮件
	if ( $user_email == '' ) {
		$error .= '<i class="be be-info"></i>请填写电子邮件地址！<br />';
	} elseif ( ! is_email( $user_email ) ) {
		$error .= '<i class="be be-info"></i>电子邮件地址不正确！<br />';
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$error .= '<i class="be be-info"></i>该电子邮件地址已经被注册，请换一个！<br />';
	}
	if (zm_get_option('invitation_code')) {
		//检测邀请码
		$baweic_options = get_option( 'baweic_options' );
		$invitation_code = isset( $_POST['invitation_code'] ) ? strtoupper( $_POST['invitation_code'] ) : '';
		if( !array_key_exists( $invitation_code, $baweic_options['codes'] ) ) {
			add_action( 'login_head', 'wp_shake_js', 12 );
			$error .= '<i class="be be-info"></i>邀请码错误！<br />';
		}elseif( isset( $baweic_options['codes'][$invitation_code] ) && $baweic_options['codes'][$invitation_code]['leftcount']==0 ){
			add_action( 'login_head', 'wp_shake_js', 12 );
			$error .='<i class="be be-info"></i>此邀请码已被使用！<br />';
		}
	}

	// 检查密码
	if(strlen($_POST['user_pass']) < 6)
		$error .= '<i class="be be-info"></i>密码长度至少6位!<br />';
		elseif($_POST['user_pass'] != $_POST['user_pass2'])
		$error .= '<i class="be be-info"></i>密码不一致!<br />';

	if($error == '') {
			$user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );

	if (zm_get_option('invitation_code')) {
		//核对邀请码
	   	$baweic_options['codes'][$invitation_code]['leftcount']--;
		$baweic_options['codes'][$invitation_code]['users'][] = $sanitized_user_login;
		update_option( 'baweic_options', $baweic_options );
	}
		if ( ! $user_id ) {
			$error .= sprintf( '<i class="be be-info"></i>无法完成您的注册请求... 请联系<a href=\"mailto:%s\">管理员</a>！<br />', get_option( 'admin_email' ) );
		}
		else if (!is_user_logged_in()) {
			$user = get_userdatabylogin($sanitized_user_login);
			$user_id = $user->ID;

	      // 自动登录
			wp_set_current_user($user_id, $user_login);
			wp_set_auth_cookie($user_id);
			do_action('wp_login', $user_login);
		}
	}
}
?>
<?php get_header(); ?>

<style type="text/css">
body{
	background: #555;
}
#primary {
	width: 100%;
	height: 700px;
	box-shadow: none;
}
#primary .page {
	background: transparent !important;
	padding: 0 !important;
	border: none !important;
	box-shadow: none !important;
}
#primary .single-content {
	float: left;
	width: 50%;
	font-size: 16px;
	color: #fff;
	margin: 30px 0 0 0;
	padding: 10px 10px 10px 30px;
}
#footer-widget-box, #scroll, .nav-search {
	display: none;
}
#menu-box {
	top: 0;
	position:fixed;
}
#colophon {
    width: 100%;
	position:fixed;
	bottom: 0;
}
#clipbg {
	background: #fff;
    display: none;
    height: 900px;
    left: 0;
    overflow: hidden;
    position: absolute;
    top: 0;
    width: 100%;
}
.reg-main {
	margin: 30px 0 0 0;
}
.user_reg {
	float: right;
	width: 70%;
}
.reg-page {
	position: relative;
	float: left;
	width: 50%;
	height: 500px;
	padding: 10px 30px 10px 10px;
	border-right: 1px dashed #ccc;
}
.reg-page p {
	text-indent: 0em;
}
p.user_error {
	position: fixed;
	top: 100px;
	left: 0;
	background: #fff;
	margin: 16px 0;
	padding: 10px 10px 0 10px;
	border-radius: 2px;
	border: 1px solid #f3f3f3;
}
.user_error .be-info {
	color: #ff0129;
	margin: 0 5px 0 0;
}
.shut-error {
	float: right;
	color: #e73c31;
	padding: 5px;
	display: block;
	cursor: pointer;
}
p.user_is {
	width: 300px;
	color: #fff;
	line-height: 40px;
	text-align: center;
	margin: 50px auto;
	padding: 12px;
}
.user_is a {
	background: #e73c31;
	color: #fff;
	padding: 5px 10px;
	border: 1px solid #e73c31;
	border-radius: 2px;
	-webkit-appearance: none;
}
.user_is a:hover {
	background: #fb5548;
	border: 1px solid #fb5548;
 	transition: all 0.2s ease-in 0s;
}
.user_is img {
	margin: 0 auto;
}
.user_reg label {
	color: #fff;
	cursor: pointer;
}
.user_reg .input {
	background: #fff;
	width: 70%;
	margin: 5px 0;
	padding: 5px 10px;
	border: 1px solid #ddd;
	border-radius: 2px;
	-webkit-appearance: none;
}
.reg-page #submit {
	background: #e73c31;
	font-size: 16px;
	color: #fff;
	width: 100px;
	margin: 10px 10px 10px 0;
	padding: 6px;
	cursor: pointer;
	border: 1px solid #e73c31;
	border-radius: 2px;
	-webkit-appearance: none;
}
.reg-page #submit:hover {
	background: #fb5548;
	border: 1px solid #fb5548;
 	transition: all 0.2s ease-in 0s;
}
.to-code a {
	background: #e73c31;
	color: #fff;
	padding: 6px;
	cursor: pointer;
	border: 1px solid #e73c31;
	border-radius: 2px;
	-webkit-appearance: none;
}
.to-code a:hover {
	background: #fb5548;
	border: 1px solid #fb5548;
 	transition: all 0.2s ease-in 0s;
}
.to-code-way {
	position: absolute;
	background: #e73c31;
	top: 230px;
	right: 40px;
	color: #fff;
	max-width: 188px;
	padding: 10px;
	display: none;
	border-radius: 2px;
}
.droperror {
	color: #fff;
}
.ad-site {
	display: none;
}
.reg-error {
	color: #fff;
	font-size: 16px;
	font-size: 1.6rem;
	text-align: center;
	margin: 50px 0;
}
@media screen and (max-width: 900px) {
	#primary .single-content {
		display: none;
	}
	.reg-page {
		width: 100%;
		padding: 10px;
		border-right: none;
	}
	.user_reg {
		float: inherit;
	}
	.user_reg {
		width: 100%;
	}
	.to-code {
		width: 90px;
		display: block;
	}
}
.si_captcha_small {
	margin: 0 0 10px 0;
}
</style>

<div id="clipbg" style="display: block;">
	<video id="video" loop="loop" autoplay="autoplay" style="position: absolute; width: 1903px; height: 1070.44px; top: -177.719px; left: 0px;">
		<?php if ( zm_get_option('reg_video') == '' ) { ?>
			<source src="http://data.vod.itc.cn/?new=/241/113/LAHVGSHQTBO9H9nLD4iuNF.mp4&vid=2389831&ch=tv&cateCode=107;107102&plat=null&mkey=naGNastwo_0-KG4inoUSAquepq1SRBiy&prod=app"></source>
		<?php } else { ?>
			<source src="<?php echo zm_get_option('reg_video'); ?>"></source>
		<?php } ?>
	</video>
</div>

<div id="primary" class="content-reg">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( !get_option('users_can_register') )  { ?>
				<p class="reg-error"><i class="be be-info"></i> 提示：进入后台→设置→常规→常规选项页面，勾选“任何人都可以注册”！</p>
			<?php } else { ?>
			<div class="reg-main">
				<div class="reg-page">
					<?php if(!empty($error)) {
						echo '<p class="user_error">'.$error.'<span class="shut-error"><i class="be be-cross"></i></span></p>';
						}
					if (!is_user_logged_in()) { ?>
						<form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="user_reg">
						    <p>
								<label for="user_login"><?php _e( '用户名', 'begin' ); ?> *<br />
						        <input type="text" name="user_login" tabindex="1" id="user_login" class="input" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" size="30" />
						      </label>
						    </p>

						    <p>
								<label for="user_email"><?php _e( '电子邮件地址', 'begin' ); ?> *<br />
						        <input type="text" name="user_email" tabindex="2" id="user_email" class="input" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="30" />
						      </label>
						    </p>

						    <p>
								<label for="user_pwd1"><?php _e( '密码(至少6位)', 'begin' ); ?> *<br />
						        <input id="user_pwd1" class="input" tabindex="3" type="password" tabindex="21" size="30" value="" name="user_pass" />
						      </label>
						    </p>

						    <p>
								<label for="user_pwd2"><?php _e( '重复密码', 'begin' ); ?> *<br />
						        <input id="user_pwd2" class="input" tabindex="4" type="password" tabindex="21" size="30" value="" name="user_pass2" />
						      </label>
						    </p>

							<?php do_action('register_form'); ?>

						    <p class="submit">
								<input type="hidden" name="user_reg" value="ok" />
						        <input id="submit" name="submit" type="submit" value="<?php _e( '提交注册', 'begin' ); ?>"/>
						    </p>
						</form>

					<?php } else { ?>
						<p class="user_is">
							<?php _e( '欢迎', 'begin' ); ?> <strong><?php echo $user_identity; ?></strong><br/>
					         <a href="<?php echo wp_logout_url( home_url() ); ?>" title=""><?php _e( '退出登录', 'begin' ); ?></a>
							<?php
							    if (current_user_can('manage_options')) {
							        echo '&nbsp;&nbsp;<a href="' . admin_url() . '">' . sprintf(__( '管理站点', 'begin' )) . '</a>';
							    } else {
							    	echo '&nbsp;&nbsp;<a href="' . get_permalink( zm_get_option('user_url') ) . '" target="_blank">' . sprintf(__( '用户中心', 'begin' )) . '</a>';
							    }
							?>
						</p>
					<?php } ?>
				</div>

				<div class="entry-content">
					<div class="single-content">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</article>
		<?php } ?>
	<?php endwhile; ?>
	</main>
</div>

<?php get_footer(); ?>