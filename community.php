<?php
                /*
                	Template Name: community
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
			<nav>
				<ul class="breadcrumbs">
					<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title page-title-3">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span>
			</h1>
				<section class="content-section add">
				<div class="holder">
<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
			<div class="btn-next-holder">
						<a href="#amenities" class="btn-next-section go">More: Amenities</a>
					</div>			
			</div>
			</section>
			<section id="amenities" class="content-section style-1">
				<div class="holder">
					<?php the_field('amenities'); ?>
					<div class="btn-next-holder">
						<a href="#homes" class="btn-next-section go">More: Homes</a>
					</div>
				</div>
			</section>
			<section id="homes" class="content-section style-2">
				<div class="holder">
					<?php the_field('homes'); ?>
					<div class="btn-next-holder">
						<a href="#henderson" class="btn-next-section go">More: Henderson</a>
					</div>
				</div>
			</section>
			<section id="henderson" class="content-section style-3">
				<div class="holder">
					<?php the_field('henderson'); ?>
				</div>
			</section>
		</blogcontent>
		</div>
		<a href="#" class="btn-back-to-top go">BACK TO TOP</a>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>