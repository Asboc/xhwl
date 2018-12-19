<?php if (zm_get_option('service')) { ?>
<?php
/**
 * 企业布局“服务宗旨”模块
 */
?>
<div class="g-row <?php if (zm_get_option('bg_4')) { ?>g-line<?php } ?> sort" name="<?php echo zm_get_option('service_s'); ?>">
	<div class="g-col">
		<div class="group-service-box">
			<div class="group-title group-service-title wow fadeInDown" data-wow-delay="0.5s">
				<h3><i class="be be-jie"></i> <?php echo zm_get_option('service_t'); ?> <i class="be be-jie"></i></h3>
				<div class="clear"></div>
			</div>
			<div class="group-service group-service-c">
				<div class="group-service-des">
					<?php $posts = get_posts( array( 'post_type' => any, 'include' =>zm_get_option('service_c_id')) ); if($posts) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
					<img class="wow fadeInDown" data-wow-delay="0.5s" src="<?php echo zm_get_option('service_c_img'); ?>" alt="service" />
					<div class="clear"></div>
					<div class="group-service-content wow fadeInUp" data-wow-delay="0.3s">
						<?php 
							$content = get_the_content();
							$content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
							echo wp_trim_words( $content, 200, '' );
						?>
					</div>
					<?php endforeach; endif; ?>
					<?php wp_reset_query(); ?>
					<div class="clear"></div>
				</div>
			</div>

			<div class="group-service group-service-l">
				<div class="service-box">
					<?php $posts = get_posts( array( 'post_type' => any, 'include' =>zm_get_option('service_l_id')) ); if($posts) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
					<div class="p4">
						<div class="p-4 wow fadeInLeft" data-wow-delay="0.3s">
							<figure class="service-thumbnail">
								<?php if (zm_get_option('lazy_s')) { tao_thumbnail_h(); } else { tao_thumbnail(); } ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><div class="group-img-b"><div class="group-img-m"></div></div></a>
							</figure>
							<h3 class="p4-title"><?php echo wp_trim_words( get_the_title(), 10 ); ?></h3>
							<div class="p4-content">
								<?php 
									$content = get_the_content();
									$content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
									echo wp_trim_words( $content, 16, '' );
								?>
							</div>
						</div>
					</div>
					<?php endforeach; endif; ?>
					<?php wp_reset_query(); ?>
					<div class="clear"></div>
				</div>
			</div>

			<div class="group-service group-service-r">
				<div class="service-box">
					<?php $posts = get_posts( array( 'post_type' => any, 'include' =>zm_get_option('service_r_id')) ); if($posts) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
					<div class="p4">
						<div class="p-4 wow fadeInRight" data-wow-delay="0.5s">
							<figure class="service-thumbnail">
								<?php if (zm_get_option('lazy_s')) { tao_thumbnail_h(); } else { tao_thumbnail(); } ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><div class="group-img-b"><div class="group-img-m"></div></div></a>
							</figure>
							<h3 class="p4-title"><?php echo wp_trim_words( get_the_title(), 10 ); ?></h3>
							<div class="p4-content">
								<?php 
									$content = get_the_content();
									$content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
									echo wp_trim_words( $content, 16, '' );
								?>
							</div>
						</div>
					</div>
					<?php endforeach; endif; ?>
					<?php wp_reset_query(); ?>
					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php } ?>