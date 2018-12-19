<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template/content', 'page' ); ?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php endwhile; ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>