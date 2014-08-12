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

      <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
      <script type="text/javascript">
        function valthisform()
        {
            var checkboxs=document.getElementsByName("presentation[]");
            var okay=false;
            for(var i=0,l=checkboxs.length;i<l;i++)
            {
                if(checkboxs[i].checked)
                {
                    okay=true;
                }
            }

            return okay;
        };

        $(document).ready(function() {
          $('#form-dibs').on('submit', function (event) {
            if(!valthisform()) {
              alert("Please check a checkbox");
              return false;
            } 

            return true;

          });
        });
      </script>    
      	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
      <!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
      <!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
      <?php wp_head() ?>
   </head>
   <!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KHRJ3V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KHRJ3V');</script>
<!-- End Google Tag Manager -->

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
	  			<form id="form-dibs" action="<?php bloginfo('template_url') ?>/firstdibsmail.php" method="post" style="width: 100%;">
                    <div class="formLeft" style="background-color: rgba(0,0,0,0.5); display: inline-block; padding-left: 25px; padding-bottom: 45px; margin-right: -10px; padding-right: 10px;">
                        <img class="Sign-up" src="<?php bloginfo('template_url') ?>/images/Sign-Up-For-First-Dibs.png" alt="Sign Up For First Dibs!"/>
                        <h2 id="form-mainh2">August 2nd from 9 a.m. - 3 p.m. at Inspirada!</h2>
                        <p id="form-mainp">Select which presentations interest you and click Register for First Dibs:</p>

                        <div class="checkboxes" id="checkboxes1" style>
                                <input type="checkbox" id="presentation1" name="presentation[]" value="Trends in Outdoor Living">
                                <label for="presentation1">
                                    <span></span>
                                        <h1 class="checkBox">Trends in Outdoor Living </h1>
                                        <p class="checkBox">Improve your outdoor space</p>
                                </label>

                                <input type="checkbox" id="presentation2" name="presentation[]" value="Smart Solutions for Home Organization">
                                <label for="presentation2">
                                    <span></span>
                                        <h1 class="checkBox">Smart Solutions for Home Organization</h1>
                                        <p class="checkBox">Organizational techniques and tools</p>
                                </label>

                                <input type="checkbox" id="presentation3" name="presentation[]" value="Inspired to Live Green">
                                <label for="presentation3">
                                    <span></span>
                                        <h1 class="checkBox">Inspired to Live Green</h1>
                                        <p class="checkBox">Save energy and money by choosing green</p>
                                </label>

                                <input type="checkbox" id="presentation4" name="presentation[]" value="Dare to Dream">
                                <label for="presentation4">
                                    <span></span>
                                        <h1 class="checkBox">Dare to Dream</h1>
                                        <p class="checkBox">Options to transform your space</p>
                                </label>

                                <input type="checkbox" id="presentation5" name="presentation[]" value="Meet the Inspirada Team">
                                <label for="presentation5">
                                    <span></span>
                                        <h1 class="checkBox">Meet the Inspirada Team</h1>
                                        <p class="checkBox">Stop by for a cool drink and informative tour</p>
                                </label>
                        </div>

                        <div class="checkboxes">
                                <input type="checkbox" id="presentation6" name="presentation[]" value="New Trends in Decorating">
                                <label for="presentation6">
                                    <span></span>
                                        <h1 class="checkBox">New Trends in Interior Design</h1>
                                        <p class="checkBox">Hot design trends</p>
                                </label>

                                <input type="checkbox" id="presentation9" name="presentation[]" value="Designing for The Ages">
                                <label for="presentation9">
                                    <span></span>
                                        <h1 class="checkBox">Designing for The Ages</h1>
                                        <p class="checkBox">Decorating for kids, teens and adults</p>
                                </label>

                                <input type="checkbox" id="presentation7" name="presentation[]" value="Entertaining with Flair">
                                <label for="presentation7">
                                    <span></span>
                                        <h1 class="checkBox">Entertaining with Flair</h1>
                                        <p class="checkBox">Watch & taste with Master Chef Gustav Mauler</p>
                                </label>

                                <input type="checkbox" id="presentation8" name="presentation[]" value="Pizza Pronto & Italian Sodas">
                                <label for="presentation8">
                                    <span></span>
                                        <h1 class="checkBox">Pizza Pronto & Italian Sodas</h1>
                                        <p class="checkBox">Make fresh pizza and Italian sodas at home</p>
                                </label>
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
			
			<!--<div class="textContainer">
				<h1>Presentation Schedule</h1>
				<h2>Trends in Outdoor Living</h2>
				<span>Time(s): 9:30 a.m. & 1 p.m. | Location: Alterra Models | Sponsored By: Pardee Homes</span>
				<p>Anderson-Baron, the designers of Inspirada's park system, shares ways to improve your outdoor space with the latest trends in landscaping and water responsiblity.</p>
			</div>-->
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