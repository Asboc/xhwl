<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

function baweic_field_link() {
	$baweic_fields = get_option( 'baweic_fields' );
?>
	<label><input type="checkbox" name="baweic_fields[link]" <?php checked( $baweic_fields['link'], 'on' ); ?>/> <em><?php _e( '在注册页面表单，添加文本和链接。', 'baweic' ); ?></em></label>
<?php
}	

function baweic_field_text_link() {
	$baweic_fields = get_option( 'baweic_fields' );
?>
	<label><input type="text" size="60" name="baweic_fields[text_link]" value="<?php echo !empty( $baweic_fields['text_link'] ) ? esc_attr( $baweic_fields['text_link'] ) : ''; ?>"/> <em><?php _e( '你可以使用HTML标签。', 'baweic' ); ?></em></label>
<?php
}

function baweic_field_count() {
?>
	<input type="number" size="3" min="1" name="baweic_field_count" value="1" /> <em><?php _e( '同一邀请码可以几个用户使用？', 'baweic' ); ?></em>
<?php
}

function baweic_field_length() {
?>
	<input type="number" size="10" min="4" max="16" name="baweic_field_length" value="8" /> <em><?php _e( '验证长度（最短4位,最长16位）', 'baweic' ); ?></em>
<?php
}

function baweic_field_howmany() {
?>
	<input type="number" size="3" min="1" max="10" name="baweic_field_howmany" value="5" /> <em><?php _e( '你要生成几个邀请码？', 'baweic' ); ?></em>
<?php
}

function baweic_field_code() {
?>
	<input type="text" name="baweic_field_code" size="40" value="" style="text-transform: uppercase;" /> <em><?php _e( '请用字母或者数字,禁止用其他字符', 'baweic' ); ?></em>
<?php
}

function baweic_field_prefix() {
?>
	<input type="text" name="baweic_field_prefix" size="10" value="" style="text-transform: uppercase;" /> <em><?php _e( '添加生成验证码的前缀', 'baweic' ); ?></em>
<?php
}
