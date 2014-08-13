<?php
   /*
   	Template Name: First Dibs Single Event
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
      		<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/Landpage.css">

      <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
      	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
      <!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
      <!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
      <?php wp_head() ?>
   </head>
   <body>
      <div id="wrapper">
      <?php get_header() ?>
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>
		<!---->
		<div class="w1">
			<div id="bg" class="bg-without-mask">
				<img class="" src="<?php bloginfo('template_url') ?>/images/newback2.png" alt="header image">
			</div>
			<nav>
				<ul class="breadcrumbs">
					<li><a href="#"></a></li>
					<li><span></span></li>
				</ul>
			</nav>
			<div class="page-title" id="form-main" style="background: none;">
	  			<form id="form-dibs" action="<?php bloginfo('template_url') ?>/singlemailer.php" method="post" style="width: 100%;">
                    <div class="formLeft" id="formLeft-single" style="background-color: rgba(0,0,0,0.5); display: inline-block; padding-left: 25px; padding-bottom: 45px; margin-right: -10px; padding-right: 10px;">
                        <img class="Sign-up" src="<?php bloginfo('template_url') ?>/images/Sign-Up-For-First-Dibs.png" style="width: 98%;" alt="Sign Up For First Dibs!"/>
                        <h2 id="form-mainh2"><?php the_field('presentation_title'); ?></h2>
                            <div class="dibsParagraph" style="font-size: 18px !important; line-height: 28px !important;">
                                <p><?php the_field('presentation_description'); ?></p>
                            </div>
                        </div>                    
                    <div id="register" class="formRight" style="display: inline-block; vertical-align: top;">
						<div class="registerHead">
							<h2 class="registerHead">Space is Limited...</h2>
							<h1 class="registerHead">RESERVE YOUR SPOT</h1>
							<h2 class="registerHead">See Full Schedule Below</h2>
						</div>
						
							<input class="form-inputs" type="text" name="firstname" placeholder="*First Name"><br>
							<input class="form-inputs" type="text" name="lastname" placeholder="*Last Name"><br>
							<input class="form-inputs" type="text" name="email" placeholder="*Email"><br>
							<p style="font-size: 14px;
margin-left: 20px;
margin-bottom: 0px;
text-shadow: none;
color: rgb(236, 106, 82);">Preferred Time?
							<input type="radio" name="time" value="AM" style="width: 25px !important;
margin-left: 5px !important;
margin-top: 0px !important;
padding: 0px !important;">AM <input type="radio" name="time" value="PM" style="width: 25px !important;
margin-left: 5px !important;
margin-top: 0px !important;
padding: 0px !important;">PM</p>
							<input type="hidden" name="Presentation" value="<?php the_field('presentation_title'); ?>"> 
							<input type="submit" value="submit">
					</div>
	 			</form>
			</div>
			<div id="dibs-bottom" style="width:975px; margin-left:auto; margin-right:auto;">
						<a href="#Schedule" style="color: white;"><h1 class="white-center">See the Full Schedule Below</h1></a>
			<img style="margin-top: -20px;" id="dibs-map" src="<?php bloginfo('template_url') ?>/images/Map.png">
			<img style="margin-top: 45px;" id="dibs-directions" src="<?php bloginfo('template_url') ?>/images/Directions.png">
			</div>

		</div>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="firstHead">
			<div class="headerContainer">
				<h3><?php the_field('orange_title'); ?></h3>
			</div>
		</div>

		<div class="main">
			<div id="pointer">
			</div>
						<section id="Schedule">

			<div class="textContainer">
				<?php the_content() ?>
                <?php endwhile; // end of the loop. ?>
			</div>
						</section>



		</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>