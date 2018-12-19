<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
<?php endif; ?>
	<?php if ( ! is_single() ) : ?>
		<figure class="thumbnail">
			<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
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
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
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
			<span class="post-format"><i class="be be-display" aria-hidden="true"></i></span>
			<span class="entry-meta">
				<?php begin_entry_meta(); ?>
			</span>
		<?php else : ?>
			<div class="single-content">
				<?php if ( has_excerpt() ) { ?><span class="abstract"><fieldset><legend>摘 要</legend><?php the_excerpt() ?><div class="clear"></div></fieldset></span><?php }?>

				<?php get_template_part('ad/ads', 'single'); ?>
				<div class="videos-content">
					<div class="video-img">
						<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
					</div>

					<div class="video-inf">
						<span class="category"><strong>所属分类：</strong><?php the_category( '&nbsp;&nbsp;' ); ?></span>
						<span><?php $file_os = get_post_meta($post->ID, 'file_os', true); ?><?php echo $file_os; ?></span>
						<span><?php $file_inf = get_post_meta($post->ID, 'file_inf', true); ?><?php echo $file_inf; ?></span>
						<span class="date"><strong>最后更新：</strong><?php the_modified_date('Y年m月d日'); ?></ul>
					</div>
					<div class="clear"></div>
				</div>

				<?php the_content(); ?>
			</div>

			<?php get_template_part( 'inc/file' ); ?>
			<?php if ( get_post_meta($post->ID, 'no_sidebar', true) ) : ?><style>#primary {width: 100%;}#sidebar, .r-hide, .s-hide {display: none;}</style><?php endif; ?>

			<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="be be-arrowleft"></i></span>', 'nextpagelink' => "")); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="be be-arrowright"></i></span> ')); ?>

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
				<?php begin_entry_meta(); ?>
			</footer><!-- .entry-footer -->

		<?php endif; ?>
		<div class="clear"></div>
	</div><!-- .entry-content -->

	<?php if ( ! is_single() ) : ?>
		<?php if ( get_post_meta($post->ID, 'direct', true) ) { ?>
		<?php $direct = get_post_meta($post->ID, 'direct', true); ?>
		<span class="entry-more"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php echo zm_get_option('direct_w'); ?></a></span>
		<?php } else { ?>
		<span class="entry-more"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo zm_get_option('more_w'); ?></a></span>
		<?php } ?>
	<?php endif; ?>
</article><!-- #post -->

<?php if ( is_single() ) : ?><div class="single-tag"><?php the_tags( '<ul class="wow fadeInUp" data-wow-delay="0.3s"><li>', '</li><li>', '</li></ul>' ); ?></div><?php endif; ?>