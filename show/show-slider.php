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
					$s_a_img_d = get_post_meta($post->ID, 's_a_img_d', true);
					$s_a_img_x = get_post_meta($post->ID, 's_a_img_x', true);
					$s_a_t_a = get_post_meta($post->ID, 's_a_t_a', true);
					$s_a_t_b = get_post_meta($post->ID, 's_a_t_b', true);
					$s_a_t_c = get_post_meta($post->ID, 's_a_t_c', true);
					$s_a_n_b = get_post_meta($post->ID, 's_a_n_b', true);
					$s_a_n_b_l = get_post_meta($post->ID, 's_a_n_b_l', true);
				?>
				<?php if ( get_post_meta($post->ID, 's_a_img_d', true) ) { ?>
					<li>
						<ul class="small-img"><img src="<?php echo $s_a_img_x; ?>"></ul>
						<img src="<?php echo $s_a_img_d; ?>">
						<?php if ( get_post_meta($post->ID, 's_a_t_b', true) ) { ?>
						<span class="show-slider-main wow fadeInUp" data-wow-delay="0.5s">
							<span class="show-slider-content">
								<p class="s-t-a"><?php echo $s_a_t_a; ?></p>
								<p class="s-t-b"><?php echo $s_a_t_b; ?></p>
								<p class="s-t-c"><?php echo $s_a_t_c; ?></p>
							</span>
							<?php if ( get_post_meta($post->ID, 's_a_n_b', true) ) { ?>
								<span class="show-img-more"><a href="<?php echo $s_a_n_b_l; ?>" rel="bookmark" target="_blank"><?php echo $s_a_n_b; ?></a></span>
							<?php } ?>
						</span>
						<?php } ?>
					</li>
				<?php } ?>

				<?php 
					$s_b_img_d = get_post_meta($post->ID, 's_b_img_d', true);
					$s_b_img_x = get_post_meta($post->ID, 's_b_img_x', true);
					$s_b_t_a = get_post_meta($post->ID, 's_b_t_a', true);
					$s_b_t_b = get_post_meta($post->ID, 's_b_t_b', true);
					$s_b_t_c = get_post_meta($post->ID, 's_b_t_c', true);
					$s_b_n_b = get_post_meta($post->ID, 's_b_n_b', true);
					$s_b_n_b_l = get_post_meta($post->ID, 's_b_n_b_l', true);
				?>
				<?php if ( get_post_meta($post->ID, 's_b_img_d', true) ) { ?>
					<li>
						<ul class="small-img"><img src="<?php echo $s_b_img_x; ?>"></ul>
						<img src="<?php echo $s_b_img_d; ?>">
						<?php if ( get_post_meta($post->ID, 's_b_t_a', true) ) { ?>
						<span class="group-slider-main wow fadeInUp" data-wow-delay="0.5s">
							<span class="group-slider-title">
							</span>
							<span class="group-slider-content">
								<p class="s-t-a"><?php echo $s_b_t_a; ?></p>
								<p class="s-t-b"><?php echo $s_b_t_b; ?></p>
								<p class="s-t-c"><?php echo $s_b_t_c; ?></p>
								<p class="s-t-c"><?php echo $s_b_n_b; ?></p>
							</span>
						</span>
						<?php } ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>