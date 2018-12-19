<?php if (zm_get_option('grid_cat_new')) { ?>
<div class="grid-cat-box wow fadeInUp" data-wow-delay="0.3s">
<?php $recent = new WP_Query( array( 'posts_per_page' => zm_get_option('grid_cat_news_n'), 'category__not_in' => explode(',',zm_get_option('not_news_n'))) ); ?>
	<div class="grid-cat-new-box">
		<h3 class="grid-cat-title-new wow fadeInUp" data-wow-delay="0.3s">最近更新</h3>
		<div class="clear"></div>
		<div class="grid-cat-site grid-cat-4">
			<?php while($recent->have_posts()) : $recent->the_post(); $count++; $do_not_duplicate[] = $post->ID; ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
					<div class="grid-cat-bx4">
						<figure class="picture-img">
							<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
						</figure>

						<?php the_title( sprintf( '<h2 class="grid-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

						<span class="grid-inf">
							<span class="g-cat"><i class="be be-folder"></i> <?php zm_category(); ?></span>
							<span class="grid-inf-l">
								<span class="date"><i class="be be-schedule"></i> <?php the_time( 'm/d' ); ?></span>
								<?php if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views"><i class="be be-eye"></i> ','</span>' ); } ?>
								<?php if ( get_post_meta($post->ID, 'zm_like', true) ) : ?><span class="grid-like"><span class="be be-thumbs-up-o">&nbsp;<?php zm_get_current_count(); ?></span></span><?php endif; ?>
							</span>
			 			</span>

			 			<div class="clear"></div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>
<?php } ?>