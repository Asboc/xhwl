<?php
require_once( dirname( dirname( dirname( dirname( ( dirname( __FILE__ ) ) ) ) ) ). '/wp-load.php' );
$core_actions_post[] = 'wp-fullscreen-save-post';
do_action( 'wp_ajax_' . $_REQUEST['action'] );