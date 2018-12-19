<?php
function wpzm_widget_init() {
    function wpzm_widget_view($args) {
        extract($args);
        $options = wpzm_get_options();
        if (isset($options['widget_limit'])) {
            $limit = $options['widget_limit'];
        }
        $title = empty($options['widget_title']) ? '收藏最多的文章' : $options['widget_title'];
        echo $before_widget;
        echo $before_title . $title . $after_title;
        wpzm_list_most_favorited($limit);
        echo $after_widget;
    }

    function wpzm_widget_control() {
        $options = wpzm_get_options();
        if (isset($_POST["wpzm-widget-submit"])):
            $options['widget_title'] = strip_tags(stripslashes($_POST['wpzm-title']));
            $options['widget_limit'] = strip_tags(stripslashes($_POST['wpzm-limit']));
            update_option("wpzm_options", $options);
        endif;
        $title = $options['widget_title'];
        $limit = $options['widget_limit'];
    ?>
        <p>
            <label for="wpzm-title">
                <?php _e('Title:'); ?> <input type="text" value="<?php echo $title; ?>" class="widefat" id="wpzm-title" name="wpzm-title" />
            </label>
        </p>
        <p>
            <label for="wpzm-limit">
                <?php _e('Number of posts to show:'); ?> <input type="text" value="<?php echo $limit; ?>" style="width: 28px; text-align:center;" id="wpzm-limit" name="wpzm-limit" />
            </label>
        </p>

        <input type="hidden" name="wpzm-widget-submit" value="1" />
    <?php
    }
    wp_register_sidebar_widget('wpzm-most_favorited_posts', '主题 收藏最多的文章', 'wpzm_widget_view');
    wp_register_widget_control('wpzm-most_favorited_posts', '收藏最多的文章', 'wpzm_widget_control' );

    //*** users favorites widget ***//
    function wpzm_users_favorites_widget_view($args) {
        extract($args);
        $options = wpzm_get_options();
        if (isset($options['uf_widget_limit'])) {
            $limit = $options['uf_widget_limit'];
        }
        $title = empty($options['uf_widget_title']) ? '我收藏的文章' : $options['uf_widget_title'];
        echo $before_widget;
        echo $before_title
             . $title
             . $after_title;
        $favorite_post_ids = wpzm_get_users_favorites();

		$limit = $options['uf_widget_limit'];
        if (@file_exists(TEMPLATEPATH.'/wpzm-your-favs-widget.php')):
            include(TEMPLATEPATH.'/wpzm-your-favs-widget.php');
        else:
            include("wpzm-your-favs-widget.php");
        endif;
        echo $after_widget;
    }

    function wpzm_users_favorites_widget_control() {
        $options = wpzm_get_options();
        if (isset($_POST["wpzm-uf-widget-submit"])):
            $options['uf_widget_title'] = strip_tags(stripslashes($_POST['wpzm-uf-title']));
            $options['uf_widget_limit'] = strip_tags(stripslashes($_POST['wpzm-uf-limit']));
            update_option("wpzm_options", $options);
        endif;
        $uf_title = $options['uf_widget_title'];
        $uf_limit = $options['uf_widget_limit'];
    ?>
        <p>
            <label for="wpzm-uf-title">
                <?php _e('Title:'); ?> <input type="text" value="<?php echo $uf_title; ?>" class="widefat" id="wpzm-uf-title" name="wpzm-uf-title" />
            </label>
        </p>
        <p>
            <label for="wpzm-uf-limit">
                <?php _e('Number of posts to show:'); ?> <input type="text" value="<?php echo $uf_limit; ?>" style="width: 28px; text-align:center;" id="wpzm-uf-limit" name="wpzm-uf-limit" />
            </label>
        </p>

        <input type="hidden" name="wpzm-uf-widget-submit" value="1" />
    <?php
    }
    wp_register_sidebar_widget('wpzm-users_favorites','主题 我收藏的文章', 'wpzm_users_favorites_widget_view');
    wp_register_widget_control('wpzm-users_favorites','我收藏的文章', 'wpzm_users_favorites_widget_control' );
}
add_action('widgets_init', 'wpzm_widget_init');
