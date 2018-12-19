<div class="g-row">
	<div class="g-col">
		<div class="section-box">
			<div class="group-title wow fadeInUp" data-wow-delay="0.3s">
				<?php $s_c_t = get_post_meta($post->ID, 's_c_t', true); ?>
				<h3><?php echo $s_c_t; ?><?php edit_post_link('<i class="be be-editor"></i>', '', '' ); ?></h3>
				<div class="clear"></div>
			</div>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
					<div class="entry-content">
						<div class="single-content">
							<?php the_content(); ?>
						</div>
						<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="be be-arrowleft"></i></span>', 'nextpagelink' => "")); ?>
						<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
						<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="be be-arrowright"></i></span> ')); ?>

						<div class="clear"></div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>