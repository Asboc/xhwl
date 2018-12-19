<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<ul class="search-page">
			<?php $posts = query_posts($query_string . '&orderby=date&posts_per_page=20');?>
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<li class="search-inf">
						<?php time_ago( $time_type ='post' ); ?>
					</li>
					<?php the_title( sprintf( '<li class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>

				<?php endwhile; ?>
			</ul>
			<?php else : ?>
				<?php get_template_part( 'template/content', 'none' ); ?>
			<?php endif; ?>

		</main><!-- .site-main -->

		<?php begin_pagenav(); ?>

	</section><!-- .content-area -->


<?php get_footer(); ?>