<?php
/*
Template Name: 近期留言
*/
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div id="message" class="message-page">
						<ul>
							<?php
							$show_comments = 70;
							$my_email = get_bloginfo ('admin_email');
							$i = 1;
							$comments = get_comments('number=200&status=approve&type=comment');
							foreach ($comments as $my_comment) {
								if ($my_comment->comment_author_email != $my_email) {
									?>
									<li>
										<a href="<?php echo get_permalink($my_comment->comment_post_ID); ?>#comment-<?php echo $my_comment->comment_ID; ?>" title="<?php echo get_the_title($my_comment->comment_post_ID); ?>" >
											<?php echo get_avatar($my_comment->comment_author_email,64); ?>
											<strong><span class="comment_author"><?php echo $my_comment->comment_author; ?></span></strong>
											<?php echo convert_smilies($my_comment->comment_content); ?>
										</a>
									</li>
									<?php
									if ($i == $show_comments) break;
									$i++;
								}
							}
							?>
						</ul>
					</div><!-- #message -->

				</article><!-- #page -->
			<?php endwhile;?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>