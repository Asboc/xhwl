<?php if (zm_get_option('grid_cat_a')) { ?>
<?php $display_categories =  explode(',',zm_get_option('grid_cat_a_id') ); foreach ($display_categories as $category) { ?>
	<?php query_posts( array( 'showposts' => zm_get_option('grid_cat_a_n'), 'cat' => $category, 'offset' => 0, 'post__not_in' => $do_not_duplicate ) ); ?>
	<div class="grid-cat-box wow fadeInUp" data-wow-delay="0.3s">
		<h3 class="grid-cat-title">
			<span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>
			<a href="<?php echo get_category_link($category);?>" title="<?php echo strip_tags(category_description($category)); ?>"><?php single_cat_title(); ?><i class="be be-more"></i></a>
		</h3>
		<div class="clear"></div>
		<div class="grid-cat-site grid-cat-4">
			<?php while ( have_posts() ) : the_post(); ?>
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
			<?php wp_reset_query(); ?>
		<div class="clear"></div>
	</div>
<?php } ?>
<?php } ?>