<section class="no-results not-found">
	
	<div class="post">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>目前还没有文章！</p>
			<p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php">点击这里发布您的第一篇文章</a></p>

		<?php elseif ( is_search() ) : ?>

			<header class="entry-header">
				<h1 class="page-title">没有您要找的文章！</h1>
			</header><!-- .page-header -->

			<p>可以尝试使用下面的搜索功能，查找您喜欢的文章！</p>
			<?php get_search_form(); ?>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<?php else : ?>

			<p>目前还没有文章！可以尝试使用下面的搜索功能，查找您喜欢的文章！</p>
			<?php get_search_form(); ?>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
