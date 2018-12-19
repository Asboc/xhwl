<?php if (zm_get_option('cat_grid')) { ?>
<div class="cms-cat-grid wow fadeInUp sort" data-wow-delay="0.5s" name="<?php echo zm_get_option('cat_grid_s'); ?>">
	<?php $display_categories =  explode(',',zm_get_option('cat_grid_id') ); foreach ($display_categories as $category) { ?>
		<?php query_posts( array( 'showposts' => zm_get_option('cat_grid_n'), 'cat' => $category, 'offset' => 0, 'post__not_in' => $do_not_duplicate ) ); ?>
		<h3 class="cat-grid-title">
			<a href="<?php echo get_category_link($category);?>">
				<span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span>
				<?php single_cat_title(); ?><i class="be be-more"></i>
			</a>
		</h3>
		<div class="cat-g3">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<figure class="thumbnail">
					<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
				</figure>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header>

				<div class="entry-content">
					<span class="entry-meta">
						<?php begin_grid_meta(); ?>
					</span>
					<div class="clear"></div>
				</div>
			</article>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			<div class="clear"></div>
		</div>
	<?php } ?>
</div>
<div class="clear"></div>
<?php } ?>