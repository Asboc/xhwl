<div id="sidebar" class="widget-area all-sidebar">

	<?php wp_reset_query(); if ( is_home() ) : ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-h' ) ) : ?>
			<aside id="add-widgets" class="widget widget_text">
				<h3 class="widget-title"><i class="be be-warning"></i>添加小工具</h3>
				<div class="textwidget">
					<a href="<?php echo admin_url(); ?>widgets.php" target="_blank">为“博客布局侧边栏”添加小工具</a>
				</div>
			</aside>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( is_page('template-cms') ) : ?>
		<?php dynamic_sidebar( 'cms-page' ); ?>
	<?php endif; ?>

	<?php if (is_single() || is_page() ) : ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-s' ) ) : ?>
			<aside id="add-widgets" class="widget widget_text">
				<h3 class="widget-title"><i class="be be-warning"></i>添加小工具</h3>
				<div class="textwidget">
					<a href="<?php echo admin_url(); ?>widgets.php" target="_blank">为“正文侧边栏”添加小工具</a>
				</div>
			</aside>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( is_archive() || is_search() || is_404() ) : ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-a' ) ) : ?>

			</aside>
		<?php endif; ?>
	<?php endif; ?>
</div>

<div class="clear"></div>