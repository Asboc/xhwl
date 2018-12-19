<?php
if ( post_password_required() ) {
	return;
}
?>

<?php
  $numPingBacks = 0;
  $numComments  = 0;
  foreach ($comments as $comment)
  if (get_comment_type() != "comment") $numPingBacks++; else $numComments++;
?><!-- 引用 -->


<div class="scroll-comments"></div>

<div id="comments" class="comments-area">

	<?php if ( comments_open() ) : ?>

		<div id="respond" class="comment-respond wow fadeInUp" data-wow-delay="0.3s">
			<h3 id="reply-title" class="comment-reply-title"><span><?php _e( '发表评论', 'begin' ); ?></span><small><?php cancel_comment_reply_link( '' . sprintf(__( '取消回复', 'begin' )) . '' ); ?></small></h3>

			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p class="comment-nologin"><?php print '' . sprintf(__( '您必须', 'begin' )) . ''; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e( '登录', 'begin' ); ?></a><?php _e( '才能发表评论！', 'begin' ); ?></p>
			<?php else : ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<?php if ( $user_ID ) : ?>
					<div class="user_avatar">
						<?php global $current_user;wp_get_current_user();
							echo get_avatar( $current_user->user_email, 64);
						?>
						<?php _e( '登录者：', 'begin' ); ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a><br />
						<a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e( '登出', 'begin' ); ?></a>
					</div>
					<?php elseif ( '' != $comment_author ): ?>
					<div class="author_avatar">
						<?php echo get_avatar($comment_author_email, $size = '64');  ?>
						<?php printf ('' . sprintf(__( '欢迎', 'begin' )) . ' <strong>%s</strong>', $comment_author); ?> <?php _e( '再次光临！', 'begin' ); ?><br />
						<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info"><?php _e( '修改信息', 'begin' ); ?></a>
						<script type="text/javascript">
							//<![CDATA[
							var changeMsg = "修改信息";
							var closeMsg = "关闭";
							function toggleCommentAuthorInfo() {
								jQuery('#comment-author-info').slideToggle('slow', function(){
									if ( jQuery('#comment-author-info').css('display') == 'none' ) {
									jQuery('#toggle-comment-author-info').text(changeMsg);
									} else {
									jQuery('#toggle-comment-author-info').text(closeMsg);
									}
								});
							}
							jQuery(document).ready(function(){
								jQuery('#comment-author-info').hide();
							});
							//]]>
						</script>
					</div>
					<?php endif; ?>

			        <p class="emoji-box"><?php get_template_part( 'inc/smiley' ); ?></p>
					<p class="comment-form-comment"><textarea id="comment" name="comment" rows="4" tabindex="1"></textarea></p>

					<p class="comment-tool">
					<?php if (zm_get_option('embed_img')) { ?>
						<a class="tool-img" href='javascript:embedImage();' title="<?php _e( '插入图片', 'begin' ); ?>"><i class="icon-img"></i><i class="be be-picture"></i></a>
					<?php } ?>
						<a class="emoji" href="" title="<?php _e( '插入表情', 'begin' ); ?>"><i class="be be-insertemoticon"></i></a>
					</p>

					<?php if ( ! $user_ID ): ?>

					<div id="comment-author-info">
						<p class="comment-form-author">
							<label for="author"><?php _e( '昵称', 'begin' ); ?><span class="required"><?php if ($req) echo "*"; ?></span></label>
							<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" tabindex="2" />
						</p>
						<p class="comment-form-email">
							<label for="email"><?php _e( '邮箱', 'begin' ); ?><span class="required"><?php if ($req) echo "*"; ?></span></label>
							<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" tabindex="3" />
						</p>
						<p class="comment-form-url">
							<label for="url"><?php _e( '网址', 'begin' ); ?></label>
							<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" tabindex="4" />
						</p>
						<?php if (zm_get_option('qq_info')) { ?>
							<p class="comment-form-qq">
								<label for="qq"><?php _e( 'QQ', 'begin' ); ?></label>
								<input id="qq" name="qq" type="text" value="" size="30" placeholder="输入QQ号码可以快速填写" />
								<span id="loging"></span>
							</p>
						<?php } ?>
					</div>
					<?php endif; ?>

					<div class="qaptcha"></div>

					<div class="clear"></div>
					<p class="form-submit">
						<input id="submit" name="submit" type="submit" tabindex="5" value="<?php _e( '提交评论', 'begin' ); ?>"/>
						<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>
					</p>

					<span class="mail-notify">
						<?php if (zm_get_option('mail_notify')) { ?>
							<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" checked="checked" class="notify" value="comment_mail_notify" />
						<?php } else { ?>
							<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" class="notify" value="comment_mail_notify" />
						<?php } ?>
						<label for="comment_mail_notify"><span><?php _e( '有回复时邮件通知我', 'begin' ); ?></span></label>
					</span>
				</form>

	 		<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( '评论已关闭！', 'begin' ); ?></p>
	<?php endif; ?>

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title wow fadeInUp" data-wow-delay="0.3s">
			<?php
				$my_email = get_bloginfo ( 'admin_email' );
				$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID 
				AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
				$count_t = $post->comment_count;
				$count_v = $wpdb->get_var("$str != '$my_email'");
				$count_h = $wpdb->get_var("$str = '$my_email'");
				echo "" . sprintf(__( '目前评论：', 'begin' )) . "",$count_t, " &nbsp;&nbsp;" . sprintf(__( '其中：访客', 'begin' )) . "&nbsp;&nbsp;", $count_v, " &nbsp;&nbsp;" . sprintf(__( '博主', 'begin' )) . "&nbsp;&nbsp;", $count_h, "  ";
			?>
			<?php if($numPingBacks>0) { ?>&nbsp;&nbsp;<?php _e( '引用', 'begin' ); ?>&nbsp;&nbsp;<?php echo ' '.$numPingBacks.' ';?><?php } ?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
			<?php if($numPingBacks>0) { ?>
				<div id="trackbacks">
					<h2 class="backs"><?php _e( '来自外部的引用：', 'begin' ); ?><?php echo ' '.$numPingBacks.'';?></h2>
					<ul class="track">
						<?php foreach ($comments as $comment) : ?>
						<?php $comment_type = get_comment_type(); ?>
						<?php if($comment_type != 'comment') { ?>
							<li><?php comment_author() ?></li>
						<?php } ?>
						<?php endforeach; ?>
			 		</ul>
				</div>
			<?php } ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<?php if (zm_get_option('comment_scroll')) { ?><div class="scroll-links"><?php the_comments_navigation(); ?></div><?php } ?>
			<nav class="comment-navigation">
				<div class="pagination">
					<?php 
						the_comments_pagination( array(
							'prev_text' => '<i class="be be-arrowleft"></i>',
							'next_text' => '<i class="be be-arrowright"></i>',
							'before_page_number' => '<span class="screen-reader-text">'.sprintf(__( '第', 'begin' )).' </span>',
							'after_page_number'  => '<span class="screen-reader-text"> '.sprintf(__( '页', 'begin' )).'</span>',
						) ); 
					?>
				</div>
			</nav>
			<div class="clear"></div>
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // have_comments() ?>

</div>
<!-- #comments -->