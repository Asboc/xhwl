<?php if ( get_post_meta($post->ID, 'postauthor', true) ) : ?>
<div class="authorbio wow fadeInUp" data-wow-delay="0.3s">
	<?php echo get_avatar( get_the_author_meta('email'), '64' ); ?>

	<ul class="spostinfo">
		<?php $author = get_post_meta($post->ID, 'postauthor', true); ?>
		<?php $aurl = get_post_meta($post->ID, 'authorurl', true); ?>
		<li><strong><?php _e( '版权声明：', 'begin' ); ?></strong>本文由<a target="_blank" rel="nofollow" href="<?php echo $aurl ?>" ><b><?php echo $author ?></b></a> 投稿，于<?php time_ago( $time_type ='posts' ); ?>发表，<?php echo count_words ($text); ?>。</li>
		<li class="reprinted"><strong><?php _e( '转载请注明：', 'begin' ); ?></strong><a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name');?></a></li>
	</ul>
	<div class="clear"></div>
</div>
<?php else: ?>
<div class="authorbio wow fadeInUp" data-wow-delay="0.3s">
	<?php echo get_avatar( get_the_author_meta('email'), '64' ); ?>

	<ul class="spostinfo">
		<li>
			<?php $copy = get_post_meta($post->ID, 'copyright', true); ?>
			<?php if ( get_post_meta($post->ID, 'from', true) ) : ?>
				<?php $original = get_post_meta($post->ID, 'from', true); ?>
				<strong><?php _e( '版权声明：', 'begin' ); ?></strong><?php _e( '本文源自', 'begin' ); ?>
				<?php if ( get_post_meta($post->ID, 'copyright', true) ) : ?>
				<strong><a href="<?php echo $copy ?>" rel="nofollow" target="_blank"><?php echo $original ?></a></strong>，
			<?php else: ?>
				<?php echo $original ?>，
			<?php endif; ?>
			<?php _e( '于', 'begin' ); ?><?php time_ago( $time_type ='posts' ); ?>，<?php _e( '由', 'begin' ); ?> <strong><?php the_author_posts_link(); ?></strong> <?php _e( '整理发表', 'begin' ); ?>，<?php echo count_words ($text); ?>。
		</li>
		<li class="reprinted"><strong><?php _e( '转载请注明：', 'begin' ); ?></strong><a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name');?></a></li>
		<?php else: ?>
		<li><strong><?php _e( '版权声明：', 'begin' ); ?></strong><?php _e( '本站原创文章', 'begin' ); ?>，<?php _e( '于', 'begin' ); ?><?php time_ago( $time_type ='posts' ); ?>，<?php _e( '由', 'begin' ); ?> <b><?php the_author_posts_link(); ?></b> <?php _e( '发表', 'begin' ); ?>，<?php echo count_words ($text); ?>。</li>
		<li class="reprinted"><strong><?php _e( '转载请注明：', 'begin' ); ?></strong><a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name');?></a></li>
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>
<?php endif; ?>