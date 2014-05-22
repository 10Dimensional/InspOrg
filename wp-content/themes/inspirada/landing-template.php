<?php
   /*
   	Template Name: landing-page
   */ 
   
   ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meet Inspirada | Inspirada</title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/css/landing.css" media="all">
 <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
      	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
      <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!--	[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
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
jQuery(".clearit input, .clearit textarea").cleardefault();

});

</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KHRJ3V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KHRJ3V');</script>
<!-- End Google Tag Manager -->
</head>
<body class="landing">
	<header id="header">
		<div class="header-holder">
			<strong class="logo"><a href="#">Inspirada Live Inspired.</a></strong>
		</div>
	</header>
	<div id="main">
		<img src="<?php bloginfo('template_url') ?>/images/background-sharp.jpg" id="bg" alt="image description">
		<div class="main-holder">
			<div id="content">
				 <?php while ( have_posts() ) : the_post(); ?>
                     <?php the_content(); ?>
                     <?php endwhile; // end of the loop. ?>		
			</div>
			<aside id="sidebar">
				 <?php if ( ! dynamic_sidebar('landing-sidebar') ) : ?>
               <?php endif; ?>			</aside>
		</div>
	</div>
	<footer id="footer">
		<div class="footer-holder">
			<p>Copyright 2014 <a href="#">Inspirada</a>. All rights reserved.</p>
		</div>
	</footer>
</body>
</html>