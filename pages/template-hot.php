<?php
/*
Template Name: 热门文章
*/
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$args = array(
				    'meta_key' => 'views',
				    'orderby'   => 'meta_value_num',
					'paged' => $paged
				);
				query_posts( $args );
		 	?>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template/content', get_post_format() ); ?>

				<?php get_template_part('ad/ads', 'archive'); ?>

			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template/content', 'none' ); ?>
			<?php endif; ?>

		</main><!-- .site-main -->

		<div class="pagenav-clear"><?php begin_pagenav(); ?></div>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php if (zm_get_option('scroll')) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/infinite-scroll.js"></script>
<script type="text/javascript">$(document).ready(function(){var infinite_scroll={loading:{img:"<?php echo get_template_directory_uri(); ?>/img/infinite.gif",msgText:"",finishedMsg:"滚动加载结束."},nextSelector:"#nav-below .nav-previous a",navSelector:"#nav-below",itemSelector:"article",animate: true,maxPage:"<?php echo zm_get_option('scroll_n'); ?>",contentSelector:"#main"};$(infinite_scroll.contentSelector).infinitescroll(infinite_scroll)});</script>
<?php } ?>
<script type="text/javascript">
    document.onkeydown = chang_page;function chang_page(e) {
        var e = e || event,
        keycode = e.which || e.keyCode;
        if (keycode == 37) location = '<?php echo get_previous_posts_page_link(); ?>';
        if (keycode == 39) location = '<?php echo get_next_posts_page_link(); ?>';
    }
</script>
<?php get_footer(); ?>