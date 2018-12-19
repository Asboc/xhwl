<?php
/*
Template Name: 试试手气
*/
?>
<?php get_header(); ?>

<?php $rand_post=get_posts('numberposts=1&orderby=rand'); foreach($rand_post as $post) : ?>
<script> location="<?php the_permalink(); ?>";</script>
<?php endforeach; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>