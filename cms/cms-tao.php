<?php if (zm_get_option('tao_h')) { ?>
<div class="line-tao sort" name="<?php echo zm_get_option('tao_h_s'); ?>">
	<?php 
		if (zm_get_option('rand_tao')) {
			$args = array('tax_query' => array( array('taxonomy' => 'taobao', 'field' => 'id', 'terms' => explode(',',zm_get_option('tao_h_id') ))), 'orderby' => 'rand', 'posts_per_page' => zm_get_option('tao_h_n'));
		} else {
			$args = array('tax_query' => array( array('taxonomy' => 'taobao', 'field' => 'id', 'terms' => explode(',',zm_get_option('tao_h_id') ))), 'posts_per_page' => zm_get_option('tao_h_n'));
		}
		query_posts($args); while ( have_posts() ) : the_post();
	?>

	<div class="xl4 xm4">
		<div class="tao-h wow fadeInUp" data-wow-delay="0.3s">
			<figure class="tao-h-img">
				<?php if (zm_get_option('lazy_s')) { tao_thumbnail_h(); } else { tao_thumbnail(); } ?>
			</figure>
			<div class="product-box">
				<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<div class="ded">
					<ul class="price">
						<li class="pricex"><strong>￥ <?php $price = get_post_meta($post->ID, 'pricex', true);{ echo $price; }?>元</strong></li>
						<?php if ( get_post_meta($post->ID, 'pricey', true) ) : ?>
							<li class="pricey"><del>市场价：<?php $price = get_post_meta($post->ID, 'pricey', true);{ echo $price; }?>元</del></li>
						<?php endif; ?>
					</ul>
					<div class="go-url">
						<div class="taourl">
							<?php if ( get_post_meta($post->ID, 'taourl', true) ) { ?>
							<?php
								$url = get_post_meta($post->ID, 'taourl', true);
								echo "<div class='taourl'><a href='".get_template_directory_uri()."/inc/go.php?url=$url' rel='external nofollow' target='_blank' class='url'>购买</a></div>";
							 ?>
							<!-- <a target="_blank" rel="external nofollow" href="<?php $url = get_post_meta($post->ID, 'taourl', true);{ echo $url; }?>" >购买</a> -->
							<?php } else { ?>
								<a href="<?php the_permalink(); ?>" >购买</a>
							<?php } ?>
						</div>
						<div class="detail"><a href="<?php the_permalink(); ?>" rel="bookmark">详情</a></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>

	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>
<?php } ?>