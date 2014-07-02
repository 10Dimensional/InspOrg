<?php
                /*
            	Template Name: event-thank
            	Thank You Page
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


		<?php while ( have_posts() ) : the_post();

		$url = wp_get_attachment_url( get_post_thumbnail_id() );?>

		<img src="<?php echo $url; ?>" style"width:100%"/>
		<div class="thankMain">
			<div class="thankContainer">
				<!--<h1>Thank You!</h1>
				<h2>You Have First Dibs on August 2nd</h2>
				<p>You are officially welcomed to step through the doors of Inspirada's <a>16 new models</a>, view never-before available home sites and enjoy Inspired Living presentaions.</p>
				<p>Thank you for your registration.</p>
				<h2>See you Saturday, Aug 2nd - doors open at 9 a.m.</h2>-->
				<?php the_content() ?>
                <?php endwhile; // end of the loop. ?>
			</div>
		</div>




		<div class="thankFoot">
			<div class="thankButton">
				<p><a href="/see-for-yourself">Map / Directions</a>
				<a id="learnmore" href="/living-inspired">Learn more about Inspirada</a></p>
			</div>
		</div>


			



		</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>












	</div>
	
</body>

</html>
