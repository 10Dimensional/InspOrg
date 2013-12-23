<?php
                /*
                	Template Name: contact-page
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
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.main.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<?php wp_head() ?></head>
<body>
	<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg" class="bg-without-mask">
				<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-05.jpg" alt="">
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
		<section class="contacts-section">
			<div class="holder">
			<div class="contact-block">
<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>

		</section>
		</div>
<!--		<section class="start-section">
			<div class="holder">
									<?php the_field('contactcloser'); ?>
			</div>
		</section> -->
		</blogcontent>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>