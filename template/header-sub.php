<?php if (!is_search() && !is_tag() && is_archive()) { ?>
	<?php if (zm_get_option('cat_des')) { ?>
		<?php if ( !is_paged() && category_description()){ ?>
			<div class="header-sub">
				<div class="cat-des wow fadeInUp" data-wow-delay="0.3s">
					<img src="<?php if (function_exists('zm_taxonomy_image_url')) echo zm_taxonomy_image_url(); ?>" alt="<?php single_cat_title(); ?>">
					<div class="des-title">
						<div class="des-t"><?php single_cat_title(); ?></div>
						<?php if (zm_get_option('cat_des_p')) { ?><?php echo the_archive_description( '<div class="des-p">', '</div>' ); ?><?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>

	<?php if ( !is_paged() ) : ?>
		<?php get_template_part( 'template/cat-top' ); ?>
		<?php if (zm_get_option('child_cat')) { ?>
			<?php child_cat(); ?>
		<?php } ?>
	<?php endif; ?>
<?php } ?>