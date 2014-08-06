<?php
                /*
                	Template Name: app page
                */ 
                
                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">

<!--	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<?php wp_head() ?></head>
<body>
	<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg">
<img src="<?php bloginfo('template_url') ?>/images/greenbg.jpg">	</div>
	<section class="start-section add">
			<div class="holder">
				<h1><span>Inspirada App Now Available!</span></h1>
				<div class="row">
				<div class="col-sm-6">
				<!--<img class="image" src="<?php bloginfo('template_url') ?>/images/arapp.png" alt="image description">-->
                    <iframe width="460" height="315" src="//www.youtube.com/embed/ICe-yuikzUs" frameborder="0" allowfullscreen></iframe>
				</div>
				<div class="col-sm-6">
				<div class="text-box" style="color: white;">
					<?php echo $post->post_content ?> 
				</div>
				</div>
			</div>
			</div>
		</section> 
		</div>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>