<?php if ( get_post_meta($post->ID, 'header_img', true) ) : ?>
<?php if (is_single() || is_page() ) : ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#header-img").responsiveSlides({
			auto: true,
			pager: true,
			nav: false,
			speed: 800,
			timeout: 5000,
			pause: true,
			maxwidth: 2000,
			namespace: "callbacks"
		});
	});
</script>
<div class="header-sub">
	<div id="slideshow">
		<ul class="rslides" id="header-img">
			<?php
			$image = get_post_meta($post->ID, 'header_img', true);
			$image=explode("\n",$image);
			foreach($image as $key=>$header_img){ ?>
			<li><img src="<?php echo $header_img;?>"/></li>
			<?php }?>
		</ul>
		<?php while (have_posts()) : the_post(); ?>
			<?php the_title( '<h1 class="header-title wow fadeInUp" data-wow-delay="0.3s">', '</h1>' ); ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>