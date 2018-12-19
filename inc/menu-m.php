<div id="mobile-nav">
	<?php
		wp_nav_menu( array(
			'theme_location'	=> 'mobile',
			'menu_class'		=> 'mobile-menu',
			'fallback_cb'		=> 'default_menu'
		) );
	?>
	<div class="clear"></div>
</div>