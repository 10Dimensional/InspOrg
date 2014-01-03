<?php
            /*
                	Template Name: category
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
				<span class="text"><?php single_cat_title( $prefix = '', $display = true ); ?></span>
			</h1>
		</div>
			<section class="text-section style-red">
			<div class="holder">
				<?php echo category_description(); ?>
			</div>
			</section>
	<div class="events-section">
			<div class="holder">
				<div class="frame">
				<?php

// The Loop
while ( have_posts() ) : the_post(); ?>
					<section class="box">
						<a class="btn-lightbox" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
						<div class="description">
							<div class="date-box">
								<em class="date"><?php the_time('F jS, Y') ?></em>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">MORE&gt;&gt;</a>
							</div>
							<div class="text-wrap">
								<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								<p> <?php the_excerpt(); ?></p>
							</div>
						</div>
					</section>
			<?php endwhile; // End Loop ?>
				</div>
			</div>
				<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>