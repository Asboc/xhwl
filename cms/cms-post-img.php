<?php query_posts( array ( 'meta_key' => 'post_img', 'showposts' => zm_get_option('post_img_n'), 'ignore_sticky_posts' => 1, 'post__not_in' => $do_not_duplicate ) ); while ( have_posts() ) : the_post(); ?>

<div class="xl4 xm4">
	<div class="picture-h wow fadeInUp" data-wow-delay="0.3s">
		<figure class="picture-h-img">
			<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
			<h2 class="posting-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo wp_trim_words( get_the_title(), 24 ); ?></a></h2>
		</figure>
	</div>
</div>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>