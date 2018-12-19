<div id="cat-top" class="wow fadeInUp" data-wow-delay="0.3s">
<?php query_posts( array ( 'meta_key' => 'cms_top', 'showposts' => zm_get_option('cms_top_n'), 'post__not_in' => get_option( 'sticky_posts') ) ); while ( have_posts() ) : the_post(); ?>
	<div class="cat-top-box">
		<article class="picture">
			<div class="picture-box">
				<figure class="picture-img">
					<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
					<?php the_title( sprintf( '<h2 class="cat-top-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</figure>
				<div class="clear"></div>
			</div>
		</article>
	</div>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
</div>