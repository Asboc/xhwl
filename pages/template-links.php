<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>

<style type="text/css">
.link-header h1 {
	font-size: 16px;
	font-size: 1.6rem;
	line-height: 30px;
	text-align: center;
	margin: 0 0 15px 0;
}
.linkcat {
	padding: 0 0 10px 0;
	overflow: hidden;
	zoom: 1;
}
.link-all {
	max-width: 100%;
 	width: auto;
	height: auto;
    overflow: hidden;
}
.link-all a img {
	max-width: 100%;
 	width: 100%;
	height: auto;
	margin: 0 auto;
	vertical-align: middle;
}
.link-all a {
	background: #fff;
	text-align: center;
	padding: 12px 5px;
	display: block;
	white-space: nowrap;
	word-wrap: normal;
	text-overflow: ellipsis;
	overflow: hidden;
	border: 1px solid #ddd;
	border-radius: 2px;
	transition-duration: .5s;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
}
.link-all-img a {
	padding: 0;
}
.link-page {
	margin: 0 -2px;
}
.cx7 {
	float: left;
	min-height: 1px;
	padding: 2px;
	transition-duration: .5s;
}
@media screen and (min-width:280px) {
	.cx7 {
		width: 50%;
	}
}
@media screen and (min-width:550px) {
	.cx7 {
		width: 33.33333333%;
	}
}
@media screen and (min-width:700px) {
	.cx7 {
		width: 25%;
	}
}
@media screen and (min-width:900px) {
	.cx7 {
		width: 20%;
	}
}
@media screen and (min-width:1024px) {
	.cx7 {
		width: 14.2857%;
	}
}
<?php if (zm_get_option('linkcat_h2') == '' ) { ?>
.linkcat h2 {display: none;}
<?php } ?>
</style>

<main id="main" class="link-content" role="main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="link-header">
				<div class="archive-l"></div>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<div class="single-content">
					<?php the_content(); ?>
					<?php edit_post_link('编辑', '<span class="edit-link">', '</span>' ); ?>
				</div> <!-- .single-content -->
			</div><!-- .entry-content -->
		</article><!-- #page -->
	<?php endwhile; ?>

	<article class="link-page">
		<ul>
			<?php if (zm_get_option('link_all_img')) { ?>
				<?php wp_list_bookmarks('title_li=&before=<li><span class="cx7 wow fadeInUp" data-wow-delay="0.3s"><span class="link-all link-all-img">&after=</span></span></li>&categorize=1&show_images=1&orderby=rating&order=DESC&category_orderby=description&category='.zm_get_option('link_cat')); ?>
			<?php } else { ?>
				<?php wp_list_bookmarks('title_li=&before=<li><span class="cx7 wow fadeInUp" data-wow-delay="0.3s"><span class="link-all link-all-name">&after=</span></span></li>&categorize=1&show_images=0&orderby=rating&order=DESC&category_orderby=description&category='.zm_get_option('link_cat')); ?>
			<?php } ?>
		</ul>
		<div class="clear"></div>
	</article>

</main>

<?php get_footer(); ?>