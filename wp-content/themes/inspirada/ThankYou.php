<?php
   /*
   	Template Name: generic-page
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
<style>
@media only screen and (max-width:1023px){
.thankButton p {
width: 93%;
margin-right: auto;
margin-left: auto;
}
}
    
@media only screen and (max-width:768px){
    .thankButton a {margin-left: 5% !important;}
}

@media only screen and (max-width:479px){
.thankContainer {
width: 95%;
margin-left: auto;
margin-right: auto;
padding-bottom: 60px;
}

.thankButton a {
text-align: center;
text-decoration: none;
color: #fff;
font-weight: lighter;
float: left;
padding-right: 70px;
display: block;
font-size: 20px;
background: url(http://dev.lucidagency.com/inspirada/images/buttonThank.png) left top no-repeat;
background-size: 290px;
padding-top: 8px;
padding-bottom: 15px;
padding-left: 70px;
margin-top: -33px;
margin-left: 0%;
white-space: pre-line;
}
.thankButton p {
width: 1250px;
margin-right: auto;
margin-left: auto;
float: left;
margin-top: 2%;
margin-left: 1%;
}


}
</style>

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
				</p>
				<p><a id="learnmore" href="/living-inspired">Learn more about Inspirada</a></p>
			</div>
		</div>


			



		</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>












	</div>
	
</body>

</html>
