<?php if (zm_get_option('tab_h')) { ?>
<div class="tab-site wow fadeInUp sort" data-wow-delay="0.3s" name="<?php echo zm_get_option('tab_h_s'); ?>">
	<div id="layout-tab" class="tab-product">
	    <h2 class="tab-hd">
		    <span class="tab-hd-con"><a href="javascript:"><?php echo zm_get_option('tab_a'); ?></a></span>
		    <span class="tab-hd-con"><a href="javascript:"><?php echo zm_get_option('tab_b'); ?></a></span>
		    <span class="tab-hd-con"><a href="javascript:"><?php echo zm_get_option('tab_c'); ?></a></span>
	    </h2>

		<div class="tab-bd dom-display">

			<ul class="tab-bd-con current">
				<?php query_posts('showposts='.zm_get_option('tabt_n').'&cat='.zm_get_option('tabt_id')); while (have_posts()) : the_post(); ?>
				<?php the_title( sprintf( '<li class="list-title"><i class="be be-arrowright"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>

			<ul class="tab-bd-con">
				<?php query_posts('showposts='.zm_get_option('tabt_n').'&cat='.zm_get_option('tabz_n')); while (have_posts()) : the_post(); ?>
				<?php the_title( sprintf( '<li class="list-title"><i class="be be-arrowright"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
		    </ul>

			<ul class="tab-bd-con">
				<?php query_posts('showposts='.zm_get_option('tabt_n').'&cat='.zm_get_option('tabq_n')); while (have_posts()) : the_post(); ?>
				<?php the_title( sprintf( '<li class="list-title"><i class="be be-arrowright"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>

		</div>
	</div>
</div>
<div class="clear"></div>
<?php } ?>