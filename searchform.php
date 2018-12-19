<div class="searchbar">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/">
		<span class="search-input">
			<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e( '输入搜索内容', 'begin' ); ?>" required />
			<button type="submit" id="searchsubmit"><i class="be be-search"></i></button>
		</span>
		<?php if (zm_get_option('search_cat')) { ?>
		<span class="search-cat">
			<?php $args = array(
				'show_option_all' => '全部分类',
				'hide_empty'      => 0,
				'name'            => 'cat',
				'show_count'      => 0,
				'taxonomy'        => 'category',
				'hierarchical'    => 1,
				'depth'           => -1,
				'exclude'         => zm_get_option('not_search_cat'),
			); ?>
			<?php wp_dropdown_categories( $args ); ?>
		</span>
		<?php } ?>
	</form>
</div>