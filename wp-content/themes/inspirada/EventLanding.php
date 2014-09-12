<?php
   /*
   	Template Name: First Dibs
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
<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/responsive.css">
      <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
      <script type="text/javascript">

        });
      </script>    
      	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
      <!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
      <!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
      <?php wp_head() ?>
   </head>
   <body>
      <div id="wrapper" style="background-color: transparent;">
      <?php get_header() ?>
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>
		<!---->
		<div class="w1">
			<div id="bg" class="bg-without-mask">
				<img class="" src="<?php bloginfo('template_url') ?>/images/darkgreen-bg-fd.jpg" alt="header image">
			</div>
			<nav>
				<ul class="breadcrumbs">
					<li><a href="#"></a></li>
					<li><span></span></li>
				</ul>
			</nav>
			<div class="page-title" id="form-main" style="background: none;">
	  			<form id="form-dibs" action="<?php bloginfo('template_url') ?>/inc/firstdibsmail.php" method="post" style="width: 100%; margin-top: 50px !important;">
                    <div class="formLeft" style="display: inline-block; padding-left: 25px; padding-bottom: 45px; margin-right: -10px; padding-right: 10px; width: 664px;">
                        <div style="text-align: center;">
                            <h2 style="font-size: 50px; line-height: 0px;">SUPER</h2>
                            <h2 style="font-size: 32px;">SATURDAY@</h2>
                            <img id="event-logo" src="<?php bloginfo('template_url') ?>/images/INSP_LOGO_sat.png" style="margin: auto; margin: -22px 0 0 -35px;
width: 55%;">
                            <h2 id="saturday-time" style="text-transform: none; font-size: 25px; line-height: 0px; vertical-align: top; padding: 0; margin: 15px 0 0 0;">October <span style="font-size: 35px;">4</span><sup>th</sup> | 9 a.m.-3 p.m.</h2>
                        </div>
                        <div style="margin-top: 30px;">
                            <h2 style="font-size: 28px; line-height: 40px;">INSPIRADA WILL BE<br>YOUR PERSONAL PLAYGROUND!</h2>
                            <p style="text-transform: none;font-size: 18px; line-height: 30px; width: 90%; font-family: 'roboto_slabregular', 'Times New Roman', Times, serif;">We're so proud to unveil our two newest parks, Capriola and Potenza, both filled with everything you could want! And it's all FREE!</p>
                        </div>
                    </div>
                    <div id="register" class="formRight" style="display: inline-block; vertical-align: top; width: 299px !important;">
						<div class="registerHead" style="background-color: #EAEAEA;">
							<img src="<?php bloginfo('template_url') ?>/images/please-count-me-in.png" style="margin: -1px 0 0 0;">
						</div>
						<div style="margin-top: 40px !important; margin-left: -5px !important;">
							<input class="form-inputs" type="text" name="firstname" placeholder="*First Name"><br>
							<input class="form-inputs" type="text" name="lastname" placeholder="*Last Name"><br>
							<input class="form-inputs" type="text" name="email" placeholder="*Email"><br>
							<input type="submit" value="submit" style="background: url(http://166.78.0.133/wp-content/themes/inspirada/images/blue-reg-button.png) left top no-repeat !important; margin-top: 10px !important;">
                        </div>
					</div>
	 			</form>
			</div>
			<div id="dibs-bottom" style="width:975px; margin-left:auto; margin-right:auto;">
			<img style="margin-top: -20px;" id="dibs-map" src="<?php bloginfo('template_url') ?>/images/new-bird-map.png">
			<img style="margin-top: 45px;" id="dibs-directions" src="<?php bloginfo('template_url') ?>/images/Directions.png">
			</div>

		</div>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="firstHead" style="background-color: #005487; height: 100%;">
			<div class="headerContainer">
				<h3><p style="text-align: center; line-height: 25px;">Enjoy free activities, clinics and demonstrations. Tour 18 home models, with fresh, new floor<br /> plans to fit today's lifestyle. And find out about move-in ready home — so you can be in your<br /> dream home in time for the holidays!</p><p style="text-align: center; line-height: 25px;">Enjoy fun food and cool beverages at every stop.<br /> Music, pet adoptions, wine tastings and more...it's all here — just for you.</p></h3>
			</div>
		</div>
          <div style="background-color: transparent; text-align: center;">
                <h2 style="background-color: #f7d93e; margin: 0; padding: 30px 0px; font-size: 35px; color: #005487;"><q>DON'T MISS</q> ATTRACTIONS</h2>
                <img src="<?php bloginfo('template_url') ?>/images/yellow-triangle.png">
          </div>
		<div class="main">
			<div id="pointer">
			</div>
			
			<!--<div class="textContainer">
				<h1>Presentation Schedule</h1>
				<h2>Trends in Outdoor Living</h2>
				<span>Time(s): 9:30 a.m. & 1 p.m. | Location: Alterra Models | Sponsored By: Pardee Homes</span>
				<p>Anderson-Baron, the designers of Inspirada's park system, shares ways to improve your outdoor space with the latest trends in landscaping and water responsiblity.</p>
			</div>-->
			<section id="Schedule" style="text-align: center;">
			<div class="textContainer">
				<?php the_content() ?>
                <?php endwhile; // end of the loop. ?>
			</div>
			</section>



		</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>