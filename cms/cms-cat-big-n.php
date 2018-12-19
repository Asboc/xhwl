<?php if (zm_get_option('cat_big_not')) { ?>
<div class="line-big sort" name="<?php echo zm_get_option('cat_big_not_s'); ?>">
	<?php $display_categories =  explode(',',zm_get_option('cat_big_not_id') ); foreach ($display_categories as $category) { ?>
	<?php query_posts( array( 'showposts' => zm_get_option('cat_big_not_n'), 'cat' => $category, 'post__not_in' => $do_not_duplicate ) ); ?>
	<div class="xl3 xm3">
		<div class="cat-box wow fadeInUp" data-wow-delay="0.3s">
			<h3 class="cat-title"><a href="<?php echo get_category_link($category);?>"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span><?php single_cat_title(); ?><i class="be be-more"></i></a></h3>
			<div class="clear"></div>
			<div class="cat-site">
				<ul class="cat-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php if (zm_get_option('list_date')) { ?><li class="list-date"><?php the_time('m/d'); ?></li><?php } ?>
						<?php the_title( sprintf( '<li class="list-title"><i class="be be-arrowright"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php } ?>