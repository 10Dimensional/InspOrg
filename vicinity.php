<?php
                /*
                	Template Name: vicinity
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
<body>
<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg">
				<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-02.jpg" alt="">
			</div>
			<nav>
				<ul class="breadcrumbs">
<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span>
			</h1>
			<section class="vicinity-section">
				<div class="panel">
					<section>
						<h1 class="title-1">Community</h1>
						<ul class="accordion community-list">
							<li>
								<a href="#" class="opener">Fitness</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
							<li class="style-1">
								<a href="#" class="opener">Parks</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
							<li class="style-2">
								<a href="#" class="opener">Pools</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
							<li class="style-3">
								<a href="#" class="opener">Trailhead/Trails</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
						</ul>
					</section>
					<section>
						<h1 class="title-2">Vicinity</h1>
						<ul class="accordion vicinity-list">
							<li>
								<a href="#" class="opener">Entertainment</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
							<li class="style-1">
								<a href="#" class="opener">School Site</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
							<li class="style-2">
								<a href="#" class="opener">Shopping</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
							<li class="style-3">
								<a href="#" class="opener">Sports</a>
								<div class="slide">
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
									<strong class="title">Park Name</strong>
									<p>602.222.2222 | <a href="#">website</a></p>
								</div>
							</li>
						</ul>
					</section>
				</div>
				<div class="map-block">
					<img src="<?php bloginfo('template_url') ?>/images/map-placeholder-1.jpg" alt="image description">
				</div>
			</section>
		</div>
<!--			<section class="start-section">
		<div class="holder">
					<?php echo $post->post_content ?>
			</div>
		</section> -->
	</blogcontent>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>