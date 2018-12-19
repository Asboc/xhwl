<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<?php begin_title(); ?>
<link rel="shortcut icon" href="<?php echo zm_get_option('favicon'); ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo zm_get_option('apple_icon'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
<![endif]-->
<?php wp_head(); ?>
<?php echo zm_get_option('ad_t'); ?>
<?php echo zm_get_option('tongji_h'); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php get_template_part( 'template/menu', 'index' ); ?>
	<?php if (zm_get_option('m_nav')) { ?>
		<?php if ( wp_is_mobile() ) { ?><?php get_template_part( 'inc/menu-m' ); ?><?php } ?>
	<?php } ?>
	<nav class="breadcrumb">
		<?php begin_breadcrumb(); ?>
		<?php type_breadcrumb(); ?>
		<?php begin_dw_breadcrumb(); ?>
	</nav>
	<?php get_template_part( 'template/header-slider' ); ?>
	<?php get_template_part('ad/ads', 'header'); ?>
	<?php get_template_part( 'template/header-sub' ); ?>
	<div id="content" class="site-content">