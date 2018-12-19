<?php
/**
 * 全部子分类,有侧边栏
 */

get_header(); ?>

<style type="text/css">
.child-post {
	position: relative;
	background: #fff;
	margin: 0 0 10px 0;
	padding: 0 20px 20px 20px;
	border: 1px solid #ddd;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
	border-radius: 2px;
}

.child-inf {
	float: right;
	color: #bbbbbb;
}

.child-title {
	background: #f8f8f8;
	line-height: 40px;
	margin: 0 -20px;
	padding: 0 0px;
	border-bottom: 1px solid #ddd;
}

.child-title a {
	width: 100%;
	display: block;
}

.child-title .be-more {
	float: right;
	font-size: 30px !important;
	font-weight: normal;
	line-height: 40px;
	margin-right: 15px;
}

.child-list {
	margin-top: 10px;
}

.child-list li {
	line-height: 230%;
	white-space: nowrap;
	word-wrap: normal;
	text-overflow: ellipsis;
	overflow: hidden;
}

.child-list .fa-angle-right {
	color: #999;
	margin: 0 5px 0 0;
}

.child-title .icon-m {
	font-size: 16px;
	color: #999;
	vertical-align: middle;
}

@media screen and (max-width:900px) {
	.child-box {
		margin-top: 10px;
	}
}

@media screen and (max-width: 440px) {
	.child-inf {
		display: none;
	}
}
</style>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s">
			<?php if ( category_description() ) :  ?>
			<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
		</article>

		<!-- 
		<?php if (zm_get_option('ad_a')) { ?>
			<?php if ( wp_is_mobile() ) { ?>
				 <?php if ( zm_get_option('ad_a_c_m') ) { ?><div class="ad-m ad-site"><?php echo stripslashes( zm_get_option('ad_a_c_m') ); ?></div><?php } ?>
			<?php } else { ?>
				 <?php if ( zm_get_option('ad_a_c') ) { ?><div class="ad-pc ad-site"><?php echo stripslashes( zm_get_option('ad_a_c') ); ?></div><?php } ?>
			<?php } ?>
		<?php } ?>
 		-->

		<div class="child-box">
			<?php
				global $cat;
				$cats = get_categories(array(
					'child_of' => $cat,
					'parent' => $cat,
					'hide_empty' => 0
				));
				foreach($cats as $the_cat){
					$posts = get_posts(array(
						'category' => $the_cat->cat_ID,
						'numberposts' => 18,
					));
					if(!empty($posts)){
						echo '
						<div class="child-post wow fadeInUp" data-wow-delay="0.3s">
							<h3 class="child-title cat-title"><span class="title-i"><span class="title-i-t"></span><span class="title-i-b"></span><span class="title-i-b"></span><span class="title-i-t"></span></span><a href="'.get_category_link($the_cat).'">'.$the_cat->name.'<i class="be be-more"></i></a></h3>
							<ul class="child-list">';
								foreach($posts as $post){
									echo '<li class="child-inf">'.mysql2date('m月d日', $post->post_date).'</li><li>
									<i class="be be-arrowright"></i><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
								}
							echo '</ul>
						</div>';
					}
				}
			?>
		</div>
	</main><!-- .site-main -->
</section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>