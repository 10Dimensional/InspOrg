<?php
                /*
                	Template Name: faq
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

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.main.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<?php wp_head() ?></head>
<body>
	<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg" class="bg-without-mask">
				<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-07.jpg" alt="">
			</div>
			<nav>
				<ul class="breadcrumbs">
<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title page-title-4">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span>
			</h1>
		</div>
		<div id="main">
			<div class="main-holder">
				<div id="content" class="main-col">
					<div class="section-box">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; // end of the loop. ?>						
					</div>
					
					<ul class="nav nav-tabs">
						<li><a href="#tab01" data-toggle="tab">One</a></li>
						<li><a href="#tab02" data-toggle="tab">Two</a></li>
						<li><a href="#tab03" data-toggle="tab">Three</a></li>
						<li><a href="#tab04" data-toggle="tab">Four</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab01"><?php the_block('Tab One'); ?></div>
						<div class="tab-pane" id="tab02"><?php the_block('Tab Two'); ?></div>
						<div class="tab-pane" id="tab03"><?php the_block('Tab Three'); ?></div>
						<div class="tab-pane" id="tab04"><?php the_block('Tab Four'); ?></div>
					</div>

				</div>
			<aside id="sidebar" class="main-col">
						<?php if ( ! dynamic_sidebar('right-sidebar') ) : ?>
		<?php endif; ?>
			</div>
			<section class="start-section add">
			<div class="holder">
					<?php the_field('closer'); ?>
			</div>
		</section>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>