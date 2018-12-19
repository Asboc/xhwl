<?php
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	if (zm_get_option('comment_floor')) { 
		global $commentcount;
		if(!$commentcount) {
			if ( get_query_var('cpage') > 0 )
			$page = get_query_var('cpage')-1;
			else $page = get_query_var('cpage');
			$cpp=get_option('comments_per_page');
			$commentcount = $cpp * intval($page);
		}
	}
?>

	<li class="comments-anchor"><ul id="anchor-comment-<?php comment_ID() ?>"></ul></li>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? 'wow fadeInUp' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if (zm_get_option('lazy_c')) { ?>
			<?php echo '<img class="avatar" src="' . get_template_directory_uri() . '/img/load-avatar.gif" alt="avatar" data-original="' . preg_replace(array('/^.+(src=)(\"|\')/i', '/(\"|\')\sclass=(\"|\').+$/i'), array('', ''), get_avatar( $comment, '64','', get_comment_author())) . '" />'; ?>
		<?php } else { ?>
			<?php echo get_avatar( $comment, 64, '', get_comment_author() ); ?>
		<?php } ?>
		<!--<?php printf( __( '<cite class="fn">%s</cite> <span class="says">:</span>' ), get_comment_author_link() ); ?>-->
		<strong>
			<?php if (zm_get_option('link_to')) { ?>
			<?php commentauthor(); ?>
			<?php } else { ?>
			<?php comment_author_link(); ?>
			<?php } ?>
		</strong>
		<?php get_author_admin($comment->comment_author_email, $comment->user_id); ?>
		<?php if (zm_get_option('vip')) { ?><?php get_author_class($comment->comment_author_email, $comment->user_id); ?><?php if(user_can($comment->user_id, 1)); ?><?php } ?>
		<span class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"></a><br />
			<span class="comment-aux">
				<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => '' . sprintf(__( '回复', 'begin' )) . '', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
				<?php printf('%1$s %2$s', get_comment_date(),  get_comment_time() ); ?>
				<?php
					if ( current_user_can('level_10') ) {
						$url = home_url();
						echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" >&nbsp;' . sprintf(__( '删除', 'begin' )) . '</a>';
					}
				?>
				<?php edit_comment_link( '' . sprintf(__( '编辑', 'begin' )) . '' , '&nbsp;', '' ); ?>
				<?php if (zm_get_option('comment_floor')) { ?>
					<span class="floor">
						<?php
							if(!$parent_id = $comment->comment_parent){
								switch ($commentcount){
								case 0 :echo '&nbsp;<span class="pinglunqs plshafa">沙发</span>';++$commentcount;break;
case 1 :echo '&nbsp;<span class="pinglunqs plbandeng">板凳</span>';++$commentcount;break;
case 2 :echo '&nbsp;<span class="pinglunqs pldiban">地板</span>';++$commentcount;break;
									default:printf('&nbsp;%1$s' . sprintf(__( '楼', 'begin' )) . '', ++$commentcount);
								}
							}
						?>
						<?php if( $depth > 1){printf('&nbsp;%1$s' . sprintf(__( '层', 'begin' )) . '', $depth-1);} ?>
					</span>
				<?php } ?>
			</span>
		</span>
	</div>
	<?php comment_text(); ?>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<div class="comment-awaiting-moderation"><?php _e( '您的评论正在等待审核！', 'begin' ); ?></div>
	<?php endif; ?>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}