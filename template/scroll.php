<ul id="scroll">
	<li class="log log-no"><a class="log-button" title="<?php _e( '文章目录', 'begin' ); ?>"><i class="be be-menu"></i></a><div class="log-prompt"><div class="log-arrow"><?php _e( '文章目录', 'begin' ); ?></div></div></li>
	<?php if (is_singular() || is_category()) { ?><li><a class="scroll-home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e( '首页', 'begin' ); ?>" rel="home"><i class="be be-home"></i></a></li><?php } ?>
	<li><a class="scroll-h" title="<?php _e( '返回顶部', 'begin' ); ?>"><i class="be be-arrowup"></i></a></li>
	<?php if (is_single() || is_page()) { ?><li><a class="scroll-c" title="<?php _e( '评论', 'begin' ); ?>"><i class="be be-speechbubble"></i></a></li><?php } ?>
	<li><a class="scroll-b" title="<?php _e( '转到底部', 'begin' ); ?>"><i class="be be-arrowdown"></i></a></li>
	<?php if (zm_get_option('gb2')) { ?><li class="gb2-site"><a id="gb2big5"><span>繁</span></a></li><?php } ?>
	<?php if (zm_get_option('qq_online')) { ?><?php get_template_part( 'template/qqonline' ); ?><?php } ?>
	<?php if (zm_get_option('qr_img')) { ?>
		<li class="qr-site"><a href="javascript:void(0)" class="qr" title="<?php _e( '本页二维码', 'begin' ); ?>"><i class="be be-qr-code"></i><span class="qr-img"><span id="output"><img class="alignnone" src="<?php echo zm_get_option('qr_icon'); ?>" alt="icon"/></span><span class="arrow arrow-z"><i class="be be-playarrow"></i></span><span class="arrow arrow-y"><i class="be be-playarrow"></i></span></span></a></li>
		<script type="text/javascript">$(document).ready(function(){if(!+[1,]){present="table";} else {present="canvas";}$('#output').qrcode({render:present,text:window.location.href,width:"150",height:"150"});});</script>
	<?php } ?>
</ul>