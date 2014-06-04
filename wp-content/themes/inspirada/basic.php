<?php
                /*
                	Template Name: Full Width Basic
                */ 
                
                ?>
<!DOCTYPE html>
<html style="margin-top: 0px !important;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<style>
.gform_wrapper .gform_footer input.button, .gform_wrapper .gform_footer input[type=submit] {
font-size: 1em;
float: left;
}
</style> 
<?php wp_head() ?></head>
<body style="padding: 15px;">

<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
	</div>
</html>