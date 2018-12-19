<?php
/*
Template Name: 作者墙
*/
?>
<?php get_header(); ?>

<style type="text/css">
.author-header h1 {
	font-size: 18px;
	font-size: 1.8rem;
	line-height: 30px;
	text-align: center;
	margin: 0 0 15px 0;
}

.author-page {
	margin: 0 -10px;
}

.author-name a {
	padding: 10px;
	display: block;
	white-space: nowrap;
	word-wrap: normal;
	text-overflow: ellipsis;
	overflow: hidden;
}

.author-all {
	background: #fff;
	text-align: center;
	display: block;
	border: 1px solid #ddd;
	border-radius: 2px;
	transition-duration: .5s;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
}

.author-all a img {
	max-width: 100%;
	width: auto;
	height: auto;
	margin: 0 auto;
}

.cx6 {
	float: left;
	min-height: 1px;
	padding: 10px;
}

@media screen and (min-width:280px) {
	.cx6 {
		width: 50%;
		transition-duration: .5s;
	}
}

@media screen and (min-width:550px) {
	.cx6 {
		width: 33.33333333%;
		transition-duration: .5s;
	}
}

@media screen and (min-width:700px) {
	.cx6 {
		width: 25%;
		transition-duration: .5s;
	}
}

@media screen and (min-width:900px) {
	.cx6 {
		width: 20%;
		transition-duration: .5s;
	}
}

@media screen and (min-width:1024px) {
	.cx6 {
		width: 16.6666666666666%;
		transition-duration: .5s;
	}
}
</style>

<?php
function allauthor() {
global $wpdb;
$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
	foreach($authors as $author) {
		echo "<div class='cx6'><span class='author-all'><span>";
		echo "<a href='".get_bloginfo('url')."/author/".get_the_author_meta('user_login', $author->ID)."'>".get_avatar($author->ID,200)."</a>";
		echo '<span class="author-name">';
		echo "<a href='".get_bloginfo('url')."/author/".get_the_author_meta('user_login', $author->ID)."'>";
		the_author_meta('display_name', $author->ID);
		echo "</a>";
		echo "</span>";
		echo "</span></span></div>";
	}
}
?>
<main id="main" class="author-content" role="main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="author-header">
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

	<article class="author-page">
		<?php allauthor();?>
		<div class="clear"></div>
	</article>
</main>

<?php get_footer(); ?>