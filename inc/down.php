<?php
global $wpdb;
function begin_show_down($content) {
	if(is_single()) {
		$down_start=get_post_meta(get_the_ID(), 'down_start', true);
		$password_start=get_post_meta(get_the_ID(), 'password_start', true);
		$down_name=get_post_meta(get_the_ID(), 'down_name', true);
		$file_inf=get_post_meta(get_the_ID(), 'file_inf', true);
		$file_os=get_post_meta(get_the_ID(), 'file_os', true);
		$down_size=get_post_meta(get_the_ID(), 'down_size', true);
		$down_demo=get_post_meta(get_the_ID(), 'down_demo', true);
		$r_baidu_password=get_post_meta(get_the_ID(), 'r_baidu_password', true);
		$r_rar_password=get_post_meta(get_the_ID(), 'r_rar_password', true);

		if($down_demo) {
			$demo_content .= '<a class="yanshibtn" rel="external nofollow"   href="'.get_template_directory_uri().'/preview.php?id='.get_the_ID().'" target="_blank" title="'.$down_demo.' "><i class="be be-eye" ></i>查看演示</a>';
		}

		if($password_start) {
			$rr_password .=  '[pass]<span>'.$r_rar_password.'</span><span>'.$r_baidu_password.'</span>[/pass]';
		}

		if($down_start) {
			$content .= '
			<div class="down-form">
				<fieldset>
					<legend>文件下载</legend>
					<span class="down-form-inf">
						<span>'.$down_name.'</span>
						<span>'.$file_os.'</span>
						<span>'.$file_inf.'</span>
						<span>'.$down_size.'</span>
						<span class="pass"> '.$rr_password.'</span>
						<div class="clear"></div>
					</span>
					<span class="down">
						<a title="'.$begin_name.'" href="'.site_url().'/download.php?id='.get_the_ID().'" rel="external nofollow" target="_blank"><i class="be be-download"></i>下载地址</a>
					</span>
					<span class="down">
					 '.$demo_content.'
					</span>
					<div class="clear"></div>
				</fieldset>
			</div>
			<div class="clear"></div>';
		}
	}
	return $content;
}
add_action('the_content','begin_show_down');