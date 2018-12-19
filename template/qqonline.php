<li class="qqonline">
	<div class="online"><a href="javascript:void(0)" ><i class="be be-qq"></i></a></div>
		<?php if (zm_get_option('qr_img')) { ?>
			<div class="qqonline-box">
		<?php } else { ?>
			<div class="qqonline-box qq-b">
		<?php } ?>
		<div class="qqonline-main">
			<?php if ( zm_get_option('weixing_qr') == '' ) { ?>
			<?php } else { ?>
				<div class="nline-wiexin">
					<h4>微信</h4>
					<img title="微信" alt="微信" src="<?php echo zm_get_option('weixing_qr'); ?>"/>
				</div>
			<?php } ?>
			<div class="nline-qq"><a target="_blank" rel="external nofollow" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo zm_get_option('qq_id'); ?>&site=qq&menu=yes"><i class="be be-qq"></i><?php echo zm_get_option('qq_name'); ?></a></div>
		</div>
		<span class="qq-arrow"></span>
	</div>
</li>