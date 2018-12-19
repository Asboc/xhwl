<?php
/*
Template Name: 联系方式
*/
?>
<?php get_header(); ?>

<style type="text/css">
#primary {
	width: 100%;
}
.contact-page {
	margin: 40px 0;
}
#contact label {
	display: block;
	margin: 0 0 0 30px;
	padding: 5px 0;
}
#contact input, #contact textarea {
	background: #fff;
	margin: 0 0 0 30px;
	padding: 6px;
   	width: 40%;
	border: 1px solid #ebebeb;
	border-radius: 2px;
	-webkit-appearance: none;
}
#contact textarea {
   	width: 80%;
}
#contact input[type="submit"]{
	border: none;
	padding: 0 5px;
	height: 42px;
	margin-top: 10px;
	cursor: pointer;
	background: #0088cc;
	color: #fff;
	border-radius: 2px;
}
#contact input[type="submit"]:hover{
	background: #666;
	border-radius: 2px;
 	transition: all 0.2s ease-in 0s;
}
.errormsg, .successmsg{
	color: #d80000;
	padding: 10px;
	border-radius: 2px;
}
.successmsg {
	background: #91c24f;
}
.tcha {
	margin: 0 0 0 30px;
}
</style>

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.form.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
	$('#contact').ajaxForm(function(data) {
		if (data==1){
			$('#success').fadeIn("slow");
			$('#bademail').fadeOut("slow");
			$('#badserver').fadeOut("slow");
			$('#contact').resetForm();
		}
		else if (data==2){
			$('#badserver').fadeIn("slow");
		}
		else if (data==3)
		{
			$('#bademail').fadeIn("slow");
		}
	});
});
</script>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="single-content">
						<?php the_content(); ?>

						<div class="contact-page">
							<h3><?php _e( '联系我们', 'begin' ); ?></h3>

		                    <?php if ( zm_get_option('email') == '' ) { ?>
		                        <p style="color: #d80000; ">您还未设置电子邮件，请到主题选项中，添加常用电子邮件！</p>
		                    <?php } ?>

							<p id="success" class="successmsg" style="display:none;"><?php _e( '您的电子邮件已发送成功！', 'begin' ); ?></p>
							<p id="bademail" class="errormsg" style="display:none;"><?php _e( '请输入您的姓名和一个有效的电子邮件地址及邮件内容。', 'begin' ); ?></p>
							<p id="badserver" class="errormsg" style="display:none;"><?php _e( '您的电子邮件发送失败，请稍后再试。', 'begin' ); ?></p>

							<form id="contact" action="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/sendmail.php" method="post">
								<label for="name"><?php _e( '名字', 'begin' ); ?></label>
								<input type="text" id="nameinput" name="name" value=""/>
								<label for="email"><?php _e( '邮箱', 'begin' ); ?></label>
								<input type="text" id="emailinput" name="email" value=""/>
								<label for="comment"><?php _e( '邮件内容', 'begin' ); ?></label>
								<textarea cols="20" rows="7" id="commentinput" name="comment"></textarea><br />

								<input type="submit" id="submitinput" name="submit" class="submit" value="<?php _e( '发送邮件', 'begin' ); ?>"/>
								<input type="hidden" id="receiver" name="receiver" value="<?php echo zm_get_option('email'); ?>"/>
								<!--<input type="hidden" id="from_email" name="from_email" value="<?php echo zm_get_option('example_email')?>"/>-->
							</form>
						</div>
					</div> <!-- .single-content -->
				</div><!-- .entry-content -->
			</article><!-- #page -->
		<?php endwhile; ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>