<?php

/*
Author URI: http://ssk.91txh.com/
*/

?>
<?php
function qqinfo_script() {
	if ( is_singular() ) {
		wp_register_script( 'qqinfo', get_template_directory_uri() . '/js/getqqinfo.js', array(), version, true );
	}
	if ( !is_admin() ) {
		wp_enqueue_script( 'qqinfo' );
	}
}
add_action( 'wp_enqueue_scripts', 'qqinfo_script' );

function qq_usermeta_table_install() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . "qq_usermeta";  //获取表前缀，并设置新表的名称
	if($wpdb->get_var("show tables like '{$table_name}'") != $table_name) {  //判断表是否已存在
		$sql = "CREATE TABLE {$table_name} (
		  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		  `uid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
		  `qq` bigint(20) UNSIGNED NOT NULL,
		  `qqcheck` tinyint(1) NOT NULL DEFAULT '0',
		  `email` varchar(100) NOT NULL,
		  `emailcheck` tinyint(1) NOT NULL DEFAULT '0',
		  `url` varchar(200) NOT NULL,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY (`id`)
		  ) {$charset_collate};";
		require_once(ABSPATH . "wp-admin/includes/upgrade.php");  //引用wordpress的内置方法库
		dbDelta($sql);
	}else{
	//echo "<script>alert('已安装');</script>";
	}
}
if (zm_get_option('qq_avatar')) {qq_usermeta_table_install();}

function object_array($array) {
//查询结果stdClass Object转array
	if(is_object($array)) {
			$array = (array)$array;
		} if(is_array($array)) {
			foreach($array as $key=>$value) {
				$array[$key] = object_array($value);
			}
		}
	return $array;
}

function generate_code($length = 3) {
	return rand(pow(10,($length-1)), pow(10,$length)-1);
}

function get_zm_ssl_avatar($avatar) {
	//修改头像
	global $wpdb;
	$table_name=$wpdb->prefix."qq_usermeta";
	$comment = get_comment($comment_id);
	$comment_author_email = trim($comment->comment_author_email);
	//echo "<script>alert('".$comment_author_email."');</script>";
	$checkqq="SELECT `qq` FROM `{$table_name}` WHERE `email` = '{$comment_author_email}'";
	$checkresult = object_array($wpdb->get_results($checkqq));
	//print_r($checkresult);
	$qq=$checkresult['0']['qq'];
	if($qq==""){
		$avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
	}else{
		//如果wp_qq_usermeta由当前评论的email 则返回qq 调用qq头像
		$avatar = '<img src="http://q.qlogo.cn/g?b=qq&nk='.$qq.'&s=100&t='.time().generate_code().'" class="avatar avatar-42 photo" height="42" width="42">';
	}
return $avatar;
}

if (zm_get_option('qq_avatar')) {add_filter('get_avatar', 'get_zm_ssl_avatar');}

function wp_insert_qq() {
	global $wpdb;
	$table_name=$wpdb->prefix."qq_usermeta";
	if(isset($_POST['qq']) && $_POST['qq']!=""){
		$qq=$_POST['qq'];
		$email=$_POST['email'];
		$url=$_POST['url'];
		$checkqq="SELECT * FROM `{$table_name}` WHERE `qq` = {$qq}";
		$checkresult = object_array($wpdb->get_results($checkqq));
		$count=count($checkresult);
		if($count=="0"){
			//无记录 
			$wpdb->insert( $table_name, array( 'qq' => $qq, 'email' => $email, 'url' => $url ) );
		}else{
			//有记录 修改输入框自动返回内容提交评论时直接修改后台记录
			if($email!=$checkresult[0][email]){
				$checkemailresult = object_array($wpdb->get_results("SELECT * FROM `{$table_name}` WHERE `email` = '{$email}'"));
				$countemail=count($checkemailresult);
				 //setcookie("update-email-test", $countemail);
				if($countemail==0){
					//setcookie("update-email-test", $email);
					$wpdb->update( $table_name, array( 'email' => $email, 'emailcheck' => '0' ), array( 'qq' => $qq ) );
				}else{
					//setcookie("update-email-test", "USED!!");
				}
			}else{}
			if($url!=$checkresult[0][url]){
				$checkurlresult = object_array($wpdb->get_results("SELECT * FROM `{$table_name}` WHERE `url` = {$url}"));
				$counturl=count($checkurlresult);
				if($counturl==0){
				    $wpdb->update( $table_name, array( 'url' => $url ), array( 'qq' => $qq ) );
				}else{
				    echo "<script>alert('您修改的站点已被占用！');</script>";
				}
			}else{}
		}
	}
}
if (zm_get_option('qq_avatar')) {add_action('wp_insert_comment','wp_insert_qq',10,2);}
?>