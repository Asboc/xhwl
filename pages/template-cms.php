<?php
/*
Template Name: 杂志布局
*/
?>
<?php get_header(); ?>
<!-- 通栏幻灯 -->
<?php 
	if (!zm_get_option('slider_l') || (zm_get_option("slider_l") == 'slider_w')) {
		require get_template_directory() . '/template/slider.php';
	}
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php 
			// 幻灯
			if (zm_get_option('slider_l') == 'slider_n') {
				require get_template_directory() . '/template/slider.php';
			}
			// 置顶
			get_template_part( '/cms/cms-top' );
			// 最新文章
			require get_template_directory() . '/cms/cms-news.php';
			// 单栏小工具
			get_template_part( '/cms/cms-widget-one' );
			// 单栏分类5篇
			require get_template_directory() . '/cms/cms-cat-one-5.php';
			// 单栏分类10篇
			require get_template_directory() . '/cms/cms-cat-one-10.php';
			// 图片日志
			get_template_part( '/cms/cms-picture' );
			// 两栏小工具
			get_template_part( '/cms/cms-widget-two' );
			// 主体两栏分类
			require get_template_directory() . '/cms/cms-cat-small.php';
			// 视频日志
			get_template_part( '/cms/cms-video' );
			// TAB切换
			get_template_part( '/cms/cms-tab' );
		?>
	</main>
</div>
<!-- 上部结束 -->

<!-- 侧边小工具 -->
<?php get_sidebar('cms'); ?>

<!-- 下部 -->
<div id="below-main">
<?php 
	// 产品日志
	get_template_part( '/cms/cms-show' );
	// 分类方形
	require get_template_directory() . '/cms/cms-cat-square.php';
	// 分类网格
	require get_template_directory() . '/cms/cms-cat-grid.php';
	// 横向图片滚动
	get_template_part( '/cms/cms-scrolling' );
	// 底部分类
	require get_template_directory() . '/cms/cms-cat-big.php';
	// 淘客
	get_template_part( '/cms/cms-tao' );
	// 下载
	get_template_part( '/cms/cms-dow-tab' );
	// 产品
	get_template_part( '/cms/cms-product' );
	// 无缩略图分类
	require get_template_directory() . '/cms/cms-cat-big-n.php'; 
	?>
</div>
<!-- 页脚 -->
<?php get_footer(); ?>