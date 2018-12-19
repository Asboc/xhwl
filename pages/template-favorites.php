<?php
/*
Template Name: 网址收藏
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/sites.css" />

<style type="text/css">
#primary {
 	float: right;
}
#sidebar {
	float: left;
}
</style>

<div class="favorites-top">
	<div class="top-date rili">
		<?php the_title( '<h1 class="favorites-title">', '</h1>' ); ?>
		<span id=localtime></span>
		<script type="text/javascript">
		function showLocale(objD){
			var str,colorhead,colorfoot;
			var yy = objD.getYear();
			if(yy<1900) yy = yy+1900;
			var MM = objD.getMonth()+1;
			if(MM<10) MM = '0' + MM;
			var dd = objD.getDate();
			if(dd<10) dd = '0' + dd;
			var hh = objD.getHours();
			if(hh<10) hh = '0' + hh;
			var mm = objD.getMinutes();
			if(mm<10) mm = '0' + mm;
			var ss = objD.getSeconds();
			if(ss<10) ss = '0' + ss;
			var ww = objD.getDay();
			if  ( ww==0 )  colorhead="<font color=\"#FF0000\">";
			if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#373737\">";
			if  ( ww==6 )  colorhead="<font color=\"#008000\">";
			if  (ww==0)  ww="星期日";
			if  (ww==1)  ww="星期一";
			if  (ww==2)  ww="星期二";
			if  (ww==3)  ww="星期三";
			if  (ww==4)  ww="星期四";
			if  (ww==5)  ww="星期五";
			if  (ww==6)  ww="星期六";
			colorfoot="</font>"
			str = colorhead + yy + "年" + MM + "月" + dd + "日 " + hh + ":" + mm + ":" + ss + "  " + ww + colorfoot;
			return(str);
		}
		function tick()
		{
			var today;
			today = new Date();
			document.getElementById("localtime").innerHTML = showLocale(today);
			window.setTimeout("tick()", 1000);
		}
		tick();
		</script>
	</div>

	<div class="tianqi rili">
		<iframe allowtransparency="true" frameborder="0" width="385" height="75" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=1&z=1&t=0&v=0&d=3&bd=0&k=&f=&q=1&e=1&a=1&c=54511&w=385&h=96&align=left"></iframe>
	</div>
	<div class="clear"></div>
</div>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<!-- 网址小工具 -->
		<div id="sites-widget-one" class="sites-widget">
			<?php dynamic_sidebar( 'favorites-one' ); ?>
			<div class="clear"></div>
		</div>

		<!-- 全部网址分类 -->
		<?php
		$taxonomy = 'favorites';
		$terms = get_terms($taxonomy); foreach ($terms as $cat) {
		$catid = $cat->term_id;
		$args = array(
			'showposts' => 100,
			'meta_key' => 'sites_order',
			'orderby' => 'meta_value',
			'order' => 'date',
			'tax_query' => array( array( 'taxonomy' => $taxonomy, 'terms' => $catid, 'include_children' => false ) )
		);
		$query = new WP_Query($args);
		if( $query->have_posts() ) { ?>
		<article class="sites sites-all wow fadeInUp" data-wow-delay="0.3s">
			<div class="sites-cats">
				<h3 class="sites-cat"><?php echo $cat->name; ?></h3>
				<span class="sites-more"><a href="<?php echo get_term_link( $cat ); ?>" ><?php _e( '更多', 'begin' ); ?> <i class="be be-fastforward"></i></a></span>
			</div>
			<div class="clear"></div>
			<div class="sites-link">
				<div class="sites-5">
					<?php while ($query->have_posts()) : $query->the_post();?>
						<?php if ( get_post_meta($post->ID, 'sites_img_link', true) ) { ?>
							<?php $sites_img_link = sites_nofollow(get_post_meta($post->ID, 'sites_img_link', true)); ?>
							<span class="sites-title wow fadeInUp" data-wow-delay="0s">
								<figure class="picture-img sites-img"><?php if (zm_get_option('lazy_s')) { zm_sites_thumbnail_h(); } else { zm_sites_thumbnail(); } ?></figure>
								<a href="<?php echo $sites_img_link ?>" target="_blank" rel="external nofollow"><?php the_title(); ?></a>
							</span>
						<?php } else { ?>
							<?php $sites_link = sites_nofollow(get_post_meta($post->ID, 'sites_link', true)); ?>
							<span class="sites-title wow fadeInUp" data-wow-delay="0s"><a href="<?php echo $sites_link ?>" target="_blank" rel="external nofollow"><?php the_title(); ?></a></span>
						<?php } ?>
					<?php endwhile; ?>
					<div class="clear"></div>
				</div>
			</div>
		</article>
		<?php } wp_reset_query(); ?>
		<?php } ?>

		<!-- 备用
		<article class="sites sites-cat">
			<div class="sites-cats">
				<span class="sites-cat">分类名称</span>
				<span class="sites-more"><a href="文字替换为网址分类链接地址">更多</a>
			</div>
			<div class="sites-link">
				<ul class="sites-5">
					<?php 
						$args = array('tax_query' => array( array('taxonomy' => 'favorites', 'field' => 'id', 'terms' => explode(',',830 ))), 'posts_per_page' => 100);
						query_posts($args); while ( have_posts() ) : the_post();
					?>
					<?php if ( get_post_meta($post->ID, 'sites_link', true) ) { ?>
					<?php $sites_link = get_post_meta($post->ID, 'sites_link', true); ?>
						<li class="sites-title"><a href="<?php echo $sites_link ?>" target="_blank" rel="external nofollow"><?php the_title(); ?></a></li>
					<?php } else { ?>
						<?php the_title( sprintf( '<li class="sites-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
					<?php } ?>

					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<div class="clear"></div>
				</ul>
			</div>
		</article>
		 -->

	</main>
</div>

<div id="sidebar" class="widget-area">
	<div class="wow fadeInUp" data-wow-delay="0.5s">
		<?php if ( ! dynamic_sidebar( 'favorites' ) ) : ?>
			<aside id="add-widgets" class="widget widget_text">
				<h3 class="widget-title"><i class="be be-warning"></i>添加小工具</h3>
				<div class="textwidget">
					<a href="<?php echo admin_url(); ?>widgets.php" target="_blank">为“网址侧边栏”添加小工具</a>
				</div>
				<div class="clear"></div>
			</aside>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>