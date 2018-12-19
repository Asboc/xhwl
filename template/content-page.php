<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
<?php endif; ?>

	<header class="entry-header">
		<?php if ( get_post_meta($post->ID, 'header_img', true) ) { ?>
			<div class="entry-title-clear"></div>
		<?php } else { ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php } ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
			<div class="single-content">
				<?php the_content(); ?>

				<?php get_template_part( 'inc/file' ); ?>
				<?php if ( get_post_meta($post->ID, 'no_sidebar', true) ) : ?><style>#primary {width: 100%;}#sidebar, .r-hide, .s-hide {display: none;}</style><?php endif; ?>

				<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
				<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
				<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>
			</div>

			<footer class="single-footer">
				<?php begin_page_meta(); ?>
			</footer><!-- .entry-footer -->
	</div><!-- .entry-content -->

</article><!-- #page -->