<?php if (zm_get_option('flexisel')) { ?>
<div class="wow fadeInUp sort" data-wow-delay="0.3s" name="<?php echo zm_get_option('flexisel_s'); ?>">
	<div class="clear"></div>
	<ul id="flexisel">
		<?php 
			if (zm_get_option('gallery_post')) {
				$loop = new WP_Query(array('tax_query' => array( array('taxonomy' => 'gallery', 'field' => 'id', 'terms' => explode(',',zm_get_option('gallery_id') ))), 'posts_per_page' => zm_get_option('flexisel_n')) );
			} else {
				$loop = new WP_Query( array( 'meta_key' => zm_get_option('key_n'), 'posts_per_page' => zm_get_option('flexisel_n'), 'post__not_in' => get_option( 'sticky_posts') ) );
			}
			while ( $loop->have_posts() ) : $loop->the_post();
		?>
	    <li>
	    	<?php zm_thumbnail(); ?>
	    	<?php the_title( sprintf( '<h2 class="flexisel-h-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</li>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
	<div class="clear"></div>
</div>
<?php } ?>