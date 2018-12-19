<?php if (zm_get_option('group_carousel')) { ?>
<div id="section-gtg">
	<div class="g-row">
		<div class="g-col">
			<div class="owl-box">
				<div class="group-title wow fadeInDown" data-wow-delay="0.5s">
					<h3><i class="be be-skyatlas"></i> <?php echo zm_get_option('group_carousel_t'); ?> <i class="be be-skyatlas"></i></h3>
					<div class="group-des"><?php echo zm_get_option('carousel_des'); ?></div>
					<div class="clear"></div>
				</div>

				<div id="owl" class="owl-carousel wow fadeIn" data-wow-delay="0.7s"">
					<?php 
						if (zm_get_option('group_gallery')) {
							$loop = new WP_Query(array('tax_query' => array( array('taxonomy' => 'gallery', 'field' => 'id', 'terms' => explode(',',zm_get_option('group_gallery_id') ))), 'posts_per_page' => zm_get_option('carousel_n')) );
						} else {
							$loop = new WP_Query( array( 'cat' => zm_get_option('group_carousel_id'), 'posts_per_page' => zm_get_option('carousel_n'), 'post__not_in' => get_option( 'sticky_posts'), 'post__not_in' => $do_not_duplicate ) );
						}
						while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div id="post-<?php the_ID(); ?>" class="itemd">
						<?php zm_thumbnail(); ?>
						<?php the_title( sprintf( '<h2 class="carousel-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<div class="group-tab-meta">
							<div class="group-date"><?php time_ago( $time_type ='post' ); ?></div>
							<?php if( function_exists( 'the_views' ) ) { the_views( true, '<div class="group-views"><i class="be be-eye"></i> ','</div>' ); } ?>
							<div class="clear"></div>
						</div>
					</div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</div>
				<div class="gtg">
					<img src="<?php echo zm_get_option('group_carousel_img'); ?>" alt="demo">
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>