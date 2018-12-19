<?php if (zm_get_option('ad_a')) { ?>
<div class="ad-cms wow fadeInUp" data-wow-delay="0.3s">
	<?php if ( wp_is_mobile() ) { ?>
		<?php if ( zm_get_option('ad_a_c_m') ) { ?><div class="ad-m ad-site"><?php echo stripslashes( zm_get_option('ad_a_c_m') ); ?></div><?php } ?>
	<?php } else { ?>
		<?php if ( zm_get_option('ad_a_c') ) { ?><div class="ad-pc ad-site"><?php echo stripslashes( zm_get_option('ad_a_c') ); ?></div><?php } ?>
	<?php } ?>
</div>
<?php } ?>