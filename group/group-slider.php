<?php if (zm_get_option('group_slider')) { ?>
<div class="g-row">
	<div class="home-slider">
		<div id="slideshow">
		<script type="text/javascript">
			$(document).ready(function(){
				$("#slider-home").responsiveSlides({
					auto: true,
					pager: true,
					nav: true,
					speed: 800,
					timeout: 5000,
					pause: true,
					// maxwidth: 3000,
					namespace: "callbacks"
				});
			});
		</script>
			<ul class="rslides" id="slider-home">
				<?php
					$args = array(
						'posts_per_page' => zm_get_option('group_slider_n'),
						'post_type' => 'page', 
						'meta_key' => 'guide_img',
						'ignore_sticky_posts' => 1
					);
					query_posts($args);
				?>
				<?php while (have_posts()) : the_post(); ?>
				<?php $image = get_post_meta($post->ID, 'guide_img', true); ?>
				<?php $group_slider_url = get_post_meta($post->ID, 'group_slider_url', true); ?>
				<?php $small_img = get_post_meta($post->ID, 'small_img', true); ?>
				<?php 
					$s_t_a = get_post_meta($post->ID, 's_t_a', true);
					$s_t_b = get_post_meta($post->ID, 's_t_b', true);
					$s_t_c = get_post_meta($post->ID, 's_t_c', true);
					$s_n_b = get_post_meta($post->ID, 's_n_b', true);
					$s_n_b_l = get_post_meta($post->ID, 's_n_b_l', true);
				?>
					<li>
						<?php if (zm_get_option('group_slider_url')) { ?>
							<?php if ( get_post_meta($post->ID, 'small_img', true) ) : ?><a href="<?php if ( get_post_meta($post->ID, 'group_slider_url', true) ) { ?><?php echo $group_slider_url; ?><?php } else { ?><?php the_permalink() ?><?php } ?>" rel="bookmark"><ul class="small-img wow fadeInLeft" data-wow-delay="0.5s"><img src="<?php echo $small_img; ?>"></ul></a><?php endif; ?>
							<a href="<?php if ( get_post_meta($post->ID, 'group_slider_url', true) ) { ?><?php echo $group_slider_url; ?><?php } else { ?><?php the_permalink() ?><?php } ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
						<?php } else { ?>
							<?php if ( get_post_meta($post->ID, 'small_img', true) ) : ?><ul class="small-img wow fadeInLeft" data-wow-delay="0.5s"><img src="<?php echo $small_img; ?>"></ul><?php endif; ?>
							<img src="<?php echo $image; ?>" />
						<?php } ?>
						<?php if (zm_get_option('group_slider_t')) { ?>
						<?php if ( get_post_meta($post->ID, 's_t_b', true) ) { ?>
							<span class="group-slider-main wow fadeInUp" data-wow-delay="0.5s">
								<span class="group-slider-content">
									<p class="s-t-a wow fadeInRight" data-wow-delay="0.5s"><?php echo $s_t_a; ?></p>
									<p class="s-t-b wow fadeInRight" data-wow-delay="0.7s"><?php echo $s_t_b; ?></p>
									<p class="s-t-c wow fadeInRight" data-wow-delay="0.9s"><?php echo $s_t_c; ?></p>
								</span>
								<?php if ( get_post_meta($post->ID, 's_n_b', true) ) { ?>
									<span class="group-img-more wow fadeInRight" data-wow-delay="1.1s"><a href="<?php echo $s_n_b_l; ?>" rel="bookmark" target="_blank"><?php echo $s_n_b; ?></a></span>
								<?php } ?>
							</span>
						<?php } ?>
						<?php } ?>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>
		</div>
	</div>
</div>
<?php } ?>