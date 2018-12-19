<div class="searchbar">
	<form method="get" id="baiduform" action="<?php echo get_permalink( zm_get_option('baidu_url') ); ?>" target="_blank">
		<span class="search-input">
			<input type="hidden" value="1" name="entry">
			<input class="swap_value" placeholder="<?php _e( '输入百度站内搜索关键词', 'begin' ); ?>" name="q">
			<button type="submit" id="searchbaidu"><i class="be be-baidu"></i></button>
		</span>
	</form>
</div>