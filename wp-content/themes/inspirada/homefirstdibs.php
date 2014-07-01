<?php
                /*
                	Template Name: home first dibs
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
			<div class="intro-section">
			<div class="row">
  <div class="col-xs-12"><img src="<?php bloginfo('template_url') ?>/images/eventheadlineribbon.png"></div>
			</div>
			<div class="row">
			<div class="col-sm-3">
			<img src="<?php bloginfo('template_url') ?>/images/house1.png">
			</div>
			<div class="col-sm-4">
			<p><?php echo $post->post_content ?> </p>
			<div class="register-now"><a href="#"></a></div>
			</div>
			<div class="col-sm-4">
			<img src="<?php bloginfo('template_url') ?>/images/house2.png">
			</div>
			</div>
			</div>
			</div>
<!--			<section class="start-section add">
			<div class="holder">
				<h1><span>Download our new APP!</span></h1>
				<div class="row">
				<div class="col-sm-6">
				<img class="image" src="<?php bloginfo('template_url') ?>/images/arapp.png" alt="image description">
				</div>
				<div class="col-sm-6"
				<div class="text-box">
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<strong class="marked-text">Find Out More <a href="#">MAP&gt;&gt;</a></strong> </p>
				</div>
				</div>
			</div>
			</div>
		</section> -->
		</div>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>