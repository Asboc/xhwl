<?php
/**
 * 通长缩略图分类模板
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('full-text wow fadeInUp'); ?>>
				<?php if (zm_get_option('lazy_s')) { zm_full_thumbnail_h(); } else { zm_full_thumbnail(); } ?>
				<span class="full-cat"><?php zm_category(); ?></span>
				<div class="clear"></div>
				<div class="full-archive-content">
					<!-- <?php the_content( sprintf( 继续阅读 ) ); ?> -->
					<?php if (has_excerpt('')){
							echo wp_trim_words( get_the_excerpt(), 150, '...' );
						} else {
							$content = get_the_content();
							$content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
							echo wp_trim_words( $content, 150, '...' );
				        }
					?>
				</div>
				<div class="full-meta">
					<div class="full-entry-meta">
						<?php begin_entry_meta(); ?>
						<span class="full-entry-more"><a href="<?php the_permalink(); ?>" rel="bookmark"><i class="be be-more"></i></a></span>
					</div>
				</div>
				<div class="clear"></div>
			</article>

			<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part('ad/ads', 'archive'); ?></div>

			<?php endwhile; ?>

		</main>

		<?php begin_pagenav(); ?>

	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>