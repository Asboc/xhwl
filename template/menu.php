<header id="masthead" class="site-header">
	<div id="header-main" class="header-main">
		<nav id="top-header">
			<div class="top-nav">
				<?php if (zm_get_option('profile')) { ?>
					<?php get_template_part( 'inc/user/user-profile' ); ?>
				<?php } ?>

				<?php
					wp_nav_menu( array(
						'theme_location'	=> 'header',
						'menu_class'		=> 'top-menu',
						'fallback_cb'		=> 'default_menu'
					) );
				?>
			</div>
		</nav><!-- #top-header -->

		<div id="menu-box">
			<div id="top-menu">
				<span class="nav-search"></span>
				<?php if ( zm_get_option('mobile_login') ) { ?>
					<?php if (zm_get_option('user_l')) { ?>
						<?php
						global $user_identity,$user_level;
						get_currentuserinfo();
						if ($user_identity) { ?>
							<span class="mobile-login"><a href="#login" id="login-mobile" ><i class="be be-timerauto"></i></a></span>
						<?php } else { ?>
							<span class="mobile-login"><a href="<?php echo wp_login_url(  home_url() ); ?>" title="Login"><i class="be be-timerauto"></i></a></span>
						<?php } ?>
					<?php } else { ?>
						<span class="mobile-login"><a href="#login" id="login-mobile" ><i class="be be-timerauto"></i></a></span>
					<?php } ?>
				<?php } ?>
				<?php if (zm_get_option("logo_css")) { ?>
				<div class="logo-site">
				<?php } else { ?>
				<div class="logo-sites">
				<?php } ?>
					<?php
						if ( is_front_page() || is_category() || is_home() ) : ?>
							<?php if (zm_get_option('logos')) { ?>
							<h1 class="site-title">
								<?php if ( zm_get_option('logo') ) { ?>
									<a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo zm_get_option('logo'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" rel="home" /><span class="site-name"><?php bloginfo( 'name' ); ?></span></a>
								<?php } ?>
							</h1>
							<?php } else { ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<p class="site-description"><?php bloginfo( 'description' ); ?></p>
						<?php } ?>
						<?php else : ?>
						<?php if (zm_get_option('logos')) { ?>
							<p class="site-title">
								<?php if ( zm_get_option('logo') ) { ?>
									<a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo zm_get_option('logo'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" rel="home" /><span class="site-name"><?php bloginfo( 'name' ); ?></span></a>
								<?php } ?>
							</p>
						<?php } else { ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<p class="site-description"><?php bloginfo( 'description' ); ?></p>
						<?php } ?>
						<?php endif;
					?>
				</div><!-- .logo-site -->

				<div id="site-nav-wrap">
					<div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close">×</a></div>
					<div id="sidr-menu"><div class="toggle-sidr-menu">MENU</a></div></div>
					<nav id="site-nav" class="main-nav">
					<?php if (zm_get_option('nav_no')) { ?>
						<span class="nav-mobile"><a href="<?php echo get_permalink( zm_get_option('nav_url') ); ?>"><i class="be be-menu"></i></a></span>
					<?php } else { ?>
						<?php if (zm_get_option('m_nav')) { ?>
							<?php if ( wp_is_mobile() ) { ?>
								<span class="nav-mobile"><i class="be be-menu"></i></span>
							<?php } else { ?>
								<a href="#sidr-main" id="navigation-toggle" class="bars"><i class="be be-menu"></i></a>
							<?php } ?>
						<?php } else { ?>
							<a href="#sidr-main" id="navigation-toggle" class="bars"><i class="be be-menu"></i></a>
						<?php } ?>
					<?php } ?>
						<?php
							wp_nav_menu( array(
								'theme_location'	=> 'primary',
								'menu_class'		=> 'down-menu nav-menu',
								'fallback_cb'		=> 'default_menu'
							) ); 
						?>
					</nav><!-- #site-nav -->
				</div><!-- #site-nav-wrap -->
				<div class="clear"></div>
			</div><!-- #top-menu -->
		</div><!-- #menu-box -->
	</div><!-- #menu-box -->
</header><!-- #masthead -->

<div id="search-main">
	<?php if (zm_get_option('wp_s')) { ?><?php get_search_form(); ?><?php } ?>
	<?php if (zm_get_option('baidu_s')) { ?><?php get_template_part( 'template/search-baidu' ); ?><?php } ?>
	<div class="clear"></div>
</div>