<?php get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/sites.css" />
<style type="text/css">
#primary {
 	float: right;
	position: relative;
	background: #fff;
	margin: 0 0 10px 0;
	padding: 10;
	border: 1px solid #ddd;
	border-radius: 2px;
}
#sidebar {
	float: left;
}
</style>
<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="sites-box">
			<?php if ( have_posts() ) : ?>
			<?php $posts = query_posts($query_string . '&orderby=date&showposts=1000');?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="archive-5">
					<?php if ( get_post_meta($post->ID, 'sites_img_link', true) ) { ?>
						<?php $sites_img_link = sites_nofollow(get_post_meta($post->ID, 'sites_img_link', true)); ?>
						<span class="sites-archive-title wow fadeInUp" data-wow-delay="0.3s">
							<figure class="picture-img sites-img"><?php if (zm_get_option('lazy_s')) { zm_sites_thumbnail_h(); } else { zm_sites_thumbnail(); } ?></figure>
							<a href="<?php echo $sites_img_link ?>" target="_blank" rel="external nofollow"><?php the_title(); ?></a>
						</span>
					<?php } else { ?>
						<?php $sites_link = sites_nofollow(get_post_meta($post->ID, 'sites_link', true)); ?>
						<span class="sites-archive-title wow fadeInUp" data-wow-delay="0.3s"><a href="<?php echo $sites_link ?>" target="_blank" rel="external nofollow"><?php the_title(); ?></a></span>
					<?php } ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
			<?php else : ?>
				您还没有添加网址
			<?php endif; ?>
			<div class="clear"></div>
		</div>
	</main>
</section>


<div id="sidebar" class="widget-area">
	<div class="wow fadeInUp" data-wow-delay="0.5s">
		<?php dynamic_sidebar( 'favorites' ); ?>
	</div>
</div>

<?php get_footer(); ?>