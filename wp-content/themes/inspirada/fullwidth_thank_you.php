<?php
    /* Template Name: Full Width Thank You2 */ 
    $first = $_GET['first'];
    $last = $_GET['last'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $comment = $_GET['comment'];
    $builders = explode(',', $_GET['builders']);

    if (in_array(' KB Home', $builders)) {
        generate_xml_email_kb_main($first, $last, $email, $phone, $comment);
    }

    if (in_array('Beazer Homes', $builders)) {
        generate_xml_email_beazer_main($first, $last, $email, $phone, $comment);
    }

    if (in_array(' Toll Brothers', $builders)) {
        generate_xml_soap_toll_main($email, $comment, $first, $phone, $last);
    }               
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
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>

<?php wp_head() ?></head>
<body>
	<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg" class="bg-with-mask">
				<img src="<?php the_field('hero_image'); ?>" alt="">
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
		<section class="text-section">
			<div class="holder">
									<?php the_field('headliner'); ?>
			</div>
		</section>
		<div id="main" style="background: white">
			<div class="main-holder">
<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>