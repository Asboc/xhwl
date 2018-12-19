<?php if (zm_get_option('slider')) { ?>
<div id="slideshow"  class="wow fadeInUp" data-wow-delay="0.3s">
	<ul class="rslides" id="slider">
		<?php if (zm_get_option('show_order')) { ?>
			<?php
				$args = array(
					'posts_per_page' => zm_get_option('slider_n'),
					'meta_key' => 'show',
					'meta_key' => 'show_order',
					'orderby' => 'meta_value',
					'order' => 'date',
					'ignore_sticky_posts' => 1
				);
				query_posts($args);
			?>
		<?php } else { ?>
			<?php
				$args = array(
					'posts_per_page' => zm_get_option('slider_n'),
					'meta_key' => 'show',
					'ignore_sticky_posts' => 1
				);
				query_posts($args);
			?>
		<?php } ?>
		<?php while (have_posts()) : the_post(); $do_not_duplicate[] = $post->ID; $do_show[] = $post->ID; ?>
		<?php $image = get_post_meta($post->ID, 'show', true); ?>
		<?php $go_url = get_post_meta($post->ID, 'show_url', true); ?>
			<li>
				<?php if ( get_post_meta($post->ID, 'show_url', true) ) : ?>
				<a href="<?php echo $go_url; ?>" target="_blank" rel="external nofollow"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
				<?php else: ?>
				<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
				<?php endif; ?>
				<p class="slider-caption"><?php the_title(); ?></p>
			</li>
			
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>
<?php } ?>