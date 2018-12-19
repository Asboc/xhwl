<div id="login">
	<?php global $user_ID, $user_identity; wp_get_current_user(); if (!$user_ID) { ?>

	<div id="login-tab" class="login-tab-product">
	    <h2 class="login-tab-hd">
			<span class="login-tab-hd-con"><a href="javascript:"><?php _e( '登录', 'begin' ); ?></a></span>
			<?php if ( !get_option('users_can_register') )  { ?>
			<?php } else { ?>
				<span class="login-tab-hd-con"><a href="javascript:"><?php _e( '注册', 'begin' ); ?></a></span>
			<?php } ?>
			<?php if (zm_get_option('reset_pass')) { ?><span class="login-tab-hd-con"><a href="javascript:"><?php _e( '找回密码', 'begin' ); ?></a></span><?php } ?>
	    </h2>
	
		<div class="login-tab-bd login-dom-display">
			<div class="login-tab-bd-con login-current">
				<div id="tab1_login" class="tab_content_login">
					<form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form">
						<div class="username">
							<label for="user_login"><?php _e( '用户名', 'begin' ); ?></label>
							<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
						</div>
						<div class="password">
							<label for="user_pass"><?php _e( '密码', 'begin' ); ?></label>
							<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
						</div>
						<div class="login-form"><?php do_action('login_form'); ?></div>
						<div class="login_fields">
							<div class="rememberme">
								<label for="rememberme">
									<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /><?php _e( '记住我的登录信息', 'begin' ); ?>
								</label>
							</div>
							<input type="submit" name="user-submit" value="<?php _e( '登录', 'begin' ); ?>" tabindex="14" class="user-submit" />
							<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
							<input type="hidden" name="user-cookie" value="1" />
						</div>
					</form>
				</div>
			</div>

			<?php if ( !get_option('users_can_register') )  { ?>
			<?php } else { ?>
				<?php if ( zm_get_option('reg_url') == '' ) { ?>
				<div class="login-tab-bd-con">
					<div id="tab2_login" class="tab_content_login">
						<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
							<div class="username">
								<label for="user_login"><?php _e( '用户名', 'begin' ); ?></label>
								<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
							</div>
							<div class="password">
								<label for="user_email"><?php _e( '电子邮件地址', 'begin' ); ?></label>
								<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
							</div>
							<div class="login_fields">
								<?php do_action('register_form'); ?>
								<input type="submit" name="user-submit" value="<?php _e( '注册', 'begin' ); ?>" class="user-submit" tabindex="103" />
								<?php $register = $_GET['register']; if($register == true) { echo '<p>注册确认信将会发送给您。</p>'; } ?>
								<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
								<input type="hidden" name="user-cookie" value="1" />
							</div>
						</form>
					</div>
				</div>
				<?php } else { ?>
					<div class="login-tab-bd-con reg-url">
						<?php if ( zm_get_option('reg_url') == '' ) { ?><?php } else { ?><a href="<?php echo stripslashes( zm_get_option('reg_url') ); ?>" target="_blank"><?php _e( '立即注册', 'begin' ); ?></a><?php } ?>
						<p class="message"><?php _e( '点击“立即注册”转到用户注册页面。', 'begin' ); ?></p>
					</div>
				<?php } ?>
			<?php } ?>

			<?php if (zm_get_option('reset_pass')) { ?>
			<div class="login-tab-bd-con">
				<div id="tab3_login" class="tab_content_login">
					<p class="message"><?php _e( '输入用户名或电子邮箱地址，您会收到一封新密码链接的电子邮件。', 'begin' ); ?></p>
					<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
						<div class="username">
							<label for="user_login" class="hide"><?php _e( '用户名或电子邮件地址', 'begin' ); ?></label>
							<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
						</div>
						<div class="login_fields">
							<div class="login-form"><?php do_action('login_form', 'resetpass'); ?></div>
							<input type="submit" name="user-submit" value="<?php _e( '获取新密码', 'begin' ); ?>" class="user-submit" tabindex="1002" />
							<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
							<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
							<input type="hidden" name="user-cookie" value="1" />
						</div>
					</form>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>

	<?php } else { // is logged in ?>

	<div class="sidebox">
		<h3><?php echo $user_identity; ?>，<?php _e( '您好！', 'begin' ); ?></h3>
		<div class="usericon">
			<?php global $userdata; wp_get_current_user(); echo get_avatar($userdata->ID, 80); ?>
		</div>
		<div class="userinfo">
			<p>
				<?php if (current_user_can('manage_options')) { 
				echo '<a href="' . admin_url() . '" target="_blank">'.sprintf(__( '管理站点', 'begin' )).'</a>'; } else { 
				echo '<a href="' .get_permalink( zm_get_option('user_url') ) . '" target="_blank">'.sprintf(__( '用户中心', 'begin' )).'</a>'; } ?>
				<a href="<?php echo wp_logout_url('index.php'); ?>"><?php _e( '登出', 'begin' ); ?></a>
			</p>
			<div class="clear"></div>
		</div>
	</div>
	<?php } ?>
</div>