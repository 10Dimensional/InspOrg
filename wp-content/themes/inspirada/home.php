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
			    <style>
        #see-for-youself-link:hover {
            background-color: #fff !important;
            color: #FF6C36 !important;
        }
    </style>
    <section class="start-section add">
        <div class="holder" style=" padding-top: 25px; padding-bottom: 25px; ">
            <h1 style="margin-bottom: 15px;"><span>Download our new APP!</span></h1>
            <div class="row">
                <div class="col-sm-6">
                    <img class="image" style="margin-bottom: 10px;" src="<?php bloginfo('template_url') ?>/images/arapp.png" alt="image description">
                    <a id="see-for-youself-link" href="http://166.78.0.133/app-page" style="background-color: #FF6C36; text-decoration: none; color: white; font-weight: bold; padding: 10px; margin-left: 25%; font: 16px/22px 'roboto_slabbold', 'Times New Roman', Times, serif;">Learn More About the App</a>
                </div>
                <div class="col-sm-6"> <div class="text-box" style="color: white;">
                    <p>With new neighborhoods, parks and trails, we wanted you to see Inspirada as it grows - <strong>with the new Inspirada app!</strong>

                        <p style="margin-bottom: 0px;">The specially designed technology lets you experience the Inspirada Vision at completion!</p>
                        </br>
                        <a href="https://itunes.apple.com/us/app/inspirada/id898483280?ls=1&mt=8" style="text-decoration: none;">
                            <img style=" margin-bottom: 15px; margin-right: 15px;" class="alignnone size-full wp-image-2005" src="http://166.78.0.133/wp-content/uploads/2014/07/appstore.png" alt="appstore" width="179" height="60" />
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.inspirada.inspirada.app" style="text-decoration: none;">
                            <img style="margin-bottom: 15px;" class="alignnone size-full wp-image-2006" src="http://166.78.0.133/wp-content/uploads/2014/07/googplay.png" alt="googplay" width="179" height="60" />
                        </a>
                        </br>
                        <h1 style="text-transform: none; font-size: 28px; text-align: left; margin-bottom: 10px;">It's free and it takes only seconds!</h1>
                        <p>Add the app to your iPhone or Android smartphone tablet or mobile device. Then, direct your device in the direction of Inspirada.</p>

                        Only Inspirada offers an app that brings the virtual future to you.
                        <h1 style="text-transform: none; font-size: 28px; text-align: left; margin-bottom: 10px;">Now that's Living Inspired</h1>
                </div>
            </div>
        </div>
    </section>
		</div>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>