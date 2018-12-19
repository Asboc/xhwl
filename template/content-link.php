<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
<?php endif; ?>
	<?php if ( ! is_single() ) : ?>
		<figure class="thumbnail">
			<?php if (zm_get_option('lazy_s')) { zm_ad_thumbnail_h(); } else { zm_ad_thumbnail(); } ?>
			<span class="cat"><?php zm_category(); ?></span>
		</figure>
	<?php endif; ?>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<?php if ( get_post_meta($post->ID, 'header_img', true) ) { ?>
				<div class="entry-title-clear"></div>
			<?php } else { ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php } ?>
		<?php else : ?>
			<?php if ( get_post_meta($post->ID, 'direct', true) ) { ?>
				<?php $direct = get_post_meta($post->ID, 'direct', true); ?>
				<h2 class="entry-title"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php the_title(); ?></a></h2>
			<?php } else { ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php } ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( ! is_single() ) : ?>
			<div class="archive-content">
				<?php if (has_excerpt('')){
						echo wp_trim_words( get_the_excerpt(), zm_get_option('word_n'), '...' );
					} else {
						$content = get_the_content();
						$content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
						echo wp_trim_words( $content, zm_get_option('words_n'), '...' );
			        }
				?>
			</div>
			<span class="title-l"></span>
			<span class="post-format">
				<?php if ( get_post_meta($post->ID, 'direct', true) ) { ?>
					<a href="<?php the_permalink(); ?>" target="_blank"><i class="be be-link"></i></a>
				<?php } else { ?>
					<i class="be be-link"></i>
				<?php } ?>
			</span>
			<span class="entry-meta">
				<?php if ( get_post_meta($post->ID, 'link_inf', true) ) { ?>
				<?php $link_inf = get_post_meta($post->ID, 'link_inf', true); ?>
				<span class="link-price"><?php echo $link_inf; ?></span>
				<span class="date"><?php time_ago( $time_type ='post' ); ?>&nbsp;</span>
				<?php } else { ?>
					<?php begin_entry_meta(); ?>
				<?php } ?>
			</span>
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

			<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="be be-arrowleft"></i></span>', 'nextpagelink' => "")); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="be be-arrowright"></i></span> ')); ?>

			<?php if ( get_post_meta($post->ID, 'direct', true) ) { ?>
			<?php $direct = get_post_meta($post->ID, 'direct', true); ?>
				<?php if ( get_post_meta($post->ID, 'direct_btn', true) ) { ?>
				<?php $direct_btn = get_post_meta($post->ID, 'direct_btn', true); ?>
					<span class="content-more"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php echo $direct_btn; ?></a></span>
				<?php } else { ?>
					<span class="content-more"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php echo zm_get_option('direct_w'); ?></a></span>
				<?php } ?>
			<?php } else { ?>
			<?php } ?>

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
		<div class="clear"></div>
	</div><!-- .entry-content -->

	<?php if ( ! is_single() ) : ?>
		<?php if ( get_post_meta($post->ID, 'direct', true) ) { ?>
		<?php $direct = get_post_meta($post->ID, 'direct', true); ?>
			<?php if ( get_post_meta($post->ID, 'direct_btn', true) ) { ?>
			<?php $direct_btn = get_post_meta($post->ID, 'direct_btn', true); ?>
				<span class="entry-more"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php echo $direct_btn; ?></a></span>
			<?php } else { ?>
					<span class="entry-more"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php echo zm_get_option('direct_w'); ?></a></span>
			<?php } ?>
		<?php } else { ?>
			<span class="entry-more"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo zm_get_option('more_w'); ?></a></span>
		<?php } ?>
	<?php endif; ?>
</article><!-- #post -->

<?php if ( is_single() ) : ?><div class="single-tag"><?php the_tags( '<ul class="wow fadeInUp" data-wow-delay="0.3s"><li>', '</li><li>', '</li></ul>' ); ?></div><?php endif; ?>