<?php if (zm_get_option('cat_one_5')) { ?>
<div class="line-one sort" name="<?php echo zm_get_option('cat_one_5_s'); ?>">
	<?php $display_categories =  explode(',',zm_get_option('cat_one_5_id') ); foreach ($display_categories as $category) { ?>
	<?php query_posts( array( 'showposts' => 2, 'cat' => $category, 'post__not_in' => $do_not_duplicate ) ); ?>
		<div class="cat-box wow fadeInUp" data-wow-delay="0.3s">
			<h3 class="cat-title"><a href="<?php echo get_category_link($category);?>"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span><?php single_cat_title(); ?><i class="be be-more"></i></a></h3>
			<div class="clear"></div>
			<div class="cat-site">
				<div class="line-one-img one-img-5">
					<?php while ( have_posts() ) : the_post(); ?>
						<figure class="line-one-thumbnail">
							<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
						</figure>
					<?php endwhile; ?>
					<div class="clear"></div>
				</div>
				<ul class="cat-one-list">
					<?php query_posts( array( 'showposts' => 5, 'cat' => $category, 'offset' => 0, 'post__not_in' => $do_not_duplicate ) ); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php if (zm_get_option('list_date')) { ?><li class="list-date"><?php the_time('m/d'); ?></li><?php } ?>
						<?php the_title( sprintf( '<li class="list-cat-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	<?php } ?>
</div>
<?php } ?>