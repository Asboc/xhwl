<?php
/*
Template Name: 百度搜索
*/
?>
<?php get_header(); ?>

<style type="text/css">
#bdcs-frame-box {
	background: transparent !important;
}
#bdcs-frame-box iframe {
    height: 1700px;
}
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div id="bdcs-frame-box"></div>
				<script type="text/javascript">
				var bdcsFrameSid="<?php echo zm_get_option('baidu_id'); ?>";
				var bdcsFrameCharset= "utf-8";
				var bdcsFrameWidth = 650;
				var bdcsFrameHeight = 1300;
				var bdcsFrameWt = 1;
				var bdcsFrameHt = 2;
				var bdcsFrameResultNum = 20;
				var bdcsFrameBgColor = "#fff";
				var bdcsRecommend = 0;
				var bdcsDefaultQuery = 0;
				var bdcsRemoveUrl = 0;
				</script>
				<script type="text/javascript" src="http://zhannei.baidu.com/static/js/iframe.js"></script>
			</article><!-- #page -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>