<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
<?php endif; ?>

	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<?php if ( get_post_meta($post->ID, 'header_img', true) ) { ?>
				<div class="entry-title-clear"></div>
			<?php } else { ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php } ?>
		<?php else : ?>
			<span class="format-img-cat"><?php zm_category(); ?></span>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( ! is_single() ) : ?>
			<figure class="content-image">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php if (zm_get_option('lazy_s')) { format_image_thumbnail_h(); } else { format_image_thumbnail(); } ?></a>
			</figure>
			<span class="title-l"></span>
			<span class="post-format"><i class="be be-picture"></i></span>
			<?php the_title( sprintf( '<h2 class="post-format-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?><span class="img-number">共 <?php echo get_post_images_number().' 张图片' ?></span>
			<div class="clear"></div>

		<?php else : ?>

			<?php if (zm_get_option('meta_b')) {
				begin_single_meta();
			} else {
				begin_entry_meta();
			} ?>

			<div class="single-content">
				<?php if ( has_excerpt() ) { ?><span class="abstract"><fieldset><legend>摘 要</legend><?php the_excerpt() ?><div class="clear"></div></fieldset></span><?php }?>
				<?php get_template_part('ad/ads', 'single'); ?>
				<?php the_content(); ?>
			</div>

			<?php get_template_part( 'inc/file' ); ?>
			<?php if ( get_post_meta($post->ID, 'no_sidebar', true) ) : ?><style>#primary {width: 100%;}#sidebar, .r-hide, .s-hide {display: none;}</style><?php endif; ?>

			<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>

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
				<?php if (zm_get_option('meta_b')) {
					begin_single_cat();
				} ?>
			</footer><!-- .entry-footer -->

		<?php endif; ?>
	</div><!-- .entry-content -->

</article><!-- #post -->

<?php if ( is_single() ) : ?><div class="single-tag"><?php the_tags( '<ul class="wow fadeInUp" data-wow-delay="0.3s"><li>', '</li><li>', '</li></ul>' ); ?></div><?php endif; ?>