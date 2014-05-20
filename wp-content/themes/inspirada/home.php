<?php
                /*
                	Template Name: home
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
<?php 
    echo do_shortcode("[metaslider id=766]"); 
?>	</div>
			<div class="intro-section">
				<div class="heading">
					<a href="/living-inspired" class="btn-explore">EXPLORE INSPIRADA</a>
					<h1><?php the_field('headline'); ?></h1>
					<p><?php echo $post->post_content ?> </p>
				</div>
			</div>
			<section class="features-section">
				<h1>Points of Inspirada</h1>
				<ul class="buttons-list">
					<li><a href="/search-for-homes"><div class="btn-bg"></div><span><?php the_field('hex1'); ?></span></a></li>
					<li class="style-1"><a href="/living-inspired"><div class="btn-bg"></div><span><?php the_field('hex2'); ?></span></a></li>
					<li class="style-2"><a href="/location-is-everything"><div class="btn-bg"></div><span><?php the_field('hex3'); ?></span></a></li>
				</ul>
			</section>
		</div>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>