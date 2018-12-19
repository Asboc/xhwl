<?php
// 文章SEO
$seo_post_meta_boxes =
array(
	"custom_title" => array(
		"name" => "custom_title",
		"std" => "",
		"title" => "SEO自定义文章标题",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "SEO文章描述，留空则自动截取首段一定字数作为文章描述",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "SEO文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),
);

// 面板内容
function seo_post_meta_boxes() {
	global $post, $seo_post_meta_boxes;
	//获取保存
	foreach ($seo_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function seo_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('seo_post_meta_box', 'SEO设置', 'seo_post_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function save_seo_post_postdata($post_id) {
	global $post, $seo_post_meta_boxes;
	foreach ($seo_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'seo_post_meta_box');
add_action('save_post', 'save_seo_post_postdata');

// 文章添加到
$added_post_meta_boxes =
array(
	"cms_top" => array(
		"name" => "cms_top",
		"std" => "",
		"title" => "首页推荐文章",
		"type"=>"checkbox"),

	"cat_top" => array(
		"name" => "cat_top",
		"std" => "",
		"title" => "分类推荐文章",
		"type"=>"checkbox"),

	"post_img" => array(
		"name" => "post_img",
		"std" => "",
		"title" => "杂志布局图文模块",
		"type"=>"checkbox"),

	"hot" => array(
		"name" => "hot",
		"std" => "",
		"title" => "本站推荐小工具中（有缩略图）",
		"type"=>"checkbox"),

	"posts" => array(
		"name" => "posts",
		"std" => "",
		"title" => "推荐文章小工具中（无缩略图）",
		"type"=>"checkbox"),
);

// 面板内容
function added_post_meta_boxes() {
	global $post, $added_post_meta_boxes;
	//获取保存
	foreach ($added_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function added_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('added_post_meta_box', '将文章添加到', 'added_post_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function save_added_post_postdata($post_id) {
	global $post, $added_post_meta_boxes;
	foreach ($added_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'added_post_meta_box');
add_action('save_post', 'save_added_post_postdata');

// 文章手动缩略图
$thumbnail_post_meta_boxes =
array(
	"thumbnail" => array(
		"name" => "thumbnail",
		"std" => "",
		"title" => "输入图片地址，调用指定缩略图，图片尺寸要求与主题选项中对应缩略图大小相同",
		"type"=>"text"),
);

// 面板内容
function thumbnail_post_meta_boxes() {
	global $post, $thumbnail_post_meta_boxes;
	//获取保存
	foreach ($thumbnail_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function thumbnail_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('thumbnail_post_meta_box', '手动缩略图', 'thumbnail_post_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function save_thumbnail_post_postdata($post_id) {
	global $post, $thumbnail_post_meta_boxes;
	foreach ($thumbnail_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'thumbnail_post_meta_box');
add_action('save_post', 'save_thumbnail_post_postdata');

// 添加到幻灯
$show_post_meta_boxes =
array(
	"show" => array(
		"name" => "show",
		"std" => "",
		"title" => "输入图片链接地址，则显示在首页幻灯中，图片宽度大于760px，尺寸必须相同",
		"type"=>"text"),

	"go_url" => array(
		"name" => "show_url",
		"std" => "",
		"title" => "输入链接地址，可让幻灯跳转到任意链接页面",
		"type"=>"text"),

	"show_order" => array(
		"name" => "show_order",
		"std" => "",
		"title" => "输入数值，实现幻灯排序，数值越大越靠前",
		"type"=>"text"),

);

// 面板内容
function show_post_meta_boxes() {
	global $post, $show_post_meta_boxes;
	//获取保存
	foreach ($show_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function show_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('show_post_meta_box', '将文章添加到幻灯', 'show_post_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function save_show_post_postdata($post_id) {
	global $post, $show_post_meta_boxes;
	foreach ($show_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'show_post_meta_box');
add_action('save_post', 'save_show_post_postdata');

// 文章标题幻灯
$header_show_meta_boxes =
array(
	"header_img" => array(
		"name" => "header_img",
		"std" => "",
		"title" => "输入图片地址，一行一个不能有回行和空格，图片尺寸必须相同",
		"type"=>"textarea"),
);

// 面板内容
function header_show_meta_boxes() {
	global $post, $header_show_meta_boxes;
	//获取保存
	foreach ($header_show_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function header_show_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('header_show_meta_box', '文章标题幻灯', 'header_show_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function save_header_show_postdata($post_id) {
	global $post, $header_show_meta_boxes;
	foreach ($header_show_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'header_show_meta_box');
add_action('save_post', 'save_header_show_postdata');

// 文章其它设置
$other_post_meta_boxes =
array(
	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "隐藏侧边栏",
		"type"=>"checkbox"),

	"direct" => array(
		"name" => "direct",
		"std" => "",
		"title" => "直达链接地址",
		"type"=>"text"),

	"direct_btn" => array(
		"name" => "direct_btn",
		"std" => "",
		"title" => "直达链接按钮名称，仅用于“链接”文章形式",
		"type"=>"text"),

	"link_inf" => array(
		"name" => "link_inf",
		"std" => "",
		"title" => "自定义文章信息，仅用于“链接”文章形式",
		"type"=>"text"),

	"from" => array(
		"name" => "from",
		"std" => "",
		"title" => "文章来源",
		"type"=>"text"),

	"copyright" => array(
		"name" => "copyright",
		"std" => "",
		"title" => "原文链接",
		"type"=>"text"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "下载按钮名称（ 弹窗中的按钮名称 ）",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "下载链接（ 弹窗中的下载链接 ）",
		"type"=>"text"),
);

// 面板内容
function other_post_meta_boxes() {
	global $post, $other_post_meta_boxes;
	//获取保存
	foreach ($other_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function other_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('other_post-meta-boxes', '其它设置', 'other_post_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function save_other_post_postdata($post_id) {
	global $post, $other_post_meta_boxes;
	foreach ($other_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'other_post_meta_box');
add_action('save_post', 'save_other_post_postdata');


// 仅用于公司服务模块
$pr_post_meta_boxes =
array(
	"pr_b" => array(
		"name" => "pr_b",
		"std" => "",
		"title" => "第二行文字",
		"type"=>"text"),

	"pr_a" => array(
		"name" => "pr_a",
		"std" => "",
		"title" => "第三行图片上的文字 ( 必填 )",
		"type"=>"text"),

	"pr_c" => array(
		"name" => "pr_c",
		"std" => "",
		"title" => "第四行文字",
		"type"=>"text"),

	"pr_d" => array(
		"name" => "pr_d",
		"std" => "",
		"title" => "输入按钮链接地址",
		"type"=>"text"),

	"pr_e" => array(
		"name" => "pr_e",
		"std" => "",
		"title" => "按钮名称，可以在文字前面输入图标字体，需要将双引号改成单引号",
		"type"=>"text"),

	"pr_f" => array(
		"name" => "pr_f",
		"std" => "",
		"title" => "输入图片地址",
		"type"=>"text"),
);

// 面板内容
function pr_post_meta_boxes() {
	global $post, $pr_post_meta_boxes;
	//获取保存
	foreach ($pr_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function pr_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('pr_post_meta_box', '仅用于公司主页服务模块', 'pr_post_meta_boxes', 'post', 'normal', 'high');
	}
}
// 保存数据
function pr_seo_post_postdata($post_id) {
	global $post, $pr_post_meta_boxes;
	foreach ($pr_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}

// 触发
if (zm_get_option('dean')) {
add_action('admin_menu', 'pr_post_meta_box');
add_action('save_post', 'pr_seo_post_postdata');
}

// 页面相关自定义栏目
$new_meta_page_boxes =
array(
	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "隐藏侧边栏",
		"type"=>"checkbox"),

	"custom_title" => array(
		"name" => "custom_title",
		"std" => "",
		"title" => "SEO自定义页面标题",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述，留空则自动截取首段一定字数作为文章描述",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "下载按钮名称（ 弹窗中的按钮名称 ）",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "下载链接（ 弹窗中的下载链接 ）",
		"type"=>"text")
);

// 面板内容
function new_meta_page_boxes() {
	global $post, $new_meta_page_boxes;
	//获取保存
	foreach ($new_meta_page_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}

function create_meta_page_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('new-meta-boxes', '页面设置', 'new_meta_page_boxes', 'page', 'normal', 'high');
	}
}
function save_page_postdata($post_id) {
	global $post, $new_meta_page_boxes;
	foreach ($new_meta_page_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
add_action('admin_menu', 'create_meta_page_box');
add_action('save_post', 'save_page_postdata');

// 页面添加到幻灯
$page_slider_post_meta_boxes =
array(
	"guide_img" => array(
		"name" => "guide_img",
		"std" => "",
		"title" => "输入图片链接地址，则显示在幻灯中",
		"type"=>"text"),

	"small_img" => array(
		"name" => "small_img",
		"std" => "",
		"title" => "输入浮动层小图片",
		"type"=>"text"),

	"group_slider_url" => array(
		"name" => "group_slider_url",
		"std" => "",
		"title" => "输入链接地址，可让幻灯跳转到任意链接页面",
		"type"=>"text"),

	"s_t_a" => array(
		"name" => "s_t_a",
		"std" => "",
		"title" => "幻灯上第一行文字",
		"type"=>"text"),

	"s_t_b" => array(
		"name" => "s_t_b",
		"std" => "",
		"title" => "幻灯上第二行文字（大字）",
		"type"=>"text"),

	"s_t_c" => array(
		"name" => "s_t_c",
		"std" => "",
		"title" => "幻灯上第三行文字",
		"type"=>"text"),

	"s_n_b" => array(
		"name" => "s_n_b",
		"std" => "",
		"title" => "按钮名称",
		"type"=>"text"),

	"s_n_b_l" => array(
		"name" => "s_n_b_l",
		"std" => "",
		"title" => "按钮链接",
		"type"=>"text"),

);

// 面板内容
function page_slider_post_meta_boxes() {
	global $post, $page_slider_post_meta_boxes;
	//获取保存
	foreach ($page_slider_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function page_slider_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('page_slider_post_meta_box', '用于公司主页幻灯', 'page_slider_post_meta_boxes', 'page', 'normal', 'high');
	}
}
// 保存数据
function save_page_slider_post_postdata($post_id) {
	global $post, $page_slider_post_meta_boxes;
	foreach ($page_slider_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
if (zm_get_option('group_slider')) {
add_action('admin_menu', 'page_slider_post_meta_box');
add_action('save_post', 'save_page_slider_post_postdata');
}

// 页面标题幻灯
$header_show_page_meta_boxes =
array(
	"header_img" => array(
		"name" => "header_img",
		"std" => "",
		"title" => "输入图片地址，一行一个不能有多余的回行和空格，图片尺寸必须相同",
		"type"=>"textarea"),
);

// 面板内容
function header_show_page_meta_boxes() {
	global $post, $header_show_page_meta_boxes;
	//获取保存
	foreach ($header_show_page_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function header_show_page_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('header_show_page_meta_box', '页面标题幻灯', 'header_show_page_meta_boxes', 'page', 'normal', 'high');
	}
}
// 保存数据
function save_header_show_page_postdata($post_id) {
	global $post, $header_show_page_meta_boxes;
	foreach ($header_show_page_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'header_show_page_meta_box');
add_action('save_post', 'save_header_show_page_postdata');

// 仅用于公司主页服务模块
$pr_meta_page_boxes =
array(
	"pr_b" => array(
		"name" => "pr_b",
		"std" => "",
		"title" => "第二行文字",
		"type"=>"text"),

	"pr_a" => array(
		"name" => "pr_a",
		"std" => "",
		"title" => "第三行图片上的文字 ( 必填 )",
		"type"=>"text"),

	"pr_c" => array(
		"name" => "pr_c",
		"std" => "",
		"title" => "第四行文字",
		"type"=>"text"),

	"pr_d" => array(
		"name" => "pr_d",
		"std" => "",
		"title" => "输入按钮链接地址",
		"type"=>"text"),

	"pr_e" => array(
		"name" => "pr_e",
		"std" => "",
		"title" => "按钮名称，可以在文字前面输入图标字体，需要将双引号改成单引号",
		"type"=>"text"),

	"pr_f" => array(
		"name" => "pr_f",
		"std" => "",
		"title" => "输入图片地址",
		"type"=>"text"),
);

// 面板内容
function pr_meta_page_boxes() {
	global $post, $pr_meta_page_boxes;
	//获取保存
	foreach ($pr_meta_page_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}

function pr_meta_page_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('pr_new-meta-boxes', '仅用于公司主页服务模块', 'pr_meta_page_boxes', 'page', 'normal', 'high');
	}
}
function pr_save_page_postdata($post_id) {
	global $post, $pr_meta_page_boxes;
	foreach ($pr_meta_page_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
if (zm_get_option('dean')) {
add_action('admin_menu', 'pr_meta_page_box');
add_action('save_post', 'pr_save_page_postdata');
}

// 图片日志
$new_meta_picture_boxes =
array(
	"thumbnail" => array(
		"name" => "thumbnail",
		"std" => "",
		"title" => "添加图片地址，调用指定缩略图，图片尺寸要求与主题选项中对应该的缩略图大小相同",
		"type"=>"text"),

	"custom_title" => array(
		"name" => "custom_title",
		"std" => "",
		"title" => "SEO自定义文章标题",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述，留空则自动截取首段一定字数作为文章描述",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "隐藏侧边栏",
		"type"=>"checkbox"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "下载按钮名称（ 弹窗中的按钮名称 ）",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "下载链接（ 弹窗中的下载链接 ）",
		"type"=>"text"),
);

// 面板内容
function new_meta_picture_boxes() {
	global $post, $new_meta_picture_boxes;
	//获取保存
	foreach ($new_meta_picture_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
function create_meta_picture_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('new-meta-boxes', '图片设置', 'new_meta_picture_boxes', 'picture', 'normal', 'high');
	}
}
function save_picture_postdata($post_id) {
	global $post, $new_meta_picture_boxes;
	foreach ($new_meta_picture_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
add_action('admin_menu', 'create_meta_picture_box');
add_action('save_post', 'save_picture_postdata');

// 视频日志
$new_meta_video_boxes =
array(
	"small" => array(
		"name" => "small",
		"std" => "",
		"title" => "添加图片地址，调用指定缩略图，图片尺寸要求与主题选项中缩略图大小相同",
		"type"=>"text"),

	"big" => array(
		"name" => "big",
		"std" => "",
		"title" => "输入视频代码",
		"type"=>"text"),

	"custom_title" => array(
		"name" => "custom_title",
		"std" => "",
		"title" => "SEO自定义文章标题",
		"type"=>"text"),


	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述，留空则自动截取首段一定字数作为文章描述）",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "隐藏侧边栏",
		"type"=>"checkbox"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "下载按钮名称（ 弹窗中的按钮名称 ）",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "下载链接（ 弹窗中的下载链接 ）",
		"type"=>"text"),
);

// 面板内容
function new_meta_video_boxes() {
	global $post, $new_meta_video_boxes;
	//获取保存
	foreach ($new_meta_video_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
function create_meta_video_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('new-meta-boxes', '视频设置', 'new_meta_video_boxes', 'video', 'normal', 'high');
	}
}
function save_video_postdata($post_id) {
	global $post, $new_meta_video_boxes;
	foreach ($new_meta_video_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
add_action('admin_menu', 'create_meta_video_box');
add_action('save_post', 'save_video_postdata');

// 淘客
$new_meta_tao_boxes =
array(
	"thumbnail" => array(
		"name" => "thumbnail",
		"std" => "",
		"title" => "添加图片地址，调用指定缩略图，图片尺寸要求与主题选项中对应的缩略图大小相同",
		"type"=>"text"),

	"product" => array(
		"name" => "product",
		"std" => "",
		"title" => "商品描述",
		"type"=>"text"),

	"pricex" => array(
		"name" => "pricex",
		"std" => "",
		"title" => "商品现价",
		"type"=>"text"),

	"pricey" => array(
		"name" => "pricey",
		"std" => "",
		"title" => "商品原价（可选）",
		"type"=>"text"),

	"taourl" => array(
		"name" => "taourl",
		"std" => "",
		"title" => "商品购买链接",
		"type"=>"text"),

	"discount" => array(
		"name" => "discount",
		"std" => "",
		"title" => "添加优惠卷",
		"type"=>"text"),

	"discounturl" => array(
		"name" => "discounturl",
		"std" => "",
		"title" => "优惠卷链接",
		"type"=>"text"),

	"custom_title" => array(
		"name" => "custom_title",
		"std" => "",
		"title" => "SEO自定义文章标题",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述，留空则自动截取首段一定字数作为文章描述",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "隐藏侧边栏",
		"type"=>"checkbox"),

);

// 面板内容
function new_meta_tao_boxes() {
	global $post, $new_meta_tao_boxes;
	//获取保存
	foreach ($new_meta_tao_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
function create_meta_tao_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('new-meta-boxes', '商品设置', 'new_meta_tao_boxes', 'tao', 'normal', 'high');
	}
}
function save_tao_postdata($post_id) {
	global $post, $new_meta_tao_boxes;
	foreach ($new_meta_tao_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
add_action('admin_menu', 'create_meta_tao_box');
add_action('save_post', 'save_tao_postdata');

// EDD下载SEO
$seo_edd_post_meta_boxes =
array(
	"custom_title" => array(
		"name" => "custom_title",
		"std" => "",
		"title" => "SEO自定义文章标题",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "SEO文章描述，留空则自动截取首段一定字数作为文章描述",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "SEO文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),
);

// 面板内容
function seo_edd_post_meta_boxes() {
	global $post, $seo_edd_post_meta_boxes;
	//获取保存
	foreach ($seo_edd_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
// 创建面板
function seo_edd_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('seo_edd_post_meta_box', 'SEO设置', 'seo_edd_post_meta_boxes', 'download', 'normal', 'high');
	}
}
// 保存数据
function save_seo_edd_post_postdata($post_id) {
	global $post, $seo_edd_post_meta_boxes;
	foreach ($seo_edd_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
// 触发
add_action('admin_menu', 'seo_edd_post_meta_box');
add_action('save_post', 'save_seo_edd_post_postdata');

// 网址
$new_meta_sites_boxes =
array(
	"sites_link" => array(
		"name" => "sites_link",
		"std" => "",
		"title" => "输入网址链接（无缩略图）",
		"type"=>"text"),

	"sites_img_link" => array(
		"name" => "sites_img_link",
		"std" => "",
		"title" => "输入网址链接（有缩略图）",
		"type"=>"text"),

	"order" => array(
		"name" => "sites_order",
		"std" => "0",
		"title" => "网址排序数值越大越靠前",
		"type"=>"text"),

	"thumbnail" => array(
		"name" => "thumbnail",
		"std" => "",
		"title" => "添加图片地址，调用指定缩略图，图片尺寸必须相同",
		"type"=>"text"),
);

// 面板内容
function new_meta_sites_boxes() {
	global $post, $new_meta_sites_boxes;
	//获取保存
	foreach ($new_meta_sites_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		//将默认值替换为已保存的值
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		//选择类型输出不同的html代码
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}
function create_meta_sites_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('new-meta-boxes', '添加链接', 'new_meta_sites_boxes', 'sites', 'normal', 'high');
	}
}
function save_sites_postdata($post_id) {
	global $post, $new_meta_sites_boxes;
	foreach ($new_meta_sites_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}
add_action('admin_menu', 'create_meta_sites_box');
add_action('save_post', 'save_sites_postdata');

// 下载链接（文章）
$down_post_meta_boxes =
array(
	"down_start" => array(
		"name" => "down_start",
		"std" => "",
		"title" => "启用下载",
		"type" => "checkbox"
	),

	"down_name" => array(
		"name" => "down_name",
		"std" => "",
		"title" => "资源名称",
		"type"=>"text"
	),

	"file_os" => array(
		"name" => "file_os",
		"std" => "",
		"title" => "应用平台",
		"type"=>"text"
	),

	"file_inf" => array(
		"name" => "file_inf",
		"std" => "",
		"title" => "资源版本",
		"type"=>"text"
	),

	"down_size" => array(
		"name" => "down_size",
		"std" => "",
		"title" => "资源大小",
		"type"=>"text"
	),

	"down_demo" => array(
		"name" => "down_demo",
		"std" => "",
		"title" => "演示链接",
		"type"=>"text"
	),

	"baidu_pan" => array(
		"name" => "baidu_pan",
		"std" => "",
		"title" => "网盘下载链接",
		"type"=>"text"
	),

	"baidu_password" => array(
		"name" => "baidu_password",
		"std" => "",
		"title" => "网盘密码",
		"type"=>"text"
	),

	"down_local" => array(
		"name" => "down_local",
		"std" => "",
		"title" => "本站下载链接",
		"type"=>"text"
	),

	"rar_password" => array(
		"name" => "rar_password",
		"std" => "",
		"title" => "解压密码",
		"type"=>"text"
	),

	"down_official" => array(
		"name" => "down_official",
		"std" => "",
		"title" => "官网下载链接",
		"type"=>"text"
	),

	"down_img" => array(
		"name" => "down_img",
		"std" => "",
		"title" => "输入演示图地址",
		"type"=>"text"
	),

	"password_start" => array(
		"name" => "password_start",
		"std" => "",
		"title" => "启用密码回复可见",
		"type" => "checkbox"
	),

	"r_baidu_password" => array(
		"name" => "r_baidu_password",
		"std" => "",
		"title" => "网盘密码 (回复可见)",
		"type"=>"text"
	),

	"r_rar_password" => array(
		"name" => "r_rar_password",
		"std" => "",
		"title" => "解压密码 (回复可见)",
		"type"=>"text"
	),

);

function down_post_meta_boxes() {
	global $post, $down_post_meta_boxes;
	foreach ($down_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")
		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'textarea':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<textarea id="seo-excerpt" cols="40" rows="2" name="' . $meta_box['name'] . '">' . $meta_box['std'] . '</textarea><br />';
			break;
			case 'radio':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				$counter = 1;
				foreach ($meta_box['buttons'] as $radiobutton) {
					$checked = "";
					if (isset($meta_box['std']) && $meta_box['std'] == $counter) {
						$checked = 'checked = "checked"';
					}
					echo '<input ' . $checked . ' type="radio" class="kcheck" value="' . $counter . '" name="' . $meta_box['name'] . '_value"/>' . $radiobutton;
					$counter++;
				}
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><input type="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '<label>' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}

function down_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('down_post_meta_box', '下载信息', 'down_post_meta_boxes', 'post', 'normal', 'high');
	}
}

function save_down_post_postdata($post_id) {
	global $post, $down_post_meta_boxes;
	foreach ($down_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}

add_action('admin_menu', 'down_post_meta_box');
add_action('save_post', 'save_down_post_postdata');