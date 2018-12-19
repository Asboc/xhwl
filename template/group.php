<?php
/* 企业主页 */
?>
<?php get_header(); ?>
<style type="text/css">
body {
	background: #fff;
}

#content {
	width: 100%;
	margin: 0 auto;
}

#masthead {
	background: #fff;
}

#primary {
	width: 100%;
	box-shadow: none;
}

#primary .page {
	background: transparent !important;
	padding: 0 !important;
	border: none !important;
	box-shadow: none !important;
}

.breadcrumb, .header-sub, .owl-buttons {
	display: none;
}

#slideshow {
	background: #555;
	margin: -1px auto 0;
}

#menu-box {
	transition-duration: .0s;
}

.links-box {
	width: 100%;
	background: #f1f1f1;
}
/** 链接 **/
#links {
	width: 1080px;
	margin: 0 auto;
	padding: 20px 0;
}

.link-f a {
	box-shadow: none;
}

@media screen and (max-width: 1080px) {
	#links {
		width: 100%;
	}
}

.ad-site {
	display: none;
}

#group-widget-two .add-widgets {
	text-align: center;
	padding: 30px;
	background: #fff;
}

.small-img {
	position: absolute;
	max-width: 28%;
	top: 15%;
	left: 20%;
}

@-webkit-keyframes small-img {
	16.65% {
		-webkit-transform: translateY(8px);
		transform: translateY(8px);
	}

	33.3% {
		-webkit-transform: translateY(-6px);
		transform: translateY(-6px);
	}

	49.95% {
		-webkit-transform: translateY(4px);
		transform: translateY(4px);
	}

	66.6% {
		-webkit-transform: translateY(-2px);
		transform: translateY(-2px);
	}

	83.25% {
		-webkit-transform: translateY(1px);
		transform: translateY(1px);
	}

	100% {
		-webkit-transform: translateY(0);
		transform: translateY(0);
	}
}

@keyframes small-img {
	16.65% {
		-webkit-transform: translateY(8px);
		transform: translateY(8px);
	}

	33.3% {
		-webkit-transform: translateY(-6px);
		transform: translateY(-6px);
	}

	49.95% {
		-webkit-transform: translateY(4px);
		transform: translateY(4px);
	}

	66.6% {
		-webkit-transform: translateY(-2px);
		transform: translateY(-2px);
	}

	83.25% {
		-webkit-transform: translateY(1px);
		transform: translateY(1px);
	}

	100% {
		-webkit-transform: translateY(0);
		transform: translateY(0);
	}
}

.small-img {
	display: inline-block;
	-webkit-transform: translateZ(0);
	transform: translateZ(0);
	box-shadow: 0 0 1px rgba(0, 0, 0, 0);
}

#slideshow:hover .small-img {
	-webkit-animation-name: small-img;
	animation-name: small-img;
	-webkit-animation-duration: 1s;
	animation-duration: 1s;
	-webkit-animation-timing-function: ease-in-out;
	animation-timing-function: ease-in-out;
	-webkit-animation-iteration-count: 1;
	animation-iteration-count: 1;
}
</style>

<div class="container">
	<!-- 幻灯 -->
	<?php get_template_part( '/group/group-slider' ); ?>
	<div id="group-section">
		<?php 
	function group() {
			// 关于
			get_template_part( '/group/group-contact' );
			// 服务
			get_template_part( '/group/group-dean' );
			// 产品
			get_template_part( '/group/group-show' );
			// 项目
			get_template_part( '/group/group-service' );
			// WOO产品
			get_template_part( '/group/group-woo' );
			// 简介
			get_template_part( '/group/group-features' );
			// 分类左图
			get_template_part( '/group/group-wd-l' );
			// 分类右图 
			get_template_part( '/group/group-wd-r' );
			// 说明
			get_template_part( '/group/group-explain' );
			// 一栏小工具
			get_template_part( '/group/group-widget-one' );
			// EDD下载
			get_template_part( '/group/group-dow-tab' );
			// 最新文章
			require get_template_directory() . '/group/group-news.php';
			// 三栏小工具
			get_template_part( '/group/group-widget-three' );
			// 新闻资讯A
			require get_template_directory() . '/group/group-cat-a.php';
			// 两栏小工具
			get_template_part( '/group/group-widget-two' );
			// 新闻资讯B
			require get_template_directory() . '/group/group-cat-b.php';
			// 产品案例
			require get_template_directory() . '/group/group-tab.php';
			// 新闻资讯 C
			require get_template_directory() . '/group/group-cat-c.php';
}
		 ?>
<?php group(); ?>
	</div>
	<div class="clear"></div>

	<!-- 滚动 -->
	<?php require get_template_directory() . '/group/group-carousel.php'; ?>

</div><!-- container end -->

<?php get_footer(); ?>