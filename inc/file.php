<?php if ( get_post_meta($post->ID, 'button1', true) ) : ?>
<div id="button_box">
	<div id="button_file">
		<h3>文件下载</h3>
			<div class="file_ad"><?php echo stripslashes( zm_get_option('ad_f') ); ?></div>
			<div class="buttons">
			<?php if ( zm_get_option('link_to')) { ?>
			<?php if ( get_post_meta($post->ID, 'button1', true) ) : ?>
			<?php $button1 = get_post_meta($post->ID, 'button1', true); ?>
			<?php $url1 = link_nofollow( get_post_meta($post->ID, 'url1', true)); ?>
			<a href="<?php echo $url1; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button1; ?></a>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'button2', true) ) : ?>
			<?php $button2 = get_post_meta($post->ID, 'button2', true); ?>
			<?php $url2 = link_nofollow( get_post_meta($post->ID, 'url2', true)); ?>
			<a href="<?php echo $url2; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button2; ?></a>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'button3', true) ) : ?>
			<?php $button3 = get_post_meta($post->ID, 'button3', true); ?>
			<?php $url3 = link_nofollow( get_post_meta($post->ID, 'url3', true)); ?>
			<a href="<?php echo $url3; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button3; ?></a>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'button4', true) ) : ?>
			<?php $button4 = get_post_meta($post->ID, 'button4', true); ?>
			<?php $url4 = link_nofollow( get_post_meta($post->ID, 'url4', true)); ?>
			<a href="<?php echo $url4; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button4; ?></a>
			<?php endif; ?>

			<?php } else { ?>

			<?php if ( get_post_meta($post->ID, 'button1', true) ) : ?>
			<?php $button1 = get_post_meta($post->ID, 'button1', true); ?>
			<?php $url1 = get_post_meta($post->ID, 'url1', true); ?>
			<a href="<?php echo $url1; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button1; ?></a>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'button2', true) ) : ?>
			<?php $button2 = get_post_meta($post->ID, 'button2', true); ?>
			<?php $url2 = get_post_meta($post->ID, 'url2', true); ?>
			<a href="<?php echo $url2; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button2; ?></a>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'button3', true) ) : ?>
			<?php $button3 = get_post_meta($post->ID, 'button3', true); ?>
			<?php $url3 = get_post_meta($post->ID, 'url3', true); ?>
			<a href="<?php echo $url3; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button3; ?></a>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'button4', true) ) : ?>
			<?php $button4 = get_post_meta($post->ID, 'button4', true); ?>
			<?php $url4 = get_post_meta($post->ID, 'url4', true); ?>
			<a href="<?php echo $url4; ?>" rel="external nofollow" target="_blank"><i class="be be-clouddownload"></i> <?php echo $button4; ?></a>
			<?php endif; ?>

			<?php } ?>

		</div>
		<div class="clear"></div>
	</div>
</div>
<?php endif; ?>