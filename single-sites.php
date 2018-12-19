<?php get_header(); ?>

<style type="text/css">
.single-sites #primary {
	position: relative;
	background: #fff;
	margin: 0 0 10px 0;
	padding: 20px;
	border: 1px solid #ddd;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
	border-radius: 2px;
} 
</style>

<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
					<header class="entry-header"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></header>
					<div class="entry-content">
						<div class="single-content">
							<?php get_template_part('ad/ads', 'single'); ?>
							<?php the_content(); ?>
						</div>
						<?php if (zm_get_option('single_weixin')) { ?>
							<?php get_template_part( 'template/weixin' ); ?>
						<?php } ?>

						<?php if (zm_get_option('zm_like')) { ?>
							<?php get_template_part( 'template/social' ); ?>
						<?php } else { ?>
							<div id="social"></div>
						<?php } ?>

						<?php get_template_part('ad/ads', 'single-b'); ?>

						<footer class="single-footer">
							<ul class="single-meta">
								<?php edit_post_link('编辑', '<li class="edit-link">', '</li>' ); ?>
								<?php if( function_exists( 'the_views' ) ) { the_views(true, '<li class="views"><i class="be be-eye"></i> ','</li>');  } ?>
							</ul>
							<ul id="fontsize">A+</ul>
							<div class="single-cat-tag">
								<div class="single-cat">日期：<?php the_time( 'Y年m月d日' ) ?> 分类：<?php echo get_the_term_list( $post->ID,  'favorites', '' ); ?></div>
							</div>
						</footer><!-- .entry-footer -->

						<div class="clear"></div>
					</div>
				</article>
			<?php endwhile; ?>
		</main>
	</div>
<div id="sidebar" class="widget-area">
	<div class="wow fadeInUp" data-wow-delay="0.5s">
		<?php dynamic_sidebar( 'favorites' ); ?>
	</div>
</div>
<?php get_footer(); ?>