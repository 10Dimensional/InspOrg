<?php
                /*
            	Template Name: event-landing
            	Event Landing Page
                */ 
                
                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/Landpage.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>

	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
<?php wp_head() ?></head>


	<body>
	<div id="wrapper">


		<!---->
<!-- Google Code for Remarketing Tag -->
<!--
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
-->
<script type='text/javascript'>
/* <![CDATA[ */
var google_conversion_id = 974801844;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type='text/javascript' src='//www.googleadservices.com/pagead/conversion.js'>
</script>
<noscript>
<div style='display:inline;'>
<img height='1' width='1' style='border-style:none;' alt='' src='//googleads.g.doubleclick.net/pagead/viewthroughconversion/974801844/?value=0&amp;guid=ON&amp;script=0'/>
</div>
</noscript>

	<!--<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">-->
	<!--<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">-->
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
<script type="text/javascript">

jQuery(document).ready(function() {

	jQuery.fn.cleardefault = function() {
	return this.focus(function() {
		if( this.value == this.defaultValue ) {
			this.value = "";
		}
	}).blur(function() {
		if( !this.value.length ) {
			this.value = this.defaultValue;
		}
	});
};
jQuery(".clearit input[type='text'], .clearit textarea").cleardefault();

});

</script>
<style>
#gform_wrapper_11 {
	margin: 0;
	max-width: 95%;
	margin-left: 3%;
	margin-top: -15px;
}
#field_11_1 > label.gfield_label {
	width: 0px;
	display:none !important; 
	
}

#field_11_2 > label.gfield_label {
	width: 0px;
	display:none !important; 

}

#field_11_3 > label.gfield_label {
	width: 0px;
	display:none !important; 

}

#input_11_3 > li > label {
	width: 80%;
	color: black;
font-size: 11px;
margin-left: 8px;
}

#input_11_2 > li > label {
	width: 85%;
}

#field_11_2 > label > span.gfield_required {
	display: none;
}

#field_11_1 > label > span.gfield_required {
	display: none;
}

#input_11_1 > li > label {
	width: 85%;
}

input#input_11_2.medium {
	width: 69%;
	margin-left: 27px;
}

input#input_11_1.medium {
	width: 69%;
	margin-left: 27px;
}

input#gform_submit_button_11.button.gform_button {
	width: 69%;
	margin-right: 23% !important;
}

li.last-child.hover > a.last-child-a:after {display: none;}
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
#sign-up-form.modal-content {
	margin-left: 114% !important;
}
}
</style>
<header id="header">
	<div class="header-holder">
		<strong class="logo"><a href="/">Inspirada - Live inspired</a></strong>
		<nav class="open-close hide-mobile">
			<a href="#" class="nav-opener opener"></a>
			<ul id="nav" class="slide hide-mobile">
				<?php if ( has_nav_menu( 'primary-menu', 'inspirada' ) ) { ?>
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary-menu', 'link_before' => '<span>', 'link_after' => '</span>', 'fallback_cb' => 'display_home' ) ); ?>
				<?php } else { ?>
			 		<li><span><a href="<?php echo get_option('home'); ?>">Home</a><span></li>
					<?php wp_list_pages('title_li=&depth=4&sort_column=menu_order'); ?>
				<?php	} ?>	

				<li style="margin-top: -14%;
float: right;">
					<a data-toggle="modal" data-target="#emailsignup" data-backdrop="static" data-keyboard="false" href="#">
  						<img src="<?php bloginfo('template_url') ?>/images/signupbutton.png">
					</a>
				</li>				
			</ul>



</nav>
	</div>
</header>
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>
		<!---->





		<div class="w1">
			<div id="bg" class="bg-without-mask">
				<img class="headerimg" src="<?php the_field('header_image'); ?>" alt="header image">
			</div>
			<nav>
				<ul class="breadcrumbs">
					<li><a href="#"></a></li>
					<li><span></span></li>
				</ul>
			</nav>
			<div class="page-title" id="form-main">
	  			<form action="<?php bloginfo('template_url') ?>/firstdibsmail.php" method="post">
					<div id="register">
						<div class="registerHead">
							<h2 class="registerHead">Space is Limited...</h2>
							<h1 class="registerHead">RESERVE YOUR SPOT</h1>
							<h2 class="registerHead">Activity Specific Details Here</h2>
						</div>
						
							<input class="form-inputs" type="text" name="firstname" placeholder="*First Name"><br>
							<input class="form-inputs" type="text" name="lastname" placeholder="*Last Name"><br>
							<input class="form-inputs" type="text" name="email" placeholder="*Email"><br>
							<input type="submit" value="submit">
					</div>

					<h1 id="form-mainh1">Sign Up For First Dibs!</h1>	
					<h2 id="form-mainh2">August 2nd from 9 a.m. - 3 p.m. at Inspirada!</h2>
					<p id="form-mainp">Select which presentations interest you and click Register for First Dibs:</p>

					<div class="checkboxes">
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
									<h1 class="checkBox">New Trends in Decorating </h1>
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

	 			</form>
			</div>
		</div>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="firstHead">
			<div class="headerContainer">
				<h3><?php echo the_field('green_title'); ?></h3>
			</div>
		</div>

		<div class="secondHead">
			<div class="headerContainer">
				<h3><?php echo the_field('blue_title'); ?></h3>
			</div>
		</div>
		<div class="main">
			<div id="pointer">
				<img src="http://dev.lucidagency.com/inspirada/images/Main-pointer.png"/>
			</div>
			
			<!--<div class="textContainer">
				<h1>Presentation Schedule</h1>
				<h2>Trends in Outdoor Living</h2>
				<span>Time(s): 9:30 a.m. & 1 p.m. | Location: Alterra Models | Sponsored By: Pardee Homes</span>
				<p>Anderson-Baron, the designers of Inspirada's park system, shares ways to improve your outdoor space with the latest trends in landscaping and water responsiblity.</p>
			</div>-->
			
			<div class="textContainer">
				<?php the_content() ?>
                <?php endwhile; // end of the loop. ?>
			</div>
			



		</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>