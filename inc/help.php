<?php
add_action('admin_menu', 't_guide');
function t_guide() {
	add_submenu_page('themes.php', '主题指南', '主题指南', 'manage_options', 'user_guide', 't_guide_options' );
}
function t_guide_options() {
?>
<div class="wrap">
	<div class="opwrap" style="line-height: 90%;margin: 0 auto;width:100%;padding:0;" >
		<div id="wrapr">
			<div class="gblock">
				<p><iframe src="http://zmingcx.com/begin-guide.html" width="100%" height="800" frameborder="0"></iframe></p>
			</div>
		</div>
	</div>
</div>
<?php }; ?>