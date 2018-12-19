<?php
//外链图片自动本地化
add_filter('content_save_pre', 'auto_save_image');

function auto_save_image($content) {
	$upload_path = '';
	$upload_url_path = get_bloginfo('url');

	//上传目录
	if (($var = get_option('upload_path')) !='') {
		$upload_path = $var;
	} else {
		$upload_path = 'wp-content/uploads';
	}
	if(get_option('uploads_use_yearmonth_folders')) {
		$upload_path .= '/'.date("Y",time()).'/'.date("m",time());
	}

	//文件地址
	if(($var = get_option('upload_url_path')) != '') {
		$upload_url_path = $var;
	} else {
		$upload_url_path = home_url( '/' ).'wp-content/uploads';
	}
	if(get_option('uploads_use_yearmonth_folders')) {
		$upload_url_path .= '/'.date("Y",time()).'/'.date("m",time());
	}
	require_once (ABSPATH . "wp-includes/class-snoopy.php");
	$snoopy_Auto_Save_Image = new Snoopy;
	$img = array();

	//以文章的标题作为图片的标题
	if ( !empty( $_REQUEST['post_title'] ) )
	$post_title = wp_specialchars( stripslashes( $_REQUEST['post_title'] ));
	$text = stripslashes($content);
	if (get_magic_quotes_gpc()) $text = stripslashes($text);
	preg_match_all("/ src=(\"|\'){0,}(http:\/\/(.+?))(\"|\'|\s)/is",$text,$img);
	$img = array_unique(dhtmlspecialchars($img[2]));
	foreach ($img as $key => $value){
		set_time_limit(180); //每个图片最长允许下载时间,秒
		if(str_replace(get_bloginfo('url'),"",$value)==$value&&str_replace(get_bloginfo('home'),"",$value)==$value) {
			//判断是否是本地图片，如果不是，则保存到服务器
			$fileext = substr(strrchr($value,'.'),1);
			$fileext = strtolower($fileext);
			if($fileext==""||strlen($fileext)>4)
			$fileext = "jpg";
			$savefiletype = array('jpg','gif','png','bmp');
			if (in_array($fileext, $savefiletype)) {
				if($snoopy_Auto_Save_Image->fetch($value)) {
					$get_file = $snoopy_Auto_Save_Image->results;
				}else{
					echo "error fetching file: ".$snoopy_Auto_Save_Image->error."<br>";
					echo "error url: ".$value;
					die();
				}
				$filetime = time();
				$filepath = "/".$upload_path;//图片保存的路径目录
				!is_dir("..".$filepath) ? mkdirs("..".$filepath) : null;
				//$filename = date("His",$filetime).random(3);
				$filename = substr($value,strrpos($value,'/'),strrpos($value,'.')-strrpos($value,'/'));
				//$e = '../'.$filepath.$filename.'.'.$fileext;
				//if(!is_file($e)) {
				// copy(htmlspecialchars_decode($value),$e);
				//}
				$fp = @fopen("..".$filepath.$filename.".".$fileext,"w");
				@fwrite($fp,$get_file);
				fclose($fp);
				$wp_filetype = wp_check_filetype( $filename.".".$fileext, false );
				$type = $wp_filetype['type'];
				$post_id = (int)$_POST['temp_ID2'];
				$title = $post_title;
				$url = $upload_url_path.$filename.".".$fileext;
				$file = $_SERVER['DOCUMENT_ROOT'].$filepath.$filename.".".$fileext;

				//添加数据库记录
				$attachment = array(
				'post_type' => 'attachment',
				'post_mime_type' => $type,
				'guid' => $url,
				'post_parent' => $post_id,
				'post_title' => $title,
				'post_content' => '',
				);
				$id = wp_insert_attachment($attachment, $file, $post_parent);
				$text = str_replace($value,$url,$text); //替换文章里面的图片地址
			}
		}
	}
	$content = AddSlashes($text);
	remove_filter('content_save_pre', 'auto_save_image');
	return $content;
}

function mkdirs($dir){
	if(!is_dir($dir)){
		mkdirs(dirname($dir));
		mkdir($dir);
	}
	return ;
}

function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	}else{
		$string = str_replace('&', '&', $string);
		$string = str_replace('"', '"', $string);
		$string = str_replace('<', '<', $string);
		$string = str_replace('>', '>', $string);
		$string = preg_replace('/&(#\d;)/', '&\1', $string);
	}
	return $string;
}