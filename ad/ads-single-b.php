<?php if (zm_get_option('ad_s_b')) { ?>
	<?php if ( wp_is_mobile() ) { ?>
		<div class="ad-m ad-site"><?php echo stripslashes( zm_get_option('ad_s_c_b_m') ); ?></div>
	<?php } else { ?>
		<div class="ad-pc ad-site"><?php echo stripslashes( zm_get_option('ad_s_c_b') ); ?></div>
	<?php } ?>
<?php } ?>