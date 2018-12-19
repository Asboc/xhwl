<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

add_action( 'register_form', 'baweic_register_form_add_field' );
function baweic_register_form_add_field() { 
	global $allowedposttags;
	$baweic_fields = get_option( 'baweic_fields' );
?>
	<p>
		<label for="invitation_code"><?php _e( '邀请码', 'begin' ); ?> *<br />
		<input name="invitation_code" tabindex="3" type="text" class="input" id="invitation_code" style="text-transform: uppercase" />
		</label>
		<?php if ( ! empty( $baweic_fields['link'] ) && $baweic_fields['link'] == 'on' ) { ?>
		<span class="to-code"><a href="<?php echo ! empty( $baweic_fields['text_link'] ) ? wp_kses_post( $baweic_fields['text_link'], $allowedposttags ) : ''; ?>" target="_blank"><?php _e( '获取邀请码', 'begin' ); ?></a></span>
		<?php } ?>
	</p>
 <?php
}

add_filter( 'registration_errors', 'baweic_registration_errors', 20, 3 ); 
function baweic_registration_errors( $errors, $sanitized_user_login, $user_email ) {
	if( count( $errors->errors ) ) {
		return $errors;
	}
	$baweic_options = get_option( 'baweic_options' );

	$invitation_code = isset( $_POST['invitation_code'] ) ? strtoupper( $_POST['invitation_code'] ) : '';
	if ( ! array_key_exists( $invitation_code, $baweic_options['codes'] ) ) {
		add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __( '<strong>错误</strong>: 请输入正确的邀请码！', 'baweic' ) );
	} elseif ( isset( $baweic_options['codes'][ $invitation_code ] ) && ! $baweic_options['codes'][ $invitation_code ]['leftcount'] ){
		add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __( '<strong>错误</strong>: 此邀请码已被使用！', 'baweic' ) );
	} else {
		$baweic_options['codes'][ $invitation_code ]['leftcount']--;
		$baweic_options['codes'][ $invitation_code ]['users'][] = $sanitized_user_login;
		update_option( 'baweic_options', $baweic_options );
	}
	return $errors;
}

add_action( 'login_footer', 'baweic_login_footer' );
function baweic_login_footer() {
	$baweic_options = get_option( 'baweic_options' );

	$invitation_code = isset( $_POST['invitation_code'] ) ? strtoupper( $_POST['invitation_code'] ) : '';
	if ( $invitation_code && ! array_key_exists( $invitation_code, $baweic_options['codes'] ) ):
		?>
		<script type="text/javascript">
			try{document.getElementById('invitation_code').focus();}catch(e){}
		</script>
		<?php 
	endif;
}