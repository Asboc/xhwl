<?php if (zm_get_option('ad_s')) { ?>
	<?php if ( wp_is_mobile() ) { ?>
		<div class="ad-m ad-site"><?php echo stripslashes( zm_get_option('ad_s_c_m') ); ?></div>
	<?php } else { ?>
		<div class="ad-pc ad-site"><?php echo stripslashes( zm_get_option('ad_s_c') ); ?></div>
	<?php } ?>
<?php } ?>